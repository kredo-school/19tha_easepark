@extends('layouts.admin')

@section('title', 'admin:fee_edit')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="col-auto lato-bold p-2 "><i class="fa-solid fa-pen-to-square mx-2"></i>Edit Fee</h2>
                <div class="card p-4">
                    <form action="#" method="post">
                        @csrf
                        @method('PATCH')

                        <label for="fee_name" class="form-label">Fee Name</label>
                        <input type="text" name="fee_name" class="form-control mb-3" id="fee_name">

                        @error('fee_name')
                            <div class="text-danger small">{{ $message }}
                            </div>
                        @enderror

                        <label for="amount" class="form-label">Fee Name</label>
                        <input type="text" name="amount" class="form-control mb-3" id="amount">

                        @error('amount')
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


    @endsection
