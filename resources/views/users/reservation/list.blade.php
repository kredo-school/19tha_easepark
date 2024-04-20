@extends('layouts.app')

@section('title', 'All Confirmed Reservation')

@section('content')

<div class="container w-75 mt-3">
    <div class="row mb-2">
        <div class="col">
            <h4 class="float-start"><i class="fa-solid fa-list p-2"></i>Reservation List</h4>
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
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Area</th>
                <th scope="col" class="text-center">Date</th>
                <th scope="col" class="text-center">Type</th>
                <th scope="col" class="text-center">Fee</th>
                <th scope="col" class="text-center">PDF Export</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- TODO :  foreach -->
            <tr>
                <th scope="row" class="text-center">1</th>
                <td class="text-center">Area D, 2F</td>
                <td class="text-center">March 18(Sun)</td>
                <td class="text-center">Disability</td>
                <td class="text-center">$20</td>
                <td class="text-center"><i class="fa-solid fa-download"></i></td>
                <td class="text-center"><span class="text-danger"><i class="fa-solid fa-trash-can"></span></td>
            </tr>
            <tr>
                <th scope="row" class="text-center">2</th>
                <td class="text-center">Area A, 1F</td>
                <td class="text-center">March 18(Sun)</td>
                <td class="text-center">Disability</td>
                <td class="text-center">$20</td>
                <td class="text-center"><i class="fa-solid fa-download"></i></td>
                <td class="text-center"><span class="text-danger"><i class="fa-solid fa-trash-can"></span></td>
            </tr>
            <tr>
                <th scope="row" class="text-center">3</th>
                <td class="text-center">Area A, 1F</td>
                <td class="text-center">March 22(Thu)</td>
                <td class="text-center">Disability</td>
                <td class="text-center">$20</td>
                <td class="text-center"><i class="fa-solid fa-download"></i></td>
                <td class="text-center"><span class="text-danger"><i class="fa-solid fa-trash-can"></span></td>
            </tr>
            <tr>
                <th scope="row" class="text-center">4</th>
                <td class="text-center">Area D, 2F</td>
                <td class="text-center">March 23(Fri)</td>
                <td class="text-center">Disability</td>
                <td class="text-center">$20</td>
                <td class="text-center"><i class="fa-solid fa-download"></i></td>
                <td class="text-center"><span class="text-danger"><i class="fa-solid fa-trash-can"></span></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection