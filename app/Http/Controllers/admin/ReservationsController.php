<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function default(){
        return view('admin.reservations.show');
    }
}
