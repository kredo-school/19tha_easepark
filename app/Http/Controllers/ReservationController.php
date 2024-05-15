<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Area;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    private $area;
    private $reservation;

    public function __construct(Reservation $reservation, Area $area)
    {
        $this->reservation = $reservation;
        $this->area = $area;
    }

    public function showAllConfirmationReservation(){
        $tentativeAllReservations = [
            ['date' => '2022-04-01', 'area' => 'Area 1', 'fee' => 100],
            ['date' => '2022-04-02', 'area' => 'Area 2', 'fee' => 200],
            ['date' => '2022-04-03', 'area' => 'Area 3', 'fee' => 300]
        ];

        return view('users.reservation.list')
            ->with('tentativeAllReservations', $tentativeAllReservations);
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

    public function showCompletionReservation()
    {

        return view('users.reservation.completion');
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
