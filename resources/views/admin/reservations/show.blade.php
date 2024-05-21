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
                            <input type="text" name="daterange" placeholder="Choose Period" class="form-control" value="{{ $daterange }}">
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
                        <th>Status</th>
                        <th></th>
                        </tr>
                </thead>
                <tbody class="text-center">
                    @forelse ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->id }}</td>
                            <td>{{ $reservation->user_id }}</td>
                            <td>{{ $reservation->user->name }}</td>
                            <td>{{ (new DateTime($reservation['date']))->format('F j, Y (D)') }}</td>
                            <td>{{ $reservation->area->name }}</td>
                            <td>{{ $reservation->area->attribute->name }}</td>
                            <td>${{ $reservation->fee_log }}</td>
                            <td>
                                @if ((new DateTime($reservation['date']))->format('Y-m-d') < date('Y-m-d'))
                                    <i class="fa-solid fa-circle text-black"></i>&nbsp; Past
                                @elseif ($reservation->trashed())
                                    <i class="fa-regular fa-circle text-secondary"></i>&nbsp; Inactive
                                @else
                                    <i class="fa-solid fa-circle text-success"></i>&nbsp; Active
                                @endif
                            </td>
                            <td>
                                @if ((new DateTime($reservation['date']))->format('Y-m-d') >= date('Y-m-d'))
                                    @if ($reservation->trashed())
                                        @if($reservation->user->trashed())
                                            <i class="fa-solid fa-ban mx-1"></i>
                                        @else
                                            <button type="button" class="btn btn-sm text-primary" data-bs-toggle="modal" data-bs-target="#activate-reservation-{{ $reservation->id }}">
                                                <i class="fa-solid fa-rotate-left mx-1"></i>
                                            </button>
                                            @include('admin.reservations.modal.activate', ['reservation' => $reservation])
                                        @endif
                                    @else
                                        <button type="button" class="btn btn-sm text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-reservation-{{ $reservation->id }}">
                                            <i class="fa-solid fa-trash-can mx-1"></i>
                                        </button>
                                        @include('admin.reservations.modal.deactivate', ['reservation' => $reservation])
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No relevant data exists.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-2">
        {{ $reservations->appends(request()->query())->links() }}
    </div>
@endsection
