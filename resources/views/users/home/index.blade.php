@extends('layouts.app')

@section('title', 'index')

@section('content')
<script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/fullcalendar-6.1.8.js')}}"></script>
@vite(['resources/js/manageCalendar.js'])

@php
$userAttributeId = null;
if (auth()->check() && auth()->user()->attribute) {
    $userAttributeId = auth()->user()->attribute->id;
}
@endphp

<script>
    var userIsAuthenticated = @json(auth()->check());
    var userAttributeId = @json($userAttributeId);
</script>

    <div class="index-background py-3">
        <main class="container">
            {{-- Success alert for deletion --}}
            @if (session('success_delete'))
            <div class="alert alert-danger success-alert text-center w-50 mt-2 mx-auto" id="delete-success-alert">
                {{ session('success_delete') }}
            </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-10">
                        <div class="row mb-1">
                            <label for="type"
                                class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Choose Type') }}</label>
                            <div class="col-md-4">
                                <select class="form-select" name="attribute-selection" id="attribute-selection" required>
                                    <option selected disabled value="not-selected">Select Your Type</option>
                                    @foreach($attributes as $attribute)
                                        <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" id="reserve-button" class="btn btn-blue">Reserve</button>
                            </div>

                            @if(!Auth::check())
                                @include('users.home.modal.register-guidance')
                            @endif

                        </div>
                    <div class="row justify-content-center w-100">
                        <div class="col-md-7">
                            <div class="my-2 bg-white rounded p-2" id='calendar-range'>
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
