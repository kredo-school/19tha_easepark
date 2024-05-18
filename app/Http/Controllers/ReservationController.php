<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Area;

class ReservationController extends Controller
{
    private $area;
    private $reservation;

    public function __construct(Reservation $reservation, Area $area)
    {
        $this->reservation = $reservation;
        $this->area = $area;
    }

    public function showReservationList()
    {
        $reservation = $this->reservation;
        return view('users.reservation.list', ['reservation' => $reservation]);
    }

    public function filterReservationList(Request $request)
    {
        $userReservations = $this->reservation
            ->with(['area', 'area.attribute'])
            ->where('user_id', Auth::id())
            ->orderBy('date', 'desc');
        $userAttribute = Auth::user()->attribute->name;

        $filterCondition = $request->input('filterCondition');
        $page = $request->get('page');
        $today = now()->startOfDay();
        $nextMonth = clone $today;
        $nextMonth->addMonth();
        $nextWeek = clone $today;
        $nextWeek->addWeek();
        $preMonth = clone $today;
        $preMonth->subMonth();
        $preWeek = clone $today;
        $preWeek->subWeek();

        switch ($filterCondition) {
            case 'all':
                $reservations = $userReservations->with('area')->paginate(5, ['*'], 'page', $page);
                break;
            case 'upcoming_reservations_all':
                $reservations = $userReservations->with('area')->where('date', '>=', $today)->paginate(5, ['*'], 'page', $page);
                break;
            case 'upcoming_reservations_one_month':
                $reservations = $userReservations->with('area')->where('date', '>=', $today)->where('date', '<=', $nextMonth)->paginate(5, ['*'], 'page', $page);
                break;
            case 'upcoming_reservations_one_week':
                $reservations = $userReservations->with('area')->where('date', '>=', $today)->where('date', '<=', $nextWeek)->paginate(5, ['*'], 'page', $page);
                break;
            case 'past_reservations_all':
                $reservations = $userReservations->with('area')->where('date', '<', $today)->paginate(5, ['*'], 'page', $page);
                break;
            case 'past_reservations_one_month':
                $reservations = $userReservations->with('area')->where('date', '<', $today)->where('date', '>=', $preMonth)->paginate(5, ['*'], 'page', $page);
                break;
            case 'past_reservations_one_week':
                $reservations = $userReservations->with('area')->where('date', '<', $today)->where('date', '>=', $preWeek)->paginate(5, ['*'], 'page', $page);
                break;
            default:
                $reservations = $userReservations->with('area')->paginate(5, ['*'], 'page', $page);
                break;
        }

        $fetchedData = [
            'reservations' => $reservations,
            'userAttribute' => $userAttribute,
        ];

        return response()->json($fetchedData);
    }

    public function passToConfirmation(Request $request)
    {
        $selectedDates = $request->input('selectedDates');
        sort($selectedDates);

        $attributeId = $request->input('attributeId');

        // Validate inputs
        if (empty($selectedDates) || empty($attributeId)) {
            return response()->json(['error' => 'Invalid input'], 400);
        }

        $areas = $this->area->where('attribute_id', $attributeId)->get();

        $reservations = $this->reservation
            ->whereIn('area_id', $areas->pluck('id'))
            ->whereIn('date', $selectedDates)
            ->get();

        $reservationsGroupedByAreaAndDate = $reservations->groupBy(['area_id', 'date']);

        list($consecutiveDateGroups, $separateDateGroups) = $this->getConsecutiveAndSeparateDates($selectedDates);
        

        $differentAreaAlert = false;

        $reservationsDetails = array_reduce(array_merge($consecutiveDateGroups, $separateDateGroups), function ($carry, $dateGroup) use ($areas, $reservationsGroupedByAreaAndDate, &$commonAreas, &$differentAreaAlert) {
            $dateGroup = is_array($dateGroup) ? $dateGroup : [$dateGroup];
            $commonAreas = $this->getCommonAreas($dateGroup, $areas, $reservationsGroupedByAreaAndDate);

            if ($commonAreas->isEmpty()) {
                $differentAreaAlert = true;
            }

            if (!$commonAreas->isEmpty()) {
                $area = $commonAreas->random();
                foreach ($dateGroup as $date) {
                    $carry[$date] = [
                        'areaId' => $area->id,
                        'areaName' => $area->name,
                        'fee' => $area->fee->fee,
                    ];
                }
            } else {
                foreach ($dateGroup as $date) {
                    $availableAreas = $areas->filter(function ($area) use ($date, $reservationsGroupedByAreaAndDate) {
                        return !isset($reservationsGroupedByAreaAndDate[$area->id][$date]) || count($reservationsGroupedByAreaAndDate[$area->id][$date]) < $area->max_num;
                    });
                    if (!$availableAreas->isEmpty()) {
                        $area = $availableAreas->random();
                        $carry[$date] = [
                            'areaId' => $area->id,
                            'areaName' => $area->name,
                            'fee' => $area->fee->fee,
                        ];
                    }
                }
            }

            return $carry;
        }, []);

        $reservationsToBeConfirmed = [
            'attributeId' => $attributeId,
            'attributeName' => $areas->first()->attribute->name,
            'differentAreaAlert' => $differentAreaAlert,
            'reservations' => $reservationsDetails,
        ];

        return response()->json($reservationsToBeConfirmed);
    }

    private function getConsecutiveAndSeparateDates($dates)
    {
        $consecutiveDateGroups = [];
        $separateDateGroups = [];
        $group = [];

        for ($i = 0; $i < count($dates); $i++) {
            if ($i == 0 || strtotime($dates[$i]) - strtotime($dates[$i - 1]) == 24 * 60 * 60) {
                $group[] = $dates[$i];
            } else {
                $this->addDateGroup($group, $consecutiveDateGroups, $separateDateGroups);
                $group = [$dates[$i]];
            }
        }

        if (!empty($group)) {
            $this->addDateGroup($group, $consecutiveDateGroups, $separateDateGroups);
        }

        return [$consecutiveDateGroups, $separateDateGroups];
    }

    private function addDateGroup($group, &$consecutiveDateGroups, &$separateDateGroups)
    {
        if (count($group) > 1) {
            $consecutiveDateGroups[] = $group;
        } else {
            $separateDateGroups[] = $group[0];
        }
    }

    private function getCommonAreas($dateGroup, $areas, $reservationsGroupedByAreaAndDate)
    {
        $areasForAllDates = collect();

        foreach ($dateGroup as $date) {
            $areasForDate = $areas->filter(function ($area) use ($date, $reservationsGroupedByAreaAndDate) {
                return !isset($reservationsGroupedByAreaAndDate[$area->id][$date]) || $reservationsGroupedByAreaAndDate[$area->id][$date]->count() < $area->max_num;
            });

            if ($areasForDate->isEmpty()) {
                return collect();
            }

            $areasForAllDates->push($areasForDate->pluck('id')->all());
        }

        $commonAreaIds = call_user_func_array('array_intersect', $areasForAllDates->toArray());

        return $areas->whereIn('id', $commonAreaIds);
    }

    public function showConfirmationReservation()
    {
        return view('users.reservation.confirmation');
    }

    public function reserveSpaces (Request $request){
        $reservationsToBeCompleted = $request->input('reservationsToBeConfirmed');

        $reservations = $reservationsToBeCompleted['reservations'];

        //Database transaction to save reservations
        DB::transaction(function () use ($reservations) {
            foreach ($reservations as $date => $reservationData) {
                //a new Reservation instance for each reservation in $reservations, sets its properties, and saves it.
                $reservation = new Reservation;
                $reservation->user_id = Auth::id();
                $reservation->area_id = $reservationData['areaId'];
                $reservation->date = $date;
                $reservation->fee_log = $reservationData['fee'];
                $reservation->save();
            }
        });

        return response()->json($reservationsToBeCompleted);
    }

    public function deleteReservation($id)
    {
        $reservation = Reservation::where('user_id', Auth::user()->id)->findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservation.list')->with('success_delete', 'The reservation has been deleted.');
    }

    public function showCompletionReservation()
    {
        return view('users.reservation.completion');
    }

    public function pdf($id)
    {
        $reservation = Reservation::findOrFail($id);
        $all_reservations = Reservation::all();
        if (Auth::check()) {
            return view('users.reservation.pdf_view', compact('reservation'))
            ->with('all_reservations', $all_reservations);
        } else {
            return redirect()->route('login');
        }
    }
}
