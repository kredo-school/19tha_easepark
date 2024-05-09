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
        // Define the date range
        $startDate = new DateTime();
        $endDate = (new DateTime())->modify('+1 year');
        // Fetch the attribute
        $data;
        if ($areaIds->isEmpty()) {
            // Handle the case where there are no areas with the specified attribute_id
            $data = [
                'reservationNumPerArea' => 'none',
                'attribute' => [
                    'attributeName' => $attribute->name,
                    'attributeId' => $attribute->id
                ],
                'availableDates' => 'none',
            ];
        } else {
            $reservationNumPerArea = [];

            // Iterate over each areaId
            foreach ($areaIds as $areaId) {
                // Get the max_num for this area
                $maxNumPerArea = $this->area->where('id', $areaId)->value('max_num');

                // Iterate over each date in the range
                for ($date = clone $startDate; $date <= $endDate; $date->modify('+1 day')) {
                    // Count the number of reservations for this date
                    $reservationNumPerAreaPerDay = $this->reservation
                        ->where('area_id', $areaId)
                        ->whereDate('date', $date->format('Y-m-d'))
                        ->count();
                    
                    // If the number of reservations is less than the max_num, add the date to the available dates
                    if ($reservationNumPerAreaPerDay < $maxNumPerArea) {
                        $availableDates[] = $date->format('Y-m-d');
                    }
                }
            }

            $data = [
                'attribute' => [
                    'attributeName' => $attribute->name,
                    'attributeId' => $attribute->id
                ],
                'startDate' => $startDate->format('Y-m-d'),
                'availableDates' => array_unique($availableDates),
            ];
        }

        return response()->json($data);
    }

    public function showAllConfirmationReservation()
    {
        return view('users.reservation.list');
    }
}
