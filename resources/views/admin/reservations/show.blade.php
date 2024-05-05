@extends('layouts.admin')

@section('title', 'Admin:Reservations')

@section('content')

{{-- Downloaded DateRangePicker(for search calendar) --}}
<script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/daterangepicker.min.js') }}"></script>
@vite(['resources/js/managePeriod.js'])
<link rel="stylesheet" type="text/css" href="{{ asset('css/daterangepicker.css') }}" >

    <div class="card border">
        <div class="card-header bg-light">
            <div class="row d-flex justify-content-center align-items-center">

                <h3 class="col-md-6 card-title mt-1">
                    <i class="fa-solid fa-car"></i> User Reservation Overview
                </h3>
                <div class="col-md-5 me-1">
                    {{-- Add: backend --}}
                    <form action="{{route('admin.reservations.show')}}" class="ms-auto">
                        <div class="input-group">
                            <input type="text" name="daterange" placeholder="Choose Period" class="form-control">
                            <input type="hidden" name="start_date" id="start-date">
                            <input type="hidden" name="end_date" id="end-date">
                            <button type="submit" class="btn bg-dark text-white border" aria-label="Search Reservations">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body px-0 py-0 mb-2">
            <div class="table-responsive">
                <table class="table table-hover align-middle border-0">
                    <thead class="small table-info text-center">
                        <tr>
                            <th>Res. ID</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Date</th>
                            <th>Area</th>
                            <th>Type</th>
                            <th>Fee</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        {{-- Add: backend --}}
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation['res_id'] }}</td>
                                <td>{{ $reservation['user_id'] }}</td>
                                <td>{{ $reservation['user_name'] }}</td>
                                <td>{{ (new DateTime($reservation['date']))->format('F j, Y (D)') }}</td>
                                <td>{{ $reservation['area'] }}</td>
                                <td>{{ $reservation['type'] }}</td>
                                <td>${{ $reservation['fee'] }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm text-danger" data-bs-toggle="modal" data-bs-target="#delete-reservation">
                                        <i class="fa-solid fa-trash-can mx-1"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('admin.reservations.modal.delete')
            </div>
        </div>
    </div>
@endsection
