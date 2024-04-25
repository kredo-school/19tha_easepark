@extends('layouts.admin')
@section('title', 'Admin:Statistics')
@section('content')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">

<h3 class="my-1 fw-bold">
    <i class="fa-solid fa-chart-simple"></i> Statistics
</h3>
<div class="card border">
    <div class="card-header bg-light">
        {{-- PartA: This is the container where the tabs for database (users or reservations) are listed. --}}
        <div class="nav nav-tabs statistic-db-choice-range" >
            {{-- use 'data-bs-target in button tag to specify which side bar should be visible by clicking which button. --}}
            <button class="nav-link active statistic-each-db text-black fw-bold" id="users-tab" data-bs-toggle="tab" data-db-tab-id="users-tab" data-bs-target="#users-sidebar" type="button" role="tab" aria-controls="users" aria-selected="true">Users</button>

            <button class="nav-link statistic-each-db text-black fw-bold" id="reservations-tab" data-bs-toggle="tab"
            data-db-tab-id="reservations-tab"
            data-bs-target="#reservations-sidebar" type="button" role="tab" aria-controls="reservations" aria-selected="false">Reservations</button>
        </div>

    </div>
    <div class="card-body">
        <div class="row">
            {{-- PartB: Side bar to show statical items of each database. 'id' in this part (users-sidebar/ reservations-sidebar) is associated with 'data-table-id' in Part A. Thus, when the user clicks the button in Part A, associated elements in Part B shows up accordingly.--}}
            <div class="col-md-3 my-md-3">
                <div class="list-group text-center">
                    <div class="tab-content" id="myTabContent">
                        {{-- Visible if the user clicks the button, 'Users' in Part A --}}
                        <div class="tab-pane fade show active" id="users-sidebar" role="tabpanel" aria-labelledby="users-tab" data-sidebar-id="users-sidebar">
                            {{-- data-table-id is used for the click handelr to show the target table --}}
                            <button class="w-100 list-group-item statistic-extract-condition statistic-extract-condition-clicked" id="registrations-num-tab" data-table-id="registrations-num" type="button" aria-controls="registrations-num-tab" aria-selected="false">Number of new registrations</button>

                            <button class="w-100 list-group-item statistic-extract-condition" id="deletions-num-tab" data-table-id="deletions-num" type="button" aria-controls="deletions-num-tab" aria-selected="false">Number of deletions</button>
                        </div>
                        {{-- Visible if the user clicks the button, 'Reservations' in Part A --}}
                        <div class="tab-pane fade" id="reservations-sidebar" role="tabpanel" aria-labelledby="reservations-tab" data-sidebar-id="reservations-sidebar">
                            <button class="w-100 list-group-item statistic-extract-condition statistic-extract-condition-clicked" id="reservations-num-tab" data-table-id="reservations-num" type="button" aria-controls="reservations-num-tab" aria-selected="false">Number of reservations</button>

                            <button class="w-100 list-group-item statistic-extract-condition" id="cancellations-num-tab" data-table-id="cancellations-num" type="button" aria-controls="cancellations-num" aria-selected="false">Number of cancellations</button>

                            <button class="w-100 list-group-item statistic-extract-condition" id="sales-num-tab" data-table-id="sales-num" type="button" aria-controls="sales-num" aria-selected="false">Sales</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group w-25">
                    <select class="form-control year-selection my-2" id="year">
                        @for ($year = date('Y'); $year >= 2000; $year--)
                            <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                {{-- Table for Users --}}
                <div class="statical-table-range fade show" id="registrations-num" role="tabpanel">
                    @include('admin.statistics.users.registration')
                </div>

                <div class="statical-table-range fade" id="deletions-num" role="tabpanel">
                    Table to show the number of deletions shows up in here.
                </div>

                {{-- Table for Reservations --}}
                <div class="statical-table-range fade" id="reservations-num" role="tabpanel">
                    Table to show the number of reservations shows up in here.
                </div>

                <div class="statical-table-range fade" id="cancellations-num" role="tabpanel">
                    Table to show the number of cancellations shows up in here.
                </div>

                <div class="statical-table-range fade" id="sales-num" role="tabpanel">
                    Table to show the sales shows up in here.
                </div>
            </div>  
        </div>
        
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            
            // Check if there's a saved tab in localStorage
            var savedDbTabId = localStorage.getItem('selectedDbTabId');
            var savedSidebarId = localStorage.getItem('selectedSidebarId');
            var savedStatisticalTableId = localStorage.getItem('selectedStatisticalTableId');
            
            console.log(`savedDbTabId is ${savedDbTabId}, savedSibarId is ${savedSidebarId}, and savedStatisticalTableId is ${savedStatisticalTableId}`);

            // Hide all tabs and sidebars initially
            $('button[data-db-tab-id]').removeClass('active');
            $('div[data-sidebar-id]').hide();
            $('button[data-table-id]').removeClass('statistic-extract-condition-clicked');
            $('.statical-table-range').hide();
            
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
                    }
                }
            } else {
                // If database tab, side-bar, and table are not saved, show the default elements: users tab, users-sidebar, new registration table
                $('#users-tab').addClass('active');
                $('#users-sidebar').show().addClass('show');
                $('#registrations-num-tab').addClass('statistic-extract-condition-clicked');
                $('#registrations-num').show().addClass('show');
            }
            

            // Attach a click event handler to button which has an attribute, "data-db-tab-id" to store which database tab the user selects.
            $('button[data-db-tab-id]').on('click', function () {
                // Get the selected database tab that the user selects
                var selectedDbTabId = $(this).data('db-tab-id');
                console.log(`The selected database tab id is ${selectedDbTabId}`);

                // Save the selected tab in localStorage
                localStorage.setItem('selectedDbTabId', selectedDbTabId);

                // Get the value of the 'data-bs-target' attribute of the clicked tab, then, display the designated sidebar whose id is consistent with that value.
                var targetSidebar = $(this).data('bs-target');
                // $(targetSidebar).show().addClass('show active');
                $(targetSidebar).slideDown().addClass('show active');
            });

            // Attach a click event handler to button which has data-table-id to store the selected table id, hide tables other than the selected one, and show the selected table.
            $('button[data-table-id]').on('click', function () {
                // Get the table ID of the selected table from the 'data-table-id' attribute (associated with the id of the selected table)
                var selectedStatisticalTableId = $(this).data('table-id');
                console.log(`The selected statistical table id is ${selectedStatisticalTableId}`);

                // Get the sidebar ID of the selected table
                var selectedSidebarId = $(this).closest('.tab-pane').attr('id');
                console.log(`The selected sidebar id is ${selectedSidebarId}`)

                // Save the selected table in localStorage
                localStorage.setItem('selectedStatisticalTableId', selectedStatisticalTableId);

                // Save the selected sidebar in localStorage
                localStorage.setItem('selectedSidebarId', selectedSidebarId);
            
                // Hide all of the tables first
                $('.statical-table-range').hide();

                // Show the selected table
                // $('#' + selectedStatisticalTableId).show().addClass('show active');
                $('#' + selectedStatisticalTableId).slideDown().addClass('show active');
            });

            // Attach a click event handler to buttons which has a class, 'statistic-extract-condition', to highlight the selected button
            $('.statistic-extract-condition').on('click', function () {
                // Remove the 'statistic-extract-condition-clicked' class from all <a> tags within the #users-sidebar div
                $('.statistic-extract-condition').removeClass('statistic-extract-condition-clicked');

                // Add the 'statistic-extract-condition-clicked' class to the clicked <a> tag
                $(this).addClass('statistic-extract-condition-clicked');
            });

            // Attach a click event handler to the database tab to show the default table when the user moves to anoterh tab
            
            // Trigger a click event on the "Number of reservations" button when the user clicks the "Reservations" tab
            $('#reservations-tab').on('click', function () {
                $('#reservations-num-tab').trigger('click');
            });
            // Trigger a click event on the "Number of reservations" button when the user clicks the "Users" tab
            $('#users-tab').on('click', function () {
                $('#registrations-num-tab').trigger('click');
            });

            
        });
    </script>
@endsection