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
            {{-- use 'data-bs-target in button tag to specify which element should be visible by clicking which button. --}}
            <button class="nav-link active statistic-each-db text-black fw-bold" id="users-tab" data-bs-toggle="tab" data-bs-target="#users-sidebar" type="button" role="tab" aria-controls="users" aria-selected="true">Users</button>

            <button class="nav-link statistic-each-db text-black fw-bold" id="reservations-tab" data-bs-toggle="tab" data-bs-target="#reservations-sidebar" type="button" role="tab" aria-controls="reservations" aria-selected="false">Reservations</button>
        </div>

    </div>
    <div class="card-body">
        <div class="row">
            {{-- PartB: Vertical tab to show statical items of each database. 'id'in this part (users-sidebar/ reservations-sidebar) is associated with 'data-bs-target' in Part A. Thus, when the user clicks the button in Part A, associated elements in Part B shows up.--}}
            <div class="col-md-3 my-md-3">
                <div class="list-group text-center">
                    <div class="tab-content" id="myTabContent">
                        {{-- Visible if the user clicks the button, 'Users' in Part A --}}
                        <div class="tab-pane fade show active" id="users-sidebar" role="tabpanel" aria-labelledby="users-tab">
                            <button class="w-100 list-group-item statistic-extract-condition statistic-extract-condition-clicked" id="registrations-num-tab" data-bs-target="#new-registrations-num" type="button" aria-controls="registrations-num-tab" aria-selected="false">Number of new registrations</button>

                            <button class="w-100 list-group-item statistic-extract-condition" id="deletions-num-tab" data-bs-target="#deletions-num" type="button" aria-controls="deletions-num-tab" aria-selected="false">Number of deletions</button>
                        </div>
                        {{-- Visible if the user clicks the button, 'Reservations' in Part A --}}
                        <div class="tab-pane fade" id="reservations-sidebar" role="tabpanel" aria-labelledby="reservations-tab">
                            <button class="w-100 list-group-item statistic-extract-condition statistic-extract-condition-clicked" id="reservations-num-tab" data-bs-target="#reservations-num" type="button" aria-controls="reservations-num-tab" aria-selected="false">Number of reservations</button>

                            <button class="w-100 list-group-item statistic-extract-condition" id="cancellations-num-tab" data-bs-target="#cancellations-num" type="button" aria-controls="cancellations-num" aria-selected="false">Number of cancellations</button>

                            <button class="w-100 list-group-item statistic-extract-condition" id="sales-num-tab" data-bs-target="#sales-num" type="button" aria-controls="sales-num" aria-selected="false">Sales</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                        {{-- Table for Users --}}
                        <div class="statical-table-range fade show active" id="new-registrations-num" role="tabpanel">
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
            $('button').on('click', function () {
                // Get the ID of the target content pane from the 'data-bs-target' attribute
                var targetContentId = $(this).attr('data-bs-target');

                // Hide all content panes
                $('.statical-table-range').hide();

                // Show the target content pane
                $(targetContentId).show().addClass('show');
            });

            $('.statistic-extract-condition').on('click', function (event) {
                // Prevent the default action of the click event (navigating to the href)
                event.preventDefault();

                // Remove the 'clicked' class from all <a> tags within the #users-sidebar div
                $('.statistic-extract-condition').removeClass('statistic-extract-condition-clicked');

                // Add the 'clicked' class to the clicked <a> tag
                $(this).addClass('statistic-extract-condition-clicked');
            });
        });
    </script>
@endsection