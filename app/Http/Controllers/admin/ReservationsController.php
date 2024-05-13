<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Reservation;

class ReservationsController extends Controller
{
    private $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function showReservations(Request $request) {
        if($request->daterange) {
            $reservations = $this->reservation->withTrashed()->whereBetween('date', [$request->start_date, $request->end_date])->paginate(5);
        } else {
            $reservations = $this->reservation->withTrashed()->orderBy('id')->paginate(5);
        }

        return view('admin.reservations.show')->with('reservations', $reservations)
                                            ->with('daterange', $request->daterange);
    }
}
