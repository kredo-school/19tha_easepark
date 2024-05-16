@extends('layouts.admin')

@section('title', 'admin:Area_edit')

@section('content')

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="col-auto lato-bold p-2 "><i class="fa-solid fa-pen-to-square mx-2"></i>Edit Area</h2>
                <div class="card p-4">
                    <div class="card-body">
                        <form action="{{ route('admin.areas.update', ['id' => $area->id]) }}" method="post">
                            @csrf
                            @method('PATCH')

                            <label for="name" class="form-label">Area Name</label>
                            <input type="text" name="name" class="form-control mb-3" id="name"
                                value="{{ old('name', $area->name) }}">
                            @error('name')
                                <div class="text-danger small">{{ $message }}
                                </div>
                            @enderror

                            <label for="attribute_id" class="form-label">Attribute</label>
                            <select class="form-select mb-3" name="attribute_id" id="attribute" required>
                                @foreach ($all_attributes as $attribute)
                                    <option value="{{ $attribute->id }}"
                                        {{ old('attribute_id', $area->attribute_id) == $attribute->id ? 'selected' : '' }}>
                                        {{ $attribute->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('attribute_id')
                                <div class="text-danger small">{{ $message }}
                                </div>
                            @enderror

                            <label for="fee_id" class="form-label">Fee Name</label>
                            <select class="form-select mb-3" name="fee_id" id="fee_name" required>
                                @foreach ($all_fees as $fee)
                                    <option value="{{ $fee->id }}"
                                        {{ old('fee_id', $area->fee_id) == $fee->id ? 'selected' : '' }}>
                                        {{ $fee->name }} : {{ $fee->fee }}</option>
                                @endforeach
                            </select>
                            @error('fee_id')
                                <div class="text-danger small">{{ $message }}
                                </div>
                            @enderror

                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control mb-3" id="address"
                                value="{{ old('address', $area->address) }}">
                            @error('address')
                                <div class="text-danger small">{{ $message }}
                                </div>
                            @enderror

                            <label for="max_num" class="form-label">Max Number</label>
                            <input type="number" name="max_num" class="form-control mb-3" id="max_number"
                                value="{{ old('max_num', $area->max_num) }}">
                            @error('max_num')
                                <div class="text-danger small">{{ $message }}
                                </div>
                            @enderror

                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <a href="{{ route('admin.areas.show') }}" role="button"
                                        class="btn btn-cancel w-100">{{ __('Cancel') }}</a>
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

@endsection
