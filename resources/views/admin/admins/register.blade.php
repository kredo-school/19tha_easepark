@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="h3 mb-2"><i class="fa-solid fa-user-plus pe-3 fa-lg"></i>Register New Admin</div>

            {{-- Add action --}}
            <form method="POST" action="#">
            @csrf

            {{-- Name --}}
            <div class="row">
                <label for="name" class="form-label">{{ __('Full Name') }}</label>
            </div>

            <div class="row mb-2">
                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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

            <div class="row mb-2">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row">
                <label for="verify-email" class="form-label">{{ __('Verify E-mail') }}</label>
            </div>

            <div class="row mb-2">
                <input id="verify-email" type="verify-email" class="form-control @error('verify-email') is-invalid @enderror" name="verify-email" required autocomplete="verify-email">

                @error('verify-email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="row">
                <label for="password" class="form-label">{{ __('Password') }}</label>
            </div>

            <div class="row mb-2">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row">
                <label for="comfirm-password" class="form-label">{{ __('Confirm Password') }}</label>
            </div>

            <div class="row mb-3">
                <input id="confirm-password" type="password" class="form-control @error('confirm-password') is-invalid @enderror" name="confirm-password" required autocomplete="current-password">

                @error('confirm-password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="col">
                    {{-- Add Link --}}
                    <a href="#" role="button" class="btn btn-cancel w-100">
                        {{ __('Cancel') }}
                    </a>
                </div>

                <div class="col">
                    <button type="submit" class="btn btn-blue w-100">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection