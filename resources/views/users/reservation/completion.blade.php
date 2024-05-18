@extends('layouts.app')
@section('title', 'Reservation Completion')
@section('content')
<script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
@vite(['resources/js/processReservation.js'])

<div class="container w-75 pb-3">
    <h2 class="text-center font-navy font-bold pt-3"><i class="fas fa-check-circle"></i> Reservation Completed !!</h2>
    <div class="mt-3 py-3 details-box">
        <div class="w-75">
            <h4 class="py-2 font-bold">Choose Type: <span id="attribute-name"></span></h4>
            <h4 class="py-3 font-bold">Details: </h4>

            <ul class="record-list" id="reservation-list">
                <!-- The list items will be added here by JavaScript -->
            </ul>

            <div class="total-info">
                <span>Total:</span>
                <span id="total-fee">
                    $ <!-- The total fee will be added here by JavaScript -->
                </span>
            </div>

            <div class="text-danger font-bold py-1" style="font-size: 1.5rem;">*Payment on site.</div>

            <div class="text-danger font-bold py-1" id="different-area-alert-reservationsToBeCompleted" style="font-size: 1.0rem; diplay: none;">
                * Please note that the same area was NOT be reserved for some of the consecutive dates due to lack of available spaces.
            </div>

            <div class="mt-2 button-group">
                <a href="{{route('homepage')}}" class="btn btn-cancel me-2">Back to Home</button>
                <a href="{{ route('reservation.list', Auth::user()->id) }}" class="btn btn-blue text-white">Reservation List</a>
            </div>
        </div>
    </div>
</div>
@endsection
