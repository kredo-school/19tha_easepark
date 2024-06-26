@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

    <div class="my-5">
        <div class="row w-25 mx-auto">
            <div class="col card shadow-sm mx-auto py-2">
                <h2 class="lato-bold mx-auto my-2">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit Profile
                </h2>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <label for="name" class="form-label fw-bold">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control mb-3"
                        value="{{ old('name', $user->name) }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" name="email" id="email" class="form-control mb-3"
                        value="{{ old('email', $user->email) }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label for="phone_number" class="form-label fw-bold">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control mb-3"
                        value="{{ old('phone_number', $user->phone_number) }}">
                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label for="plate-number" class="form-label fw-bold">Plate Number</label>
                    <input type="text" name="plate_number" id="plate-number" class="form-control mb-3"
                        value="{{ old('plate_number', $user->plate_number) }}">
                    @error('plate_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label class="form-label fw-bold">Attribute</label>
                    <div class="d-flex flex-wrap align-items-center">
                        @foreach ($all_attributes as $attribute)
                            <div class="form-check mx-3">
                                <input type="radio" name="attribute" id="attribute-{{ $attribute->name }}"
                                    class="form-check-input" value="{{ $attribute->id }}"
                                    {{ $user->attribute_id == $attribute->id ? 'checked' : '' }}>
                                <label class="form-check-label" for="attribute-{{ $attribute->name }}">
                                    {{ $attribute->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('attribute')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="mt-4 button-group text-center">
                        <a href="{{ route('profile.show', ['id' => Auth::user()->id]) }}"
                            class="btn btn-cancel me-2">Cancel</a>
                        <button type="submit" class="btn btn-blue">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-2 mb-5">
        <div class="row w-25 mx-auto">
            <div class="col card shadow-sm mx-auto py-2">
                <h2 class="lato-bold mx-auto my-2">
                    <i class="fa-solid fa-key"></i>
                    Update Password
                </h2>
                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf

                    <label for="old-password" class="form-label fw-bold">Old Password</label>
                    <input type="password" name="old_password" id="old-password" class="form-control mb-3">
                    @if (session('incorrect_old_password'))
                        <span class="d-block small text-danger">{{ session('incorrect_old_password') }}</span>
                    @endif
                    @error('old_password')
                        <span class="d-block small text-danger">{{ $message }}</span>
                    @enderror


                    <label for="new-password" class="form-label fw-bold">New Password</label>
                    <input type="password" name="new_password" id="new-password" class="form-control mb-3">
                    @if (session('same_password_error'))
                        <span class="d-block small text-danger">{{ session('same_password_error') }}</span>
                    @endif
                    @error('new_password')
                        <span class="d-block small text-danger">{{ $message }}</span>
                    @enderror

                    <label for="new-password-confirmation" class="form-label fw-bold">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" id="new-password-confirmation"
                        class="form-control mb-3">
                    @error('new_password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="mt-4 button-group text-center">
                        <a href="{{ route('profile.show', ['id' => Auth::user()->id]) }}"
                            class="btn btn-cancel me-2">Cancel</a>
                        <button type="submit" class="btn btn-blue">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
