@extends('layouts.app')

@section('title', 'show profile')

@section('content')

    <div class="mt-3">
        <div class="row justify-content-center">
            <div class="col-auto card shadow-sm mx-auto">
                <div class="row mx-auto my-3">
                    <h2 class="col-auto lato-bold">
                        <i class="fa-solid fa-user"></i>
                        Your Profile
                    </h2>
                    <a href="#" class="col btn btn-blue">
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
                        <p>John Doe</p>
                        <p>john@email.com</p>
                        <p>01-2345-6789</p>
                        <p>12-34</p>
                        <p>EV</p>
                    </div>
                </div>
            </div>
            <div class="col-auto me-3 my-3">
                <a href="#" class="btn btn-red">
                    <i class="fa-solid fa-trash-can"></i>
                    Delete Account
                </a>
            </div>
        </div>
    </div>

@endsection
