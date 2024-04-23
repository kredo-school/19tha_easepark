@extends('layouts.admin')

@section('title', 'Admin:Fees')

@section('content')
    <div class="my-1">
        <button type="button" class="btn btn-green">
            <i class="fa-solid fa-circle-plus"></i> Register New Fee
        </button>
    </div>
    <div class="card border w-75">
        <div class="card-header bg-light">
            <div class="row d-flex justify-content-center align-items-center">

                <h3 class="col-md-6 card-title mt-1">
                    <i class="fa-solid fa-credit-card"></i> Fees
                </h3>
                <div class="col-md-5  me-1">
                    <form action="#" class="ms-auto">
                        <div class="input-group">
                            <input type="search" name="search" placeholder="Search Fees" value=""
                                class="form-control form-control-sm">
                            <button type="submit" class="btn bg-dark text-white border" aria-label="Search Fees"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="card-body px-0 py-0 mb-2">
            <div class="table-responsive">
                <table class="table table-hover align-middle border-0">
                    <thead class="small table-info">
                        <tr>
                            <th class="fw-bold">ID</th>
                            <th>Fee Name</th>
                            <th>Amount of Fee</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Add: backend --}}
                        @foreach ($fees as $fee)
                            <tr>
                                <td>{{ $fee['id'] }}</td>
                                <td>{{ $fee['fee_name'] }}</td>
                                <td>${{ $fee['amount_of_fee'] }}</td>
                                <td>
                                    <span class="text-warning"><i class="fa-solid fa-pen-to-square mx-1"></i></span>
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
