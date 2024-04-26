@extends('layouts.admin')

@section('title', 'Admin:Reservations')

@section('content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
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

                    <script>
                        $(function() {
                            $('input[name="daterange"]').daterangepicker({
                                autoUpdateInput: false,
                                applyButtonClasses: "btn-blue",
                                cancelButtonClasses: "btn-cancel"
                            });

                            $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
                                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                                $('#start-date').val(picker.startDate.format('YYYY/MM/DD'));
                                $('#end-date').val(picker.endDate.format('YYYY/MM/DD'));
                            });

                            $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
                                $(this).val('');
                            });
                        });
                    </script>
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
                                    <span class="text-danger"><i class="fa-solid fa-trash-can mx-1"></i></span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
