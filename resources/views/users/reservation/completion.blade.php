@extends('layouts.app')
@section('title', 'Reservation Completion')
@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

<div class="container w-75 pb-3">
    <h2 class="text-center font-navy font-bold pt-3"><i class="fas fa-check-circle"></i> Reservation Completed !!</h2>
    <div class="mt-3 py-3 details-box">
        <div class="w-75">
            <h4 class="py-2 font-bold">Choose Type: {{$userAttribute}}</h4>
            <h4 class="py-3 font-bold">Details: </h4>

            <ul class="record-list">
                @foreach ($confirmedReservations as $reservation)
                    <li>
                        <span>{{ (new DateTime($reservation['date']))->format('F j (D)') }}</span>
                        <span>{{ $reservation['area'] }}</span>
                        <span>$ {{ $reservation['fee'] }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="total-info">
                <span>Total:</span>
                <span>${{ array_sum(array_column($confirmedReservations, 'fee')) }}</span>
            </div>
            <div class="text-danger font-bold" style="font-size: 1.5rem;">*Payment on site.</div>
            <div class="mt-5 button-group">
                <button type="button" class="btn btn-cancel me-2">Back to Home</button>
                <button type="button" class="btn btn-blue">Reservation List</button>
            </div>
        </div>
    </div>
</div>
@endsection