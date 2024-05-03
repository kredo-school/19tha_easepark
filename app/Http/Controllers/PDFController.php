<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PDF;

class PDFController extends Controller
{
    public function pdf_generator_get()
    {
        // echo "PDF";
        // die();



        // $users = User::get();

        // $data = [
        //     'title' => 'PDF',
        //     'date' => 'date(m/d/y)',
        //     'users' => $users

        // ];
        // $pdf = PDF::loadView('users.reservation.pdf', $data);
        // return $pdf->download('reservation_list.pdf');

        return view('users.reservation.pdf');
    }
}
