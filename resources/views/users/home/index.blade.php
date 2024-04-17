@extends('layouts.app')

@section('title', 'index')

@section('content')
    <style>
        .background {
            position: relative;
            background-image: url('/images/pexels-k-howard-2220292.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(225, 225, 225, 0.8);
            z-index: 1;
        }

        .background main {
            position: relative;
            z-index: 2;
        }

        #calendar {
            height: 100%;
        }

    </style>

    <div class="background">
        <main class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 my-5">
                    <form action="#">
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
                                <button type="submit" class="btn btn-blue">Reserve</button>
                            </div>
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
