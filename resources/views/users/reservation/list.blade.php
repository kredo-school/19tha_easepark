@extends('layouts.app')

@section('title', 'All Confirmed Reservation')

@section('content')
<script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
@vite(['resources/js/manageList.js'])

<div class="container w-75 mt-3">
    
    <div class="row mb-2">
        <div class="col">
            <h4 class="float-start"><i class="fa-solid fa-list p-2"></i>Reservation List</h4>
            <div class="float-end">
                <select name="filter-list" id="filter-list" class="form-select text-center" >
                    <option value="all">All</option>
                    <option value="upcoming_reservations_all">Upcoming Reservations(All)</option>
                    <option value="upcoming_reservations_one_month">Upcoming Reservations(One Month)</option>
                    <option value="upcoming_reservations_one_week">Upcoming Reservations(One Week)</option>
                    <option value="past_reservations_all">Past Reservations(All)</option>
                    <option value="past_reservations_one_month">Past Reservations(One Month)</option>
                    <option value="past_reservations_one_week">Past Reservations(One Week)</option>
                </select>
            </div>
        </div>
    </div>
    <!-- Table -->
    <table class="table table-responsive">
        <thead>
            <tr class="table-info">
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Area</th>
                <th scope="col" class="text-center">Date</th>
                <th scope="col" class="text-center">Type</th>
                <th scope="col" class="text-center">Fee</th>
                <th scope="col" class="text-center">PDF Export</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="reservation-list-data">
            {{-- List of reservations are displayed HERE based on the filter selected. --}}
        </tbody>
    </table>
    <div id="pagination" class="d-flex justify-content-center"></div>
    @include('users.reservation.modal.delete')
</div>
@endsection