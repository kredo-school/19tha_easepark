@extends('layouts.app')

@section('title', 'index')

@section('content')

    @if (session('success_delete'))
    <div class="alert alert-success text-center w-50 mx-auto ">
        {{ session('success_delete') }}
    </div>
    @endif

    <div class="index-background py-3">
        <main class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form action="#" method="post">
                        @csrf
                        <div class="row mb-1">
                            <label for="type"
                                class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Choose Type') }}</label>
                            <div class="col-md-4">
                                {{-- Add : atrribute --}}
                                <select class="form-select" name="type" id="type" required>
                                    <option value="">Select Your Type</option>
                                    <option value="#">Option 1</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#guest-test">Reserve</button>
                            </div>
                            @include('users.home.modal.register-guidance')

                        </div>
                        {{-- error --}}
                        @error('type')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </form>
                    <div class="row justify-content-center w-100">
                        <div class="col-md-7">
                            <div class="my-2 bg-white rounded p-2">
                                <div id='calendar'></div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </main>
    </div>
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/fullcalendar-6.1.8.js')}}"></script>
@endsection
