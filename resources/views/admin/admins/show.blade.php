@extends('layouts.admin')

@section('title', 'Admin: Registered Admins')

@section('content')
<a class="btn btn-green my-2" role="button" href="{{ route('admin.admins.register') }}">
    <i class="fa-solid fa-circle-plus me-2 btn-lg"></i>Register New Admin
</a>
    <div class="card mb-3">
        <div class="card-header bg-light">
            <div class="row d-flex justify-content-center">

                <h3 class="col-md-6 card-title my-3">
                    <i class="fa-solid fa-users-gear me-3 fa-lg"></i>Registered Admins
                </h3>
                <div class="col-md-5 my-auto">
                    <form action="{{ route("admin.admins.show") }}">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control form-control-sm" placeholder="Search Admin" value="{{ $search }}">

                            <button type="submit" class="btn bg-dark text-white border" aria-label="Search Users"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="card-body px-0 py-0 mb-2">
            <table class="table table-hover align-middle border-0">
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
                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $admin['id'] }}</td>
                            <td>{{ $admin['name'] }}</td>
                            <td>{{ $admin['email'] }}</td>
                            <td class="text-center">
                                <a href="{{route('admin.admins.edit')}}"><i class="text-warning fa-solid fa-pen-to-square fa-lg me-4"></i></a>
                                <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#delete-admin"><span class="text-danger"><i class="fa-solid fa-trash-can"></i></span></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('admin.admins.modal.delete')
    </div>
    <div class="d-flex justify-content-center">{{ $admins->links() }}</div>
@endsection