@extends('layouts.admin')

@section('title', 'Admin | Edit Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Edit Profile --}}
            <div class="card shadow-sm p-4 rounded-4 mb-5">
                <div class="card-body">
                    <div class="h3 mt-1 mb-5"><i class="fa-solid fa-pen-to-square pe-3 fa-lg"></i>Edit Admin Profile</div>

                    {{-- Add action --}}
                    <form method="POST" action="#">
                    @csrf

                    {{-- Name --}}
                    <div class="row">
                        <label for="name" class="form-label">{{ __('Full Name') }}</label>
                    </div>

                    <div class="row mb-4">
                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- E-MAIL --}}
                    <div class="row">
                        <label for="email" class="form-label">{{ __('E-mail') }}</label>
                    </div>

                    <div class="row mb-5">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-1">
                        <div class="col">
                            {{-- Add Link --}}
                            <a href="#" role="button" class="btn btn-cancel w-100">
                                {{ __('Cancel') }}
                            </a>
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-blue w-100">
                                {{ __('Save Profile') }}
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            {{-- Update Password --}}
            <div class="card shadow-sm p-4 rounded-4">
                <div class="card-body">
                    <div class="h3 mt-1 mb-5"><i class="fa-solid fa-key pe-3 fa-lg"></i>Update Admin Password</div>

                    {{-- Add action --}}
                    <form method="POST" action="#">
                    @csrf

                    {{-- Current PASSWORD --}}
                    <div class="row">
                        <label for="current-password" class="form-label">{{ __('Current Password') }}</label>
                    </div>

                    <div class="row mb-4">
                        <input id="current-password" type="password" class="form-control @error('current-password') is-invalid @enderror" name="current_password" required autocomplete="current-password">

                        @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <label for="new-password" class="form-label">{{ __('New Password') }}</label>
                    </div>

                    <div class="row mb-4">
                        <input id="new-password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="">

                        @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <label for="comfirm-new-password" class="form-label">{{ __('Confirm New Password') }}</label>
                    </div>

                    <div class="row mb-5">
                        <input id="confirm-new-password" type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" required autocomplete="">

                        @error('new_password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-1">
                        <div class="col">
                            {{-- Add Link --}}
                            <a href="#" role="button" class="btn btn-cancel w-100">
                                {{ __('Cancel') }}
                            </a>
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-blue w-100">
                                {{ __('Update Password') }}
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br>
@endsection
