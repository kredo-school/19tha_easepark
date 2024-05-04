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
    color: black !important;
},

</style>
    <div class="index-background">
        <main class="">
            <div class="row justify-content-center w-100">
                <div class="justify-content-center my-5">
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
                            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
                            <script>
                                var selectedDates = []; // array to store the selected dates
                                // document.addEventListener('DOMContentLoaded', function() {
                                //     var calendarEl = document.getElementById('calendar');
                                //     var calendar = new FullCalendar.Calendar(calendarEl, {
                                //         initialView: 'dayGridMonth',
                                //         // selectable: true,
                                //         events: function(fetchInfo, successCallback, failureCallback) {
                                //             var start = fetchInfo.startStr; // start date of the current view
                                //             var end = fetchInfo.endStr; // end date of the current view
                                //             var dates = getDates(new Date(start), new Date(end)); // get all dates in the current view
                                //             // map the dates to events
                                //             var events = dates.map(date => {
                                //                 var dateStr = date.toISOString().substring(0, 10); // get the date string in 'YYYY-MM-DD' format
                                //                 var title = @json($data['availableDate']).includes(dateStr) ? 'fa-circle' : 'fa-xmark';
                                //                 return { title:title, start: dateStr };
                                //             });

                                //             successCallback(events);
                                //         },
                                //         eventContent: function(arg) {
                                //             var color = arg.event.title === 'fa-circle' ? 'green' : 'red';
                                //             return { html: `<i class="fa-solid ${arg.event.title} custom-event" style="color: ${color};"></i>` };
                                //         },
                                //         dateClick: function(info) {
                                //             // add the clicked date to the selectedDates array if it's not already selected
                                //             // otherwise, remove it from the selectedDates array
                                //             var index = selectedDates.indexOf(info.dateStr);
                                //             if (index === -1) {
                                //                 info.dayEl.style.backgroundColor = 'lightblue';
                                //                 selectedDates.push(info.dateStr);
                                //             } else {
                                //                 selectedDates.splice(index, 1);
                                //             }
                                //             console.log(selectedDates);
                                //             // var dayEl = info.dayEl;
                                //             dayEl.classList.toggle('selected-date');
                                //         }
                                //     });
                                //     calendar.render();
                                // });
                                document.addEventListener('DOMContentLoaded', function() {
                                    var calendarEl = document.getElementById('calendar');

                                    var availableDates = @json($data['availableDate']);
                                    console.log(availableDates)

                                    var calendar = new FullCalendar.Calendar(calendarEl, {
                                        // selectable: true,
                                        // height: '100%',
                                        
                                        headerToolbar: {
                                            left: 'prev,next',
                                            center: 'title',
                                            right: 'today'
                                        },
                                        dayHeaderDidMount: function(arg) {
                                            var anchorEl = arg.el.querySelector('a');
                                            anchorEl.style.color = 'black';
                                            anchorEl.style.textDecoration = 'none';
                                        },
                                        dayCellDidMount: function(arg) {
                                            var dateStr = arg.date.toISOString().slice(0, 10);
                                            var icon = document.createElement('i');
                                            icon.className = availableDates.includes(dateStr) ? 'fa-solid fa-circle' : 'fa-solid fa-xmark';
                                            icon.style.margin = '0 5px';
                                            icon.style.color = availableDates.includes(dateStr) ? '#24936E' : '#C73E3A';
                                            icon.style.alignSelf = 'center';
                                            var dayNumberEl = arg.el.querySelector('.fc-daygrid-day-number');
                                            dayNumberEl.style.display = 'flex';
                                            dayNumberEl.style.flexDirection = 'column';
                                            dayNumberEl.style.alignItems = 'center';
                                            dayNumberEl.style.justifyContent = 'center';
                                            dayNumberEl.style.margin = '0';
                                            dayNumberEl.style.padding = '0';
                                            dayNumberEl.style.width = '100%';
                                            dayNumberEl.style.textAlign = 'center';
                                            dayNumberEl.appendChild(icon);

                                            // Change the color of the text inside the anchor tag
                                            var anchorEl = arg.el.querySelector('a');
                                            anchorEl.style.color = 'black';
                                            anchorEl.style.textDecoration = 'none';
                                        },
                                        dateClick: function(info) {
                                            var index = selectedDates.indexOf(info.dateStr);
                                            if (index === -1) {
                                                info.dayEl.style.backgroundColor = 'lightblue';
                                                selectedDates.push(info.dateStr);
                                            } else {
                                                info.dayEl.style.backgroundColor = ''; // Reset the background color
                                                selectedDates.splice(index, 1);
                                            }
                                            console.log(selectedDates);
                                        },
                                    });

                                    calendar.render();
                                });

                                
                                // when the user clicks "Reserve", pass the selected dates
                                // document.querySelector('button[type="submit"]').addEventListener('click', function(e) {
                                //     e.preventDefault(); // prevent the form from submitting

                                //     // pass the selected dates
                                //     console.log(selectedDates);
                                // });

                                // helper function to get all dates between two dates
                                // function getDates(startDate, endDate) {
                                //     var dates = [];
                                //     var currentDate = startDate;
                                //     while (currentDate <= endDate) {
                                //         dates.push(new Date(currentDate));
                                //         currentDate.setDate(currentDate.getDate() + 1);
                                //     }
                                //     return dates;
                                // }
                            </script>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        </main>
    </div>
@endsection
