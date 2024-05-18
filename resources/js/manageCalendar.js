// This script shows the register guidance modal after 1.5 seconds if the user has not seen it yet
// Disable for now since this seems to be not necessary

// $(window).on('load',function(){
//     if (!sessionStorage.getItem('registerGuidanceShown')) {
//         var delayMs = 1500; // delay in milliseconds
        
//         setTimeout(function(){
//             $('#registerGuidanceModal').modal('show');
//             sessionStorage.setItem('registerGuidanceShown', 'true');
//         }, delayMs);
//     }
// });

$(document).ready(function() {
    var calendar;
    var availableDates = [];
    var selectedDates = [];
    var currentView = {};
    var selectedAttributeId = [];
    console.log(userAttributeId)

    //Check and get stored values from localStorage
    selectedDates = JSON.parse(localStorage.getItem('selectedDates'))|| []; // Retrieve the selected dates
    // console.log(`selectedDates: ${selectedDates}`)
    currentView = JSON.parse(localStorage.getItem('currentView')) || { type: 'dayGridMonth', date: new Date() }; // Retrieve the current view
    selectedAttributeId = JSON.parse(localStorage.getItem('selectedAttributeId')) || userAttributeId || []; // Set selectedAttributeId (One in localStorage => one from userAttributeId => empty array)
    
    function fetchAvailableDates(attributeId) {
        $.ajax({
            url: '/homepage/available-dates/' + attributeId,
            method: 'GET',
            success: function(data) {
                console.log(data);
                availableDates = data.availableDates;
                
                var calendarEl = document.getElementById('calendar');
                
                    if (calendar) {
                        // console.log(`Previous calendar exists and will be destroyed.`);
                        calendar.destroy(); // Destroy the existing instance of FullCalendar
                    }                
                    calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: currentView.type, // Set the initial view
                        initialDate: currentView.date,
                        contentHeight: 350,
                        
                        headerToolbar: {
                            left: 'prev,next',
                            center: 'title',
                            right: 'resetSelection,today',
                        },

                        customButtons: {
                            resetSelection: {
                                text: 'Reset',
                                click: function() {
                                    selectedDates = []; // Clear the selected dates array
                                    localStorage.setItem('selectedDates', JSON.stringify(selectedDates)); // Update the selected dates in localStorage
                    
                                    // Remove the background color from all the selected date cells
                                    var dateCells = calendarEl.querySelectorAll('.fc-daygrid-day');
                                    dateCells.forEach(function(dateCell) {
                                        dateCell.style.backgroundColor = '';
                                    });
                                    // console.log(`selectedDates: ${selectedDates}`)
                                    updateReserveButton();
                                },
                            }
                        },
                        dayHeaderDidMount: function(arg) {
                            var anchorEl = arg.el.querySelector('a');
                            anchorEl.style.color = 'black';
                            anchorEl.style.textDecoration = 'none';
                        },

                        datesSet: function(info) {
                            // Store the current view in localStorage every time the view changes
                            localStorage.setItem('currentView', JSON.stringify({ type: info.view.type, date: info.view.currentStart.toISOString() }));
                        },

                        dayCellDidMount: function(arg) {
                            // var dateStr = arg.date.toISOString().slice(0, 10);
                            var date = arg.date;
                            var dateStr = date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0') + '-' + String(date.getDate()).padStart(2, '0');
                            var icon = document.createElement('i');

                            if (dateStr >= data.startDate) {
                                icon.className = data.availableDates.includes(dateStr) ? 'fa-solid fa-circle' : 'fa-solid fa-xmark';
                                icon.style.color = data.availableDates.includes(dateStr) ? '#24936E' : '#C73E3A';
                            } else {
                                icon.className = 'fa-solid fa-ban';
                            }
                            icon.style.margin = '0 5px';
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

                            // If selectedDates includes the current date, set the background color to lightblue.
                            // Otherwise, set it to an empty string.
                            if (selectedDates.includes(dateStr)) {
                                arg.el.style.backgroundColor = 'lightblue';
                            }
                        },

                        dateClick: function(info) {
                            if (!availableDates.includes(info.dateStr)) {
                                // If the date is not available, prevent it from being selected
                                return;
                            }
                            var index = selectedDates.indexOf(info.dateStr);
                            if (index === -1) {
                                info.dayEl.style.backgroundColor = 'lightblue';
                                selectedDates.push(info.dateStr);
                            } else {
                                info.dayEl.style.backgroundColor = ''; // Reset the background color
                                selectedDates.splice(index, 1);
                            }
                            // console.log(selectedDates);

                            localStorage.setItem('selectedDates', JSON.stringify(selectedDates)); // Store the selected dates in localStorage
                            updateReserveButton();
                        },
                    });
                calendar.render();
            },
            error: function(errorThrown) {
                throw new Error(`The calendar has failed to be rendered. ${errorThrown}`);
            }
        });
    }

    function updateReserveButton() {
        if (selectedDates.length > 0) {
            $('#reserve-button').prop('disabled', false);
            $('#reserve-button').show(); // Show the button
        } else {
            $('#reserve-button').prop('disabled', true);
            $('#reserve-button').hide(); // Hide the button
        }
    }

    // Initially hide the calendar range and reserve button
    $('#calendar-range').hide();
    $('#reserve-button').hide();

    // Check if selectedAttributeId is not set or is an empty array
    if (!selectedAttributeId || selectedAttributeId.length === 0) {
        // If selectedAttributeId is not set or is an empty array, show an alert asking the user to select an attribute
        alert('Please select a type first.');
    } else {
        // If selectedAttributeId is set and is not an empty array, set the value of the attribute-selection element to selectedAttributeId
        $('#attribute-selection').val(selectedAttributeId);

        // Show the calendar range
        $('#calendar-range').show();

        // Fetch the available dates for the selected attribute
        fetchAvailableDates(selectedAttributeId);

        // Update the reserve button based on the selected attribute
        updateReserveButton();
    }

    // Fetch the available dates whenever the user changes the attribute selection
    $('#attribute-selection').change(function() {
        var attributeId = $(this).val();
        localStorage.setItem('selectedAttributeId', attributeId);
        selectedDates = []; // Clear the selected dates array
        localStorage.setItem('selectedDates', JSON.stringify(selectedDates)); // Update the selected dates in localStorage
        $('#calendar-range').show();
        fetchAvailableDates(attributeId);
        updateReserveButton()
    });

    // When the user clicks the "Reserve" button, pass the selected dates and attribute to confirmation page or show the register guidance modal based on login status
    $('#reserve-button').click(function(e) {
        e.preventDefault();

        if (userIsAuthenticated) {
            var selectedAttributeId = JSON.parse(localStorage.getItem('selectedAttributeId')) || [];

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/reservation/pass-to-confirmation',
                type: 'POST',
                data: {
                    selectedDates: selectedDates,
                    attributeId: selectedAttributeId,
                },
                success: function(reservationsToBeConfirmed) {
                    console.log(reservationsToBeConfirmed);
                    localStorage.setItem('reservationsToBeConfirmed', JSON.stringify(reservationsToBeConfirmed));  // Store the reservation details that should be passed to /reservation/confirmation in localStorage
                    window.location.href = "/reservation/confirmation";  // Redirect to /reservation/confirmation
                }
            });
        } else {
            $('#registerGuidanceModal').modal('show');
        }
    });
});