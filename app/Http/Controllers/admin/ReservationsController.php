<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function showReservations(Request $request) {
        // Add Back-end (search result) later
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $reservations = [
            [
                'res_id' => 4,
                'user_id' => '1',
                'user_name' => 'John Doe',
                'date' => '2023-03-21',
                'area' => 'Area A, 1F',
                'type' => 'Disability',
                'fee'=> 20,
            ],
            [
                'res_id' => 5,
                'user_id' => '1',
                'user_name' => 'John Doe',
                'date' => '2023-03-22',
                'area' => 'Area A, 1F',
                'type' => 'Disability',
                'fee'=> 20,
            ],
            [
                'res_id' => 6,
                'user_id' => '2',
                'user_name' => 'Tom Joseph',
                'date' => '2023-04-23',
                'area' => 'Area B, 2F',
                'type' => 'General',
                'fee'=> 20,
            ],
        ];

        return view('admin.reservations.show')->with('reservations', $reservations);
    }
}
