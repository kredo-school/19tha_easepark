@extends('layouts.admin')

@section('title', 'admin:fee_edit')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="col-auto lato-bold p-2 "><i class="fa-solid fa-pen-to-square mx-2"></i>Edit Fee</h2>
                <div class="card p-4">
                    <div class="card-body">
                        <form action="{{ route('admin.fees.update', ['id' => $fee->id]) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="name" class="form-label">Fee Name</label>
                                <input type="text" name="name" class="form-control mb-4" id="name"
                                    value="{{ old('name', $fee->name) }}">
                                @error('name')
                                    <div class="text-danger small">{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="fee" class="form-label">Amount of fee</label>
                                <input type="number" step="0.01" name="fee" class="form-control mb-4" id="fee"
                                    value="{{ old('fee', $fee->fee) }}">

                                @error('fee')
                                    <div class="text-danger small">{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <a href="{{ route('admin.fees.show') }}"
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
