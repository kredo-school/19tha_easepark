@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="h3 mt-5 mb-3">{{ __('Login') }}</div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                </div>

                <div class="row mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                </div>

                <div class="row mb-4">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row my-3">
                    <button type="submit" class="btn btn-blue">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>

            <div class="row">
                <p class="text-center">New to EasePark? <a href="#">Create an Account</a></p>
            </div>
        </div>
    </div>
</div>
@endsection