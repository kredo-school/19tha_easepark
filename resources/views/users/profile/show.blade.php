@extends('layouts.app')

@section('title', 'Show Profile')

@section('content')

    <div class="mt-5 d-flex justify-content-center">
        <div class="row justify-content-between">
            <div class="col-auto card shadow-sm mx-auto">
                <div class="row mx-auto my-3">
                    <h2 class="col-auto lato-bold">
                        <i class="fa-solid fa-user"></i>
                        Your Profile
                    </h2>
                    <a href="{{ route('profile.edit') }}" class="col btn btn-blue my-auto">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Edit Profile
                    </a>
                </div>
                <div class="row mx-auto">
                    <div class="col-auto fs-5 fw-bold">
                        <p>Full Name</p>
                        <p>Email</p>
                        <p>Phone Number</p>
                        <p>Plate Number</p>
                        <p>Attribute</p>
                    </div>
                    <div class="col-auto fs-5">
                        <p>{{ $user->name }}</p>
                        <p>{{ $user->email }}</p>
                        <p>{{ $user->phone_number }}</p>
                        <p>{{ $user->plate_number }}</p>
                        <p>{{ $user->attribute->name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-auto me-3 my-3">
                <button class="btn btn-red" data-bs-toggle="modal" data-bs-target="#delete-profile">
                    <i class="fa-solid fa-trash-can"></i>
                    Delete Account
                </button>
            </div>
            @include('users.profile.modal.delete')
        </div>
    </div>

@endsection



