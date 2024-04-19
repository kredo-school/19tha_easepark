<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function showAllConfirmationReservation()
    {
        $tentativeAllReservations = [
           ['date' => '2022-04-01', 'area' => 'Area 1', 'fee' => 100],
           ['date' => '2022-04-02', 'area' => 'Area 2', 'fee' => 200],
           ['date' => '2022-04-03', 'area' => 'Area 3', 'fee' => 300],
        ];

        return view('users.reservation.list')
            -> with('tentativeAllReservations', $tentativeAllReservations);
    }
}
