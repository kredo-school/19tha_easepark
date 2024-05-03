@extends('layouts.app')

@section('title', 'index')

@section('content')
    <div class="index-background py-3">
        <main class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form action="#" method="post">
                        @csrf
                        <div class="row mb-3">
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
                    <div class="row justify-content-center">
                        <div class="col-md-7">
                            <div class="my-5 bg-white rounded px-3 py-3">
                                <div id='calendar'></div>
                            </div>
                            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var calendarEl = document.getElementById('calendar');
                                    var calendar = new FullCalendar.Calendar(calendarEl, {
                                        initialView: 'dayGridMonth',
                                    });
                                    calendar.render();
                                });
                            </script>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        </main>
    </div>
@endsection
