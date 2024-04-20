@extends('layouts.app')
@section('title', 'Reservation Confirmation')
@section('content')
<style>
    .record-list {
        list-style-type: none;
        padding-left: 0;
        font-size: 1.5rem;
        font-weight: bold;
    }
    .record-list li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        position: relative;
        padding-left: 20px;
        color: rgb(114, 113, 113);
    }
    .record-list li::before {
        content: "•";
        position: absolute;
        left: 0;
    }
    .button-group {
        display: flex;
        justify-content: flex-end;
    }
    .btn-cancel {
        background-color: white;
        color: #003366;
    }
    .btn-confirm {
        background-color: #3399CC;
        color: white;
    }
    .total-info {
        display: flex;
        justify-content: space-between;
        font-size: 1.5rem;
        font-weight: bold;
    }
    .font-navy {
        color: #003366;
    }
    .font-bold {
        font-weight: bold;
    }
    .details-box {
        background-color: #dfdede;
        padding: 20px;
        border-radius: 10px;
        display: flex;
        justify-content: center;
    }
</style>

<div class="container w-75">
    <h2 class="text-center font-navy font-bold py-5"><i class="fa-solid fa-exclamation"></i> Reservation Confirmation</h2>
    <div class="mt-3 py-3 details-box">
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
                <button type="button" class="btn btn-confirm">Confirm</button>
            </div>
        </div>
    </div>
</div>
@endsection