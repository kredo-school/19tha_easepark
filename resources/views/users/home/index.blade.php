@extends('layouts.app')

@section('title', 'index')

@section('content')
<style>
.fc-daygrid-event {
    background: transparent !important;
    border: none !important;
    text-align: center !important;
    font-weight: bold !important;
    font-size: 1.2em !important;
}
</style>
    <div class="index-background">
        <main class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 my-5">
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
                                    var selectedDates = []; // array to store the selected dates

                                    var calendarEl = document.getElementById('calendar');
                                    var calendar = new FullCalendar.Calendar(calendarEl, {
                                        initialView: 'dayGridMonth',
                                        selectable: true,
                                        events: function(fetchInfo, successCallback, failureCallback) {
                                            var start = fetchInfo.startStr; // start date of the current view
                                            var end = fetchInfo.endStr; // end date of the current view
                                            var dates = getDates(new Date(start), new Date(end)); // get all dates in the current view

                                            // map the dates to events
                                            var events = dates.map(date => {
                                                var dateStr = date.toISOString().substring(0, 10); // get the date string in 'YYYY-MM-DD' format
                                                var title = @json($data['availableDate']).includes(dateStr) ? 'fa-circle' : 'fa-xmark';
                                                return { title: title, start: dateStr };
                                            });

                                            successCallback(events);
                                        },
                                        eventContent: function(arg) {
                                            var color = arg.event.title === 'fa-circle' ? 'green' : 'red';
                                            return { html: `<i class="fa-solid ${arg.event.title} custom-event" style="color: ${color};"></i>` };
                                        },
                                        dateClick: function(info) {
                // add the clicked date to the selectedDates array if it's not already selected
                // otherwise, remove it from the selectedDates array
                var index = selectedDates.indexOf(info.dateStr);
                if (index === -1) {
                    selectedDates.push(info.dateStr);
                } else {
                    selectedDates.splice(index, 1);
                }
            }
                                    });
                                    calendar.render();
                                });
                                // when the user clicks "Reserve", pass the selected dates
                                document.querySelector('button[type="submit"]').addEventListener('click', function(e) {
                                    e.preventDefault(); // prevent the form from submitting

                                    // pass the selected dates
                                    console.log(selectedDates);
                                });

                                // helper function to get all dates between two dates
                                function getDates(startDate, endDate) {
                                    var dates = [];
                                    var currentDate = startDate;
                                    while (currentDate <= endDate) {
                                        dates.push(new Date(currentDate));
                                        currentDate.setDate(currentDate.getDate() + 1);
                                    }
                                    return dates;
                                }
                            </script>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        </main>
    </div>
@endsection
