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
        $reservationsToBeConfirmed = array_map(function ($date) use ($attributeId, $areas, $reservationsGroupedByAreaAndDate, &$availableAreas) {
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

    public function reserveSpaces (Request $request){
        $reservationsToBeCompleted = $request->input('reservationsToBeConfirmed');

        //Database transaction to save reservations
        DB::transaction(function () use ($reservationsToBeCompleted) {
            foreach ($reservationsToBeCompleted as $reservationData) {
                //a new Reservation instance for each reservation in $reservationsToBeCompleted, sets its properties, and saves it.
                $reservation = new Reservation;
                $reservation->user_id = Auth::id();
                $reservation->area_id = $reservationData['areaId'];
                $reservation->date = $reservationData['date'];
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
