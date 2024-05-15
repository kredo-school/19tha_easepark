@extends('layouts.app')
@section('title', 'Reservation Confirmation')
@section('content')
<script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
@vite(['resources/js/processReservation.js'])

<div class="container w-75 pb-3">
    <h2 class="text-center font-navy font-bold pt-3"><i class="far fa-calendar-check"></i> Reservation Confirmation</h2>
    <div class="mt-3 py-2 details-box">
        <div class="w-75">
            <h4 class="py-2 font-bold">Choose Type: <span id="attribute-name"></span></h4>
            <h4 class="py-3 font-bold">Details: </h4>

            <ul class="record-list" id="reservation-list">
                <!-- The list items will be added here by JavaScript -->
            </ul>
            <div class="total-info">
                <span>Total:</span>
                <span id="total-fee">$</span>
            </div>
            <div class="mt-5 button-group">
                <a href="{{route('homepage')}}" class="btn btn-cancel me-2">Cancel</a>
                <button type="button" class="btn btn-blue">Confirm</button>
            </div>
        </div>
    </div>
</div>
@endsection

