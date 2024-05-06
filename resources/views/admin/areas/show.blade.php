@extends('layouts.admin')

@section('title', 'Admin:Areas')

@section('content')
    <div class="my-1">
        <button type="button" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#registerArea">
            <i class="fa-solid fa-circle-plus"></i> Register New Area
        </button>
    </div>
    @include('admin.areas.modal.register')
    <div class="card border">
        <div class="card-header bg-light">
            <div class="row d-flex justify-content-center align-items-center">
                <h3 class="col-md-6 card-title mt-1">
                    <i class="fa-solid fa-map-marked-alt"></i> Areas
                </h3>
                <div class="col-md-5  me-1">
                    <form action="#" class="ms-auto">
                        <div class="input-group">
                            <input type="search" name="search" placeholder="Search Areas" value=""
                                class="form-control form-control-sm">
                            <button type="submit" class="btn bg-dark text-white border" aria-label="Search Areas"><i
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
                            <th>Area Name</th>
                            <th>Type</th>
                            <th>Fee</th>
                            <th>Fee Name</th>
                            <th>Address</th>
                            <th>Max Number</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Add: backend --}}
                        @foreach ($areas as $area)
                            <tr>
                                <td>{{ $area['id'] }}</td>
                                <td>{{ $area['area_name'] }}</td>
                                <td>{{ $area['type'] }}</td>
                                <td>${{ $area['fee'] }}</td>
                                <td>{{ $area['fee_name'] }}</td>
                                <td>{{ $area['address'] }}</td>
                                <td>{{ $area['max_number'] }}</td>
                                <td class="text-center">
                                    <a href="{{route('admin.areas.edit')}}"><span class="text-warning me-2"><i class="fa-solid fa-pen-to-square"></i></span></a>
                                    <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#delete-area"><span class="text-danger"><i class="fa-solid fa-trash-can"></i></span></button>
                                </td>                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('admin.areas.modal.delete')
            </div>
        </div>
    </div>
@endsection
