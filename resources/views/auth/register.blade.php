@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-50">
            <div class="card border-0">
                <div class="card-header border-0 bg-light" style="font-size: 1.5rem; font-weight: bold;">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="#">
                        {{-- "{{ route('register') }}" will be include in the above action later --}}
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label text-muted">{{ __('Full Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label text-muted">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email-verify" class="form-label text-muted">{{ __('Verify Email') }}</label>
                            <input id="email-verify" type="email" class="form-control @error('email-verify') is-invalid @enderror" name="email-verify" value="{{ old('email-verify') }}" required autocomplete="email-verify">
                            @error('email-verify')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-muted">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label text-muted">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="mb-3">
                            <label for="phone-number" class="form-label text-muted">{{ __('Phone Number') }}</label>
                            <input id="phone-number" type="text" class="form-control @error('phone-number') is-invalid @enderror" name="phone-number" required autocomplete="new-phone-number">
                            @error('phone-number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="plate-number" class="form-label text-muted">{{ __('Plate Number') }}</label>
                            <input id="plate-number" type="text" class="form-control @error('plate-number') is-invalid @enderror" name="plate-number" required autocomplete="new-plate-number">
                            @error('plate-number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">{{ __('Attribute') }}</label>
                            <div class="d-flex flex-wrap">
                                @foreach ($attributes as $attribute)
                                    <div class="form-check mx-3">
                                        <input class="form-check-input" type="radio" name="attribute" id="attribute-{{ $attribute }}" value="{{ $attribute }}">
                                        <label class="form-check-label" for="attribute-{{ $attribute }}">
                                            {{ $attribute }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="text-center">
                                <button type="submit" class="btn btn-blue w-75 mt-5">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
