<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Reservation;

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
        $availableAreas = [];

        // Get areas with the given attributeId
        $areas = $this->area->where('attribute_id', $attributeId)->get();

        // Fetch all reservations for the areas and dates at once
        $reservations = $this->reservation
            ->whereIn('area_id', $areas->pluck('id'))
            ->whereIn('date', $selectedDates)
            ->get();

        // Group reservations by area and date
        $reservationsGroupedByAreaAndDate = $reservations->groupBy(['area_id', 'date']);

        // Create an array for reservationsToBeConfirmed
        $reservationsToBeConfirmed = array_map(function($date) use ($attributeId, $areas, $reservationsGroupedByAreaAndDate, &$availableAreas) {
            // Filter out areas whose reservation number reaches the max num
            $areas = $areas->filter(function ($area) use ($date, $reservationsGroupedByAreaAndDate) {
                $reservationCount = isset($reservationsGroupedByAreaAndDate[$area->id][$date])
                    ? count($reservationsGroupedByAreaAndDate[$area->id][$date])
                    : 0;
                return $reservationCount < $area->max_num;
            });

            $availableAreas[$date] = $areas;

            // If there are no available areas, return null
            if ($areas->isEmpty()) {
                return null;
            }

            // Choose an area at random
            $area = $areas->random();

            return [
                'date' => $date,
                'areaId' => $area->id,
                'areaName' => $area->name,
                'attributeId' => $attributeId,
                'attributeName' => $area->attribute->name,
                'fee' => $area->fee->fee,
            ];
        }, $selectedDates);

        // Filter out null values
        $reservationsToBeConfirmed = array_filter($reservationsToBeConfirmed);

        return response()->json($reservationsToBeConfirmed);
    }

    public function showConfirmationReservation()
    {
        return view('users.reservation.confirmation');
    }

    public function showCompletionReservation()
    {
        $confirmedReservations = [
            ['date' => '2022-01-01', 'area' => 'Area 1', 'fee' => 100],
            ['date' => '2022-01-02', 'area' => 'Area 2', 'fee' => 200],
            ['date' => '2022-01-03', 'area' => 'Area 3', 'fee' => 300],
        ];
        $userAttribute = 'Disability';

        return view('users.reservation.completion')
            ->with('confirmedReservations', $confirmedReservations)
            ->with('userAttribute', $userAttribute);
    }
    public function deleteReservation($id)
    {
        $reservation = Reservation::where('user_id', Auth::user()->id)->findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservation.list')->with('success_delete', 'The reservation has been deleted.');
    }

    public function pdf()
    {
        if (Auth::check()) {
            return view('users.reservation.pdf_view');
        } else {
            return redirect()->route('login');
        }
    }
}
