@extends('layouts.admin')

@section('title', 'Admin: Registered Admins')

@section('content')
    <a class="btn btn-green my-2" role="button">
        <i class="fa-solid fa-circle-plus me-2 btn-lg"></i>Register New Admin
    </a>

    <div class="card">
        <div class="card-header bg-light">
            <div class="row d-flex justify-content-center">

                <h3 class="col-md-6 card-title my-3">
                    <i class="fa-solid fa-users-gear me-3 fa-lg"></i>Registered Admins
                </h3>
                <div class="col-md-5 me-1">
                    <form action="#" class="ms-auto my-3">
                        <div class="input-group">
                            <input type="search" name="search" placeholder="Search Admins" value=""
                                class="form-control form-control-sm">
                            <button type="submit" class="btn bg-dark text-white border" aria-label="Search Users"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="card-body px-0 py-0 mb-2">
            <table class="table table-hover align-middle border-0 text-center">
                <thead class="small table-info">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>E-mail</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Add: backend --}}
                    <tr>
                        <td>{{ 1 }}</td>
                        <td>Tom Cruise</td>
                        <td>tom@cruise.com</td>
                        <td>
                            <a href="#"><i class="text-warning fa-solid fa-pen-to-square fa-lg me-4"></i></a>
                            <a href="#"><i class="fa-solid fa-trash-can text-danger fa-lg"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
