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
                // console.log(fetchedData);
                var rows = '';

                //Display the reservations based on the filter condition
                if (fetchedData.reservations.data.length === 0) {
                    rows = `<tr><td colspan="7" class="text-center">There are no reservations with the filter condition.</td></tr>`;
                } else {
                    $.each(fetchedData.reservations.data, function(index, reservation) {
                        var pdfRoute = '/reservation/pdf_view/' + reservation.id;
                        var deleteModalTarget = '#delete-reservation' + reservation.id;
                        var deleteTag;
                        // Get today's date in 'Y-m-d' format
                        var today = new Date().toISOString().split('T')[0];

                        // Check if reservation.date is today or in the future
                        if (reservation.date >= today) {
                            deleteTag = `<td class="text-center"><button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="${deleteModalTarget}"><i class="fa-solid fa-trash-can"></i></button></td>`;
                        } else {
                            deleteTag = `<td></td>`;
                        }
            
                        rows += `
                            <tr>
                                <th scope="row" class="text-center">${reservation.id}</th>
                                <td class="text-center">${reservation.area.name}</td>
                                <td class="text-center">${reservation.date}</td>
                                <td class="text-center">${fetchedData.userAttribute}</td>
                                <td class="text-center">$${reservation.fee_log}</td>
                                <td class="text-center"><a href="${pdfRoute}"><i class="fa-solid fa-download"></i></a></td>
                                ${deleteTag}
                            </tr>`;
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
});