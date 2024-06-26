<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Attribute;
use App\Models\Area;
use DateTime;


class HomeController extends Controller
{
    private $reservation;
    private $attribute;
    private $area;

    public function __construct(Reservation $reservation, Attribute $attribute, Area $area)
    {
        $this->reservation = $reservation;
        $this->attribute = $attribute;
        $this->area = $area;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showHomePage()
    {
        $attributes = $this->attribute->all();
        return view('users.home.index')->with('attributes', $attributes);
    }

    public function fetchAttributeAndAvailableDates($attributeId)
    {
        $attribute = $this->attribute->find($attributeId);
        $areaIds = $this->area->where('attribute_id', $attributeId)->pluck('id');
        $availableDates = [];
        $startDate = new DateTime();
        $endDate = (new DateTime())->modify('+1 year');

        $data = [];
        if ($areaIds->isEmpty()) {
            $data = [
                'reservationNumPerArea' => 'none',
                'attribute' => [
                    'attributeName' => $attribute->name,
                    'attributeId' => $attribute->id
                ],
                'availableDates' => 'none',
            ];
        } else {
            // Fetch all reservations for the areas and dates at once
            $reservations = $this->reservation
                ->whereIn('area_id', $areaIds)
                ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->get();

            // Group reservations by area and date
            $reservationsGroupedByAreaAndDate = $reservations->groupBy(['area_id', 'date']);

            foreach ($areaIds as $areaId) {
                $maxNumPerArea = $this->area->where('id', $areaId)->value('max_num');

                for ($date = clone $startDate; $date <= $endDate; $date->modify('+1 day')) {
                    $dateStr = $date->format('Y-m-d');

                    // Get the number of reservations for this date from the grouped data
                    $reservationNumPerAreaPerDay = isset($reservationsGroupedByAreaAndDate[$areaId][$dateStr])
                        ? count($reservationsGroupedByAreaAndDate[$areaId][$dateStr])
                        : 0;

                    if ($reservationNumPerAreaPerDay < $maxNumPerArea) {
                        $availableDates[] = $dateStr;
                    }
                }
            }

            $datesAlreadyReservedByUser = [];
            // Remove the dates that the authenticated user has already booked from the available dates
            if(auth()->check()){
                $datesAlreadyReservedByUser = $this->reservation
                ->where('user_id', auth()->id())
                ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->pluck('date')
                ->toArray();
                
                $availableDates = array_diff($availableDates, $datesAlreadyReservedByUser);
            }

            /*
            'availableDates' contains all available dates with duplicates possibly included. array_unique() removes duplicates but doesn't reindex keys, leading to non-sequential keys if duplicates are removed.
            This can cause issues in JavaScript, as it treats arrays with non-sequential keys as objects, and we want to use the 'includes()' array method.
            To ensure 'availableDates' remains an array in JavaScript, array_values() is used to reindex the keys, ensuring they start from 0 and increase by 1 for each element.
            */
            $data = [
                'attribute' => [
                    'attributeName' => $attribute->name,
                    'attributeId' => $attribute->id
                ],
                'startDate' => $startDate->format('Y-m-d'),
                'availableDates' => array_values(array_unique($availableDates)),
                'datesAlreadyReservedByUser' => $datesAlreadyReservedByUser,
            ];
        }

        return response()->json($data);
    }

    public function showAllConfirmationReservation()
    {
        return view('users.reservation.list');
    }
}
