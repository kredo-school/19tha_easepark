<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Reservation;


class ReservationController extends Controller
{

    private $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function showReservationList()
    {
        return view('users.reservation.list');
    }

    public function filterReservationList(Request $request)
    {
        $userReservations = $this->reservation
            ->where('user_id', Auth::id())
            ->orderBy('date', 'desc');
        $userAttribute = Auth::user()->attribute->name;

        $filterCondition = $request->input('filterCondition');
        $page = $request->get('page');

        switch ($filterCondition) {
            case 'all':
                $reservations = $userReservations->with('area')->paginate(5, ['*'], 'page', $page);
                break;
            case 'upcoming_reservations_all':
                $reservations = $userReservations->with('area')->where('date', '>', now())->paginate(5, ['*'], 'page', $page);
                break;
            case 'upcoming_reservations_one_month':
                $reservations = $userReservations->with('area')->where('date', '>', now())->where('date', '<', now()->addMonth())->paginate(5, ['*'], 'page', $page);
                break;
            case 'upcoming_reservations_one_week':
                $reservations = $userReservations->with('area')->where('date', '>', now())->where('date', '<', now()->addWeek())->paginate(5, ['*'], 'page', $page);
                break;
            case 'past_reservations_all':
                $reservations = $userReservations->with('area')->where('date', '<', now())->paginate(5, ['*'], 'page', $page);
                break;
            case 'past_reservations_one_month':
                $reservations = $userReservations->with('area')->where('date', '<', now())->where('date', '>', now()->subMonth())->paginate(5, ['*'], 'page', $page);
                break;
            case 'past_reservations_one_week':
                $reservations = $userReservations->with('area')->where('date', '<', now())->where('date', '>', now()->subWeek())->paginate(5, ['*'], 'page', $page);
                break;
            default:
                $reservations = $userReservations->with('area')->paginate(5, ['*'], 'page', $page);
                break;
        }

        $fetchedData = [
            'reservations' => $reservations,
            'userAttribute' => $userAttribute,
        ];

        return response()->json($fetchedData);
    }

    public function showConfirmationReservation()
    {
        $tentativeReservations = [
            ['date' => '2022-01-01', 'area' => 'Area 1', 'fee' => 100],
            ['date' => '2022-01-02', 'area' => 'Area 2', 'fee' => 200],
            ['date' => '2022-01-03', 'area' => 'Area 3', 'fee' => 300],
        ];
        $userAttribute = 'Disability';

        return view('users.reservation.confirmation')
            ->with('tentativeReservations', $tentativeReservations)
            ->with('userAttribute', $userAttribute);
    }

    public function showCompletionReservation()
    {
        $confirmedReservations = [
            ['date' => '2022-01-01', 'area' => 'Area 1', 'fee' => 100],
            ['date' => '2022-01-02', 'area' => 'Area 2', 'fee' => 200],
            ['date' => '2022-01-03', 'area' => 'Area 3', 'fee' => 300],
        ];
        $userAttribute = 'Disability';

        return view('users.reservation.completion')
            ->with('confirmedReservations', $confirmedReservations)
            ->with('userAttribute', $userAttribute);
    }


    public function pdf()
    {
        if (Auth::check()) {
            return view('users.reservation.pdf_view');
        } else {
            return redirect()->route('login');
        }
    }
}
