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
        $data = [
            'type' => 'attribute',
            'availableDate' => ['2024-05-01', '2024-05-05'] // replace with actual dates
        ];

        return view('users.home.index', ['data' => $data]);
    }


    public function showAllConfirmationReservation()
    {
        return view('users.reservation.list');
    }
}
