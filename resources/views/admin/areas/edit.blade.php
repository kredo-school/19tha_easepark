@extends('layouts.admin')

@section('title', 'admin:Area_edit')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="col-auto lato-bold p-2 "><i class="fa-solid fa-pen-to-square mx-2"></i>Edit Area</h2>
                <div class="card p-4">
                    <div class="card-body">
                        <form action="#" method="post">
                            @csrf
                            @method('PATCH')

                            <label for="area_name" class="form-label">Area Name</label>
                            {{-- Add : backend --}}
                            <input type="text" name="area_name" class="form-control mb-3" id="area_name">
                            @error('area_name')
                                <div class="text-danger small">{{ $message }}
                                </div>
                            @enderror

                            <label for="attribute" class="form-label">Attribute</label>
                            {{-- Add : backend --}}
                            <select class="form-select mb-3" name="attribute" id="attribute" required>
                                <option value="">Select Attribute</option>
                                <option value="#">Option 1</option>
                            </select>
                            @error('attribute')
                                <div class="text-danger small">{{ $message }}
                                </div>
                            @enderror

                            <label for="fee_name" class="form-label">Fee Name</label>
                            {{-- Add : backend --}}
                            <select class="form-select mb-3" name="fee_name" id="fee_name" required>
                                <option value="">Select Fee Name</option>
                                <option value="#">Option 1</option>
                            </select>
                            @error('fee_name')
                                <div class="text-danger small">{{ $message }}
                                </div>
                            @enderror

                            <label for="address" class="form-label">Address</label>
                            {{-- Add : backend --}}
                            <input type="text" name="address" class="form-control mb-3" id="address">
                            @error('address')
                                <div class="text-danger small">{{ $message }}
                                </div>
                            @enderror

                            <label for="max_number" class="form-label">Max Number</label>
                            {{-- Add : backend --}}
                            <select class="form-select mb-5" name="max_number" id="max_number" required>
                                <option value="">Select Max Number</option>
                                <option value="#">Option 1</option>
                            </select>
                            @error('max_number')
                                <div class="text-danger small">{{ $message }}
                                </div>
                            @enderror

                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <a href="#" role="button"
                                        class="btn btn-outline-secondary w-100">{{ __('Cancel') }}</a>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-blue w-100">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br><br><br>

@endsection
