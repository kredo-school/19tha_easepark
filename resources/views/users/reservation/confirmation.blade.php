@extends('layouts.app')
@section('title', 'Reservation Confirmation')
@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">

<div class="container w-75 pb-3">
    <h2 class="text-center font-navy font-bold pt-3"><i class="far fa-calendar-check"></i> Reservation Confirmation</h2>
    <div class="mt-3 py-2 details-box">
        <div class="w-75">
            <h4 class="py-2 font-bold">Choose Type: {{$userAttribute}}</h4>
            <h4 class="py-3 font-bold">Details: </h4>

            <ul class="record-list">
                @foreach ($tentativeReservations as $reservation)
                    <li>
                        <span>{{ (new DateTime($reservation['date']))->format('F j (D)') }}</span>
                        <span>{{ $reservation['area'] }}</span>
                        <span>$ {{ $reservation['fee'] }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="total-info">
                <span>Total:</span>
                <span>${{ array_sum(array_column($tentativeReservations, 'fee')) }}</span>
            </div>
            <div class="mt-5 button-group">
                <button type="button" class="btn btn-cancel me-2">Cancel</button>
                <button type="button" class="btn btn-blue">Confirm</button>
            </div>
        </div>
    </div>
</div>
@endsection