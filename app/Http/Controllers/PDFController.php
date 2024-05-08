<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{

    public function pdf_generator_get()
    {
        $pdf = PDF::loadView('users.reservation.pdf_download');
        return $pdf->download('reservation_list.pdf');
    }
}
