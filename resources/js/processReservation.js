var reservationsToBeConfirmed = JSON.parse(localStorage.getItem('reservationsToBeConfirmed'));  // Retrieve the data from localStorage

    var attributeNameElement = document.getElementById('attribute-name');
    var reservationList = document.getElementById('reservation-list');
    var totalFee = document.getElementById('total-fee');

    attributeNameElement.textContent = reservationsToBeConfirmed[0].attributeName;

    var total = 0;

    reservationsToBeConfirmed.forEach(function(reservation) {
        var listItem = document.createElement('li');
        listItem.innerHTML = 
        '<span>' + (new Date(reservation.date)).toLocaleDateString('en-US', 
            { month: 'long', 
            day: 'numeric', weekday: 'short' }) 
            + '</span>' 
            + '<span>' + reservation.areaName + '</span>'
            + '<span>$ ' + reservation.fee + '</span>';
        reservationList.appendChild(listItem);
        total += reservation.fee;
    });

    totalFee.textContent = '$' + total;