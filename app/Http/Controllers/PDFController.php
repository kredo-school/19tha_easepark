<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{

    public function pdf_generator_get(Request $request)
    {
        $users = User::get();
        $userNames = $users->pluck('name');
        $data = [
            'title' => 'PDF',
            'date' => date('m/d/y'),
            'userNames' => $userNames
        ];

        $pdf = PDF::loadView('users.reservation.pdf_download', $data);
        return $pdf->download('reservation_list.pdf');
    }
}
