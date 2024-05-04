<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function homePage()
    {

        return view('users.home.index');
    }

    public function passAvailableDates()
    {
        $data = [
            'availableDates' => ['2024-05-01','2024-05-02','2024-05-03', '2024-05-05','2024-06-04','2024-06-05'],
        ];

        return response()->json($data);
    }


    public function showAllConfirmationReservation()
    {
        return view('users.reservation.list');
    }
}
