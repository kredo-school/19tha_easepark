@extends('layouts.admin')

@section('title', 'Admin | Users')

@section('content')
    <div class="card border">
        <div class="card-header bg-light">
            <div class="row d-flex justify-content-center align-items-center">

                <h3 class="col-md-6 card-title mt-1">
                    <i class="fa-solid fa-people-group"></i> Users
                </h3>
                <div class="col-md-5  me-1">
                    <form action="{{ route('admin.users.show') }}" method="GET" class="ms-auto">
                        <div class="input-group">
                            <input type="search" name="search" placeholder="Search by name or phone"
                                value="{{ $search }}" class="form-control form-control-sm">
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
                        <th>Registered</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->plate_number }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ date('M d,Y', strtotime($user->created_at)) }}</td>
                            <td>
                                @if ($user->trashed())
                                    <i class="fa-regular fa-circle text-secondary"></i>&nbsp; Inactive
                                @else
                                    <i class="fa-solid fa-circle text-success"></i>&nbsp; Active
                                @endif
                            </td>
                            <td>
                                @if (Auth::user()->id !== $user->id)
                                    @if ($user->trashed())
                                            <button type="button" class="btn text-primary" data-bs-toggle="modal"
                                                data-bs-target="#activate-user-{{ $user->id }}">
                                                <i class="fa-solid fa-rotate-left"></i>
                                            </button>
                                            @include('admin.users.modal.activate', ['user' => $user])
                                        </form>
                                    @else
                                        <button type="button" class="btn text-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete-user-{{ $user->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    @endif
                                    @include('admin.users.modal.delete', ['user' => $user])
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <div class="d-flex justify-content-center mt-2">
        {{ $all_users->links() }}
    </div>
@endsection
