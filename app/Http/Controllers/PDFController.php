<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class PDFController extends Controller
{
    public function pdf_generator_get($id)
    {
        $reservation = Reservation::findOrFail($id);
        if (Auth::check()) {
            $pdf = Pdf::loadView('users.reservation.pdf_download', compact('reservation'));
            return $pdf->download('reservation_list.pdf');
        } else {
            return redirect()->route('login');
        }
    }
}
