@extends('layouts.admin')

@section('title', 'Admin:Users')

@section('content')
    <div class="card border">
        <div class="card-header bg-light">
            <div class="row d-flex justify-content-center align-items-center">

                <h3 class="col-md-6 card-title mt-1">
                    <i class="fa-solid fa-people-group"></i> Users
                </h3>
                <div class="col-md-5  me-1">
                    <form action="#" class="ms-auto">
                        <div class="input-group">
                            <input type="search" name="search" placeholder="Search Users" value=""
                                class="form-control form-control-sm">
                            <button type="submit" class="btn bg-dark text-white border" aria-label="Search Users"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="card-body px-0 py-0 mb-2">
            <table class="table table-hover align-middle border-0">
                <thead class="small table-info">
                    <tr>
                        <th class="fw-bold">ID</th>
                        <th>Full Name</th>
                        <th>Plate Number</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Add: backend --}}
                    <tr class="">
                        <td>1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button class="dropdown-item text-danger" data-bs-toggle="modal"
                            data-bs-target="#delete-user">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            @include('admin.users.modal.delete')
        </div>
    </div>
@endsection
