$(document).ready(function() {
    // Get the elements to input dynamically generated data
    var $filterList = $('#filter-list');
    var $reservationListData = $('#reservation-list-data');
    var $pagination = $('#pagination');

    // Get the last used condition and page from localStorage
    var savedFilterCondition = localStorage.getItem('filterCondition');
    var savedPage = localStorage.getItem('page');
    // Set the filterCondition
    var filterCondition = savedFilterCondition ? savedFilterCondition : 'all';
    $filterList.val(filterCondition);
    // Set the page
    var page = savedPage ? savedPage : 1;

    // Define a global variable to store the fetched reservations
    var reservations = [];

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var deleteModalHTML = `
    <div class="modal fade" id="delete-reservation" tabindex="-1" role="dialog" aria-labelledby="delete-reservation" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content justify-content-center">
                <div class="modal-header modal-head-color-red text-center justify-content-between">
                    <h1 class="modal-title fs-5 text-white ms-auto"><i class="fa-solid fa-trash-can me-2"></i>Delete Reservation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-5">
                    <form method="post" id="reservation-deletion-form" action="/reservation/delete">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="DELETE">

                        <p class="text-center my-4">
                            Are you sure you want to delete the following reservation?<br>
                            All associated data will be permanently removed.
                        </p>

                        <div class="row justify-content-center">
                            <div class="col-10 modal-head-color-red-transparent pt-3">
                                <ul>
                                    <!-- <li> element dynamically changes -->
                                </ul>
                            </div>
                        </div>

                        <p class="text-center my-4">
                            Once deleted, it cannot be undone.
                        </p>

                        <div class="modal-footer border-0">
                            <button type="button" class="btn text-dark btn-cancel" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn text-white btn-red">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>`;
    $('body').append(deleteModalHTML);

    // Function to fetch and display reservations based on the filter condition
    function fetchReservations(filterCondition, page) {
        $.ajax({
            url: '/reservation/filter-list',
            method: 'GET',
            data: {
                filterCondition: filterCondition,
                page: page
            },
            success: function(fetchedData) {
                var rows = '';

                // Store the fetched reservations in the global variable
                reservations = fetchedData.reservations.data;

                //Display the reservations based on the filter condition
                if (fetchedData.reservations.data.length === 0) {
                    rows = `<tr><td colspan="7" class="text-center">There are no reservations with the filter condition.</td></tr>`;
                } else {
                    $.each(fetchedData.reservations.data, function(index, reservation) {
                        var pdfRoute = '/reservation/pdf_view/' + reservation.id;
                        var deleteModalTarget = '#delete-reservation-' + reservation.id;
                        var deleteTag;
                        // Get today's date in 'Y-m-d' format
                        var today = new Date().toISOString().split('T')[0];

                        // Check if reservation.date is today or in the future
                        if (reservation.date >= today) {
                            deleteTag = `<td class="text-center"><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-reservation" id="${deleteModalTarget}"><i class="fa-solid fa-trash-can"></i></button></td>`;

                        } else {
                            deleteTag = `<td></td>`;
                            deleteModalHTML = '';
                        }

                        rows += `
                            <tr>
                                <th scope="row" class="text-center">${reservation.id}</th>
                                <td class="text-center">${reservation.area.name}</td>
                                <td class="text-center">${reservation.date}</td>
                                <td class="text-center">${reservation.area.attribute.name}</td>
                                <td class="text-center">$${reservation.fee_log}</td>
                                <td class="text-center"><a href="${pdfRoute}"><i class="fa-solid fa-download"></i></a></td>
                                ${deleteTag}
                            </tr>
                            `;
                    });
                }
                $reservationListData.html(rows);

                // Display the pagination links only if there are reservations
                if (fetchedData.reservations.data.length !== 0){
                    var currentPage = fetchedData.reservations.current_page;
                    var lastPage = fetchedData.reservations.last_page;
                    var pagination = '<ul class="pagination">';
                    for (var i = 1; i <= lastPage; i++) {
                        pagination += `<li class="page-item ${i === currentPage ? 'active' : ''}"><a href="#" class="page-link" data-page="${i}">${i}</a></li>`;
                    }
                    pagination += '</ul>';
                    $pagination.html(pagination);
                } else {
                    $pagination.html('');
                }
            }
        });
    }

    fetchReservations(filterCondition, page);

    $filterList.change(function() {
        filterCondition = $(this).val();
        // Store the selected filter method in localStorage
        localStorage.setItem('filterCondition', filterCondition);
        localStorage.setItem('page', 1);
        fetchReservations(filterCondition,1);
    });

    // Handle the page link clicks
    $pagination.on('click', '.page-link', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        // Store the current page number in localStorage
        localStorage.setItem('page', page);
        fetchReservations(filterCondition, page);
    });

    // When the delete button is clicked, update the form action with the reservation id
    $(document).on('click', '[data-bs-target="#delete-reservation"]', function() {
        var reservationId = Number($(this).attr('id').split('-')[2]);

        // Update the form action with the reservation id
        $('#reservation-deletion-form').attr('action', '/reservation/delete/' + reservationId);

        var reservation = reservations.find(function(reservation) {
            return reservation.id === reservationId;
        });

        // Update the modal content with the reservation data
        $('#delete-reservation').find('ul').html(`
            <li>${reservation.area.name} &nbsp; ${reservation.date} &nbsp; ${reservation.area.attribute.name} &nbsp; ${reservation.fee_log}</li>
        `);


    });

});
