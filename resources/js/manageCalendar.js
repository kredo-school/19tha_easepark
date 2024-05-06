$(document).ready(function() {
    var selectedDates = JSON.parse(localStorage.getItem('selectedDates')) || []; // Retrieve the selected dates from localStorage
    var availableDates = [];
    var currentView = JSON.parse(localStorage.getItem('currentView')) || { type: 'dayGridMonth', date: new Date() }; // Retrieve the current view from localStorage

    $.ajax({
        url: '/homepage/available-dates', // replace with the actual path to your route
        method: 'GET',
        success: function(data) {
            console.log(data);
            availableDates = data.availableDates;
    
            // Use availableDates here
            console.log(`availableDates: ${availableDates}`);
            var calendarEl = document.getElementById('calendar');
        
    
        // var availableDates = $data['availableDate'];
        // console.log(data.availableDates)
    
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: currentView.type, // Set the initial view
            initialDate: currentView.date,
            
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'resetSelection,today',
                
            },
            footerToolbar: {
                
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
                        
                        console.log(`selectedDates: ${selectedDates}`)
                        // Refresh the calendar to reflect the changes
                        calendar.refetchEvents();
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
                    console.log(`selected date: ${info.dateStr}`)
                    selectedDates.push(info.dateStr);
                } else {
                    info.dayEl.style.backgroundColor = ''; // Reset the background color
                    selectedDates.splice(index, 1);
                }
                console.log(selectedDates);

                localStorage.setItem('selectedDates', JSON.stringify(selectedDates)); // Store the selected dates in localStorage
            },
        });
    
        calendar.render();
        }
    });
});