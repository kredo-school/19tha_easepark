$(document).ready(function() {
    // * Start: Setting up when the user refreshes the page * //

    // Get the initial selected year
    var selectedYear = $('#year').val();

    // Check if there's a database tab id, sidebar id, an statistical table id saved in localStorage
    var savedDbTabId = localStorage.getItem('selectedDbTabId');
    var savedSidebarId = localStorage.getItem('selectedSidebarId');
    var savedStatisticalTableId = localStorage.getItem('selectedStatisticalTableId');
    var savedYear = localStorage.getItem('selectedYear');
    
    // console.log(`savedDbTabId is ${savedDbTabId}, savedSibarId is ${savedSidebarId}, and savedStatisticalTableId is ${savedStatisticalTableId}`);

    // Hide all tabs and sidebars and reset the highlight initially
    $('button[data-db-tab-id]').removeClass('active');
    $('div[data-sidebar-id]').hide();
    $('button[data-table-id]').removeClass('statistic-extract-condition-clicked');
    $('.statical-table-range').hide();
    // Set the default year to the current year
    $('#year').val(savedYear || selectedYear);
    
    if (savedDbTabId) {
        // If there is saved database tab id, show it
        $('#' + savedDbTabId).addClass('active');

        if (savedSidebarId) {
            // If there's a saved sidebar, show it
            // $('#' + savedSidebarId).show().addClass('show active');
            $('#' + savedSidebarId).slideDown().addClass('show active');

            $('button[data-table-id]').removeClass('statistic-extract-condition-clicked');
            $('.statical-table-range').hide();
            if (savedStatisticalTableId) {
                // If there's a saved statistical table, show it
                $(`button[data-table-id="${savedStatisticalTableId}"]`).addClass('statistic-extract-condition-clicked');
                // $('#' + savedStatisticalTableId).show().addClass('show active');
                $('#' + savedStatisticalTableId).slideDown().addClass('show active');
                // Fetch data for the saved statistical table
                fetchData(savedStatisticalTableId);
            }
        }
    } else {
        console.log('No saved database tab id, sidebar id, and statistical table id. Show the default elements.');
        // If database tab, side-bar, and table are not saved (first time that the admin user accesses the page), show the default elements: users tab, users-sidebar, registration table
        $('#users-tab').addClass('active');
        $('#users-sidebar').show().addClass('show');
        $('#registrations-num-tab').addClass('statistic-extract-condition-clicked');
        // Show the selected table
        $('#registrations-num').slideDown(function() {
            // This code runs after the slideDown animation completes
            $('#registrations-num').addClass('show active');

            // Fetch data for the selected table
            fetchData('registrations-num');
        });
    }
    // * End: Setting up when the user refreshes the page * //

    // * Start: Features for when the year is changed * //

    // Listen for changes to the selected year
    $('#year').change(function() {
        // Get the new selected year
        selectedYear = $(this).val();

        // Store the new selected year in localStorage
        localStorage.setItem('selectedYear', selectedYear);
    });

    // * End: Features for when the year is changed * //
    
    // * Start: Features for when the database tab is changed * //

    // Attach a click event handler to button which has an attribute, "data-db-tab-id" to store which database tab the user selects.
    $('button[data-db-tab-id]').on('click', function () {
        // Get the selected database tab that the user selects
        var selectedDbTabId = $(this).data('db-tab-id');
        // console.log(`The selected database tab id is ${selectedDbTabId}`);

        // Save the selected tab in localStorage
        localStorage.setItem('selectedDbTabId', selectedDbTabId);

        // Get the value of the 'data-bs-target' attribute of the clicked tab, then, display the designated sidebar whose id is consistent with that value.
        var targetSidebar = $(this).data('bs-target');

        $('.tab-pane').hide();

        // $(targetSidebar).show().addClass('show active');
        $(targetSidebar).slideDown().addClass('show active');
    });

    // * End: Features for when the database tab is changed * //

    // * Start: Features for when the extract option in the sidebar is changed * //

    // Attach a click event handler to button which has data-table-id to store the selected table id, hide tables other than the selected one, and show the selected table by fetching data from controller.
    $('button[data-table-id]').on('click', function () {
        // Get the table ID of the selected table from the 'data-table-id' attribute (associated with the id of the selected table)
        var selectedStatisticalTableId = $(this).data('table-id');
        // console.log(`The selected statistical table id is ${selectedStatisticalTableId}`);

        // Get the sidebar ID of the selected table
        var selectedSidebarId = $(this).closest('.tab-pane').attr('id');
        // console.log(`The selected sidebar id is ${selectedSidebarId}`)

        // Save the selected table in localStorage
        localStorage.setItem('selectedStatisticalTableId', selectedStatisticalTableId);

        // Save the selected sidebar in localStorage
        localStorage.setItem('selectedSidebarId', selectedSidebarId);
    
        // Hide all of the tables first
        $('.statical-table-range').hide();

        // Show the selected table
        $('#' + selectedStatisticalTableId).slideDown(function() {
            // This code runs after the slideDown animation completes
            $(this).addClass('show active');

            // Fetch data for the selected table
            fetchData(selectedStatisticalTableId);
        });
        // Remove the 'statistic-extract-condition-clicked' class from all <button> tags with the class, 'statistic-extract-condition'
        $('.statistic-extract-condition').removeClass('statistic-extract-condition-clicked');

        // Add the 'statistic-extract-condition-clicked' class to the clicked button tag
        $(this).addClass('statistic-extract-condition-clicked');
    });

    // * End: Features for when the extract option in the sidebar is changed * //

    // * Start: Features for when a specific database tab is clicked * //
    // Attach a click event handler to the database tab to show the default table when the user moves to anoterh tab
    // Trigger a click event on the "Number of reservations" button when the user clicks the "Reservations" tab
    $('#reservations-tab').on('click', function () {
        $('#reservations-num-tab').trigger('click');
    });
    // Trigger a click event on the "Number of reservations" button when the user clicks the "Users" tab
    $('#users-tab').on('click', function () {
        $('#registrations-num-tab').trigger('click');
    });

    // * End: Features for when a specific database tab is clicked * //

    /**
     * Fetches data for a specific table and updates the table with the fetched data.
     *
     * @async
     * @function fetchData
     * @param {string} tableId - The ID of the table for which to fetch data.
     * @throws Will throw an error if the AJAX request fails.
     */
    async function fetchData(tableId) {
        try {
            // Get the selected year
            var selectedYear = $('#year').val();

            var fetchedData = await $.ajax({
                url: '/admin/statistics/test/' + tableId + '/data',
                method: 'GET',
                data: { year: selectedYear } // Pass the selected year to the controller
            });

            var chartId = tableId + '-chart';

            console.log('Fetched data:', fetchedData, 'Chart ID:', chartId);

            updateTable('.table-responsive .table', fetchedData);
            updateChart('#' + chartId, fetchedData);
        } catch (error) {
            console.error('An error occurred:', error);
        }
    }
    
    /**
     * Updates the HTML of a table with new data.
     *
     * @function updateTable
     * @param {string} selector - The jQuery selector of the table to update.
     * @param {Object} data - The new data for the table. It should have the following structure:
     *     {
     *         year: Number,
     *         months: Array of strings (the table column headers),
     *         attributes: Array of strings (the row headers),
     *         numericalDataNumByAttribute: Object where each key
     *         is an attribute name and the value is another      
     *         object. This inner object should have month names as
     *         keys and numerical data as values.
     *     }
     */
    function updateTable(selector, data) {
        // Start with an empty string.
        var tableHtml = '';

        // Add a header row for each month in the data.
        tableHtml += '<thead class="small table-info"><tr><th scope="col">#</th>';
        data.months.forEach(function(month) {
            tableHtml += '<th scope="col">' + month + '</th>';
        });
        tableHtml += '</tr></thead>';

        // Add a body row for each attribute in the data.
        tableHtml += '<tbody>';
        data.attributes.forEach(function(attribute) {
            tableHtml += '<tr><th scope="row">' + attribute + '</th>';
            data.months.forEach(function(month) {
                tableHtml += '<td>' + (data.numericalDataNumByAttribute[attribute][month] || 'N/A') + '</td>';
            });
            tableHtml += '</tr>';
        });
        tableHtml += '</tbody>';

        // Insert the table HTML into the table element.
        $(selector).empty().html(tableHtml);
    }
    var myChart;

    /**
     * Updates the chart with new data.
     *
     * @param {string} selector - The CSS selector for the canvas element where the chart will be rendered.
     * @param {Object} data - The data for the chart.
     * @param {string[]} data.attributes - The attributes for the chart.
     * @param {string[]} data.months - The months for the chart.
     * @param {Object} data.numericalDataNumByAttribute - The statistical data for the chart, organized by attribute and month.
     */
    function updateChart(selector, data) {
        
        if (myChart) {
            // If a chart already exists, destroy it
            myChart.destroy();
        }
        // var ctx = document.querySelector(selector).getContext('2d');
        var ctx = document.querySelector(selector).getContext('2d');
        var colors = ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(54, 162, 235, 0.2)'];
        var borderColors = ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 206, 86, 1)', 'rgba(54, 162, 235, 1)'];
        var datasets = data['attributes'].map(function(attribute, index) {
            return {
                label: attribute,
                data: data['months'].map(function(month) {
                    // Adjust how you're accessing the statistical data
                    return data['numericalDataNumByAttribute'][attribute][month] || 0;
                }),
                backgroundColor: colors[index % colors.length],
                borderColor: borderColors[index % borderColors.length],
                borderWidth: 1
            };
        });
        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data['months'],
                datasets: datasets
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
        });
    }
    
});