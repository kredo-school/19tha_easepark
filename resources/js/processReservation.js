$(document).ready(function() {
    class ReservationHandler {
        constructor(reservationKey) {
            this.reservationsToBeProcessed = JSON.parse(localStorage.getItem(reservationKey));
            this.attributeNameElement = document.getElementById('attribute-name');
            this.reservationList = document.getElementById('reservation-list');
            this.totalFee = document.getElementById('total-fee');
            this.differentAreaAlertElement = document.getElementById(`different-area-alert-${reservationKey}`);
        }

        displayReservations() {
            this.attributeNameElement.textContent = this.reservationsToBeProcessed.attributeName;

            this.differentAreaAlertElement.style.display = (String(this.reservationsToBeProcessed.differentAreaAlert) === 'true') ? 'block' : 'none';

            let total = 0;

            Object.entries(this.reservationsToBeProcessed.reservations).forEach(([date, reservation]) => {
                let listItem = document.createElement('li');
                listItem.innerHTML = 
                '<span>' + (new Date(date)).toLocaleDateString('en-US', 
                    { month: 'long', 
                    day: 'numeric', weekday: 'short' }) 
                    + '</span>' 
                    + '<span>' + reservation.areaName + '</span>'
                    + '<span>$ ' + reservation.fee + '</span>';
                this.reservationList.appendChild(listItem);
                total += parseFloat(reservation.fee);
            });
        
            this.totalFee.textContent = '$' + total;
        }
    }

    if (window.location.pathname === '/reservation/confirmation') {
        let reservationsToBeConfirmedHandler = new ReservationHandler('reservationsToBeConfirmed');
        reservationsToBeConfirmedHandler.displayReservations();
    }

    $('#btn-reservation-confirm').click(function(e) {
        e.preventDefault();
        let reservationsToBeConfirmed = JSON.parse(localStorage.getItem('reservationsToBeConfirmed'));  // Retrieve the data from localStorage
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/reservation/reserve-spaces',
            type: 'POST',
            data: {
                reservationsToBeConfirmed: reservationsToBeConfirmed,
            },
            success: function(reservationsToBeCompleted) {
                localStorage.setItem('selectedDates', null); // Clear the selectedDates in localStorage
                localStorage.setItem('reservationsToBeCompleted', JSON.stringify(reservationsToBeCompleted));
                console.log(reservationsToBeCompleted);
                window.location.href = "/reservation/completion";  // Redirect to /reservation/confirmation
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert('An error occurred: ' + error);
            }
        });
    });

    if (window.location.pathname === '/reservation/completion') {
        let completedReservationsHandler = new ReservationHandler('reservationsToBeCompleted');
        completedReservationsHandler.displayReservations();
    }
});