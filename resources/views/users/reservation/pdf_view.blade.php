@extends('layouts.app')
@section('title', 'PDF_view')
@section('content')
    <div class="container">
        <div class="my-3">
            <a href="{{ route('pdf_download', ['id' => $reservation->id]) }}" class="btn btn-blue text-white">Download PDF</a>
        </div>
        <div class="card py-1 px-1">
            <div class="card-body row d-flex flex-column align-items-center">
                <div class="mx-2 my-3">
                    <div class="col"></div>
                    <img src="{{ asset('images/8C8FAB4E-E713-45F0-839A-5064D27EDBAA.png') }}"
                         alt="Logo" class="img-fluid pdf_logo">

                    <div class="col">
                        <h1 class="mt-3 mb-0">Reservation List</h1>
                    </div>
                </div>
                <div class="mx-2">Download Date:  {{ date('Y-m-d') }}</div>
                <div class="mx-2">User Name: {{ Auth::user()->name }}</div>

                <div class="">
                    <table class="table">
                        <thead>
                            <tr class="table-secondary">
                                <th scope="col" class="text-center">ID</th>
                                <th scope="col" class="text-center">Area</th>
                                <th scope="col" class="text-center">Date</th>
                                <th scope="col" class="text-center">Type</th>
                                <th scope="col" class="text-center">Fee</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-center">{{ $reservation->id }}</th>
                                <td class="text-center">{{ $reservation->area->name }}</td>
                                <td class="text-center">{{ $reservation->date }}</td>
                                <td class="text-center">{{ $reservation->user->attribute->name }}</td>
                                <td class="text-center">${{ $reservation->fee_log }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
