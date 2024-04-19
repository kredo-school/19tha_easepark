@extends('layouts.app')

@section('title', 'All Confirmed Reservation')

@section('content')

<div class="container w-80 mt-3">
    <div class="row mb-2">
        <div class="col">
            <h4 class="float-start"><i class="fa-solid fa-list"></i>Reservation List</h4>
            <div class="float-end">
                <select name="list" id="list" class="form-select" >
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
    <table class="table">
        <thead>
            <tr class="table-info">
                <th scope="col">ID</th>
                <th scope="col">Area</th>
                <th scope="col">Date</th>
                <th scope="col">Type</th>
                <th scope="col">Fee</th>
                <th scope="col">PDF Export</th>
                <th scope="col"><i class="fa-solid fa-download"></i></th>
                <th scope="col"><i class="fa-solid trash"></i></th>
            </tr>
        </thead>
        <tbody>
            <!-- TODO :  foreach -->
            <tr>
                <th scope="row">1</th>
                <td>Area D, 2F</td>
                <td>March 18(Sun)</td>
                <td>Disability</td>
                <td>$20</td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Area A, 1F</td>
                <td>March 21(Wed)</td>
                <td>Disability</td>
                <td>$20</td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Area A, 1F</td>
                <td>March 22(Thu)</td>
                <td>Disability</td>
                <td>$20</td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td>Area A, 1F</td>
                <td>March 23(Fri)</td>
                <td>Disability</td>
                <td>$20</td>
                <td></td>
            </tr>
        </tbody>
    </table>
@endsection