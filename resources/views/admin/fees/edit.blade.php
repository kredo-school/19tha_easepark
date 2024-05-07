@extends('layouts.admin')

@section('title', 'admin:fee_edit')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="col-auto lato-bold p-2 "><i class="fa-solid fa-pen-to-square mx-2"></i>Edit Fee</h2>
                <div class="card p-4">
                    <div class="card-body">
                        <form action="#" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                {{-- Add : backend --}}
                                <label for="fee_name" class="form-label">Fee Name</label>
                                <select class="form-select" name="fee_name" id="fee_name" required>
                                    <option value="">Select Fee Name</option>
                                    <option value="#">Option 1</option>
                                </select>
                                @error('fee_name')
                                    <div class="text-danger small">{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{-- Add : backend --}}
                                <label for="amount" class="form-label">Amount of fee</label>
                                <input type="number" name="amount" class="form-control mb-4" id="amount">

                                @error('amount')
                                    <div class="text-danger small">{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <a href="{{ route('admin.fees.show')}}" role="button"
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
