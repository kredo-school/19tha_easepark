$(document).ready(function() {
    class ReservationHandler {
        constructor(reservationKey) {
            this.reservations = JSON.parse(localStorage.getItem(reservationKey));
            this.attributeNameElement = document.getElementById('attribute-name');
            this.reservationList = document.getElementById('reservation-list');
            this.totalFee = document.getElementById('total-fee');
        }

        displayReservations() {
            this.attributeNameElement.textContent = this.reservations[0].attributeName;

            let total = 0;

            this.reservations.forEach(reservation => {
                let listItem = document.createElement('li');
                listItem.innerHTML = 
                '<span>' + (new Date(reservation.date)).toLocaleDateString('en-US', 
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
        console.log(reservationsToBeConfirmed);
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