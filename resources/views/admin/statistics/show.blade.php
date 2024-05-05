@extends('layouts.admin')
@section('title', 'Admin:Statistics')
@section('content')

<link href="{{ asset('css/style.css') }}" rel="stylesheet">
{{-- CDN for jQeury (NOT USED)--}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
{{-- Downloaded jQuery --}}
<script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>

{{-- CDN for Chart.js --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
{{-- Downloaded Chart.js --}}
<script type="text/javascript" src="{{ asset('js/chart.min.js')}}"></script>
@vite(['resources/js/manageStatistics.js'])

<h3 class="my-1 fw-bold">
    <i class="fa-solid fa-chart-simple"></i> Statistics
</h3>
<div class="card border">
    <div class="card-header bg-light">
        {{-- PartA: This is the container where the tabs for database (users or reservations) are listed. --}}
        <div class="nav nav-tabs statistic-db-choice-range" >
            {{-- use 'data-bs-target in button tag to specify which side bar should be visible by clicking which button. --}}
            <button class="nav-link statistic-each-db text-black fw-bold" id="users-tab" data-bs-toggle="tab" data-db-tab-id="users-tab" data-bs-target="#users-sidebar" type="button" role="tab" aria-controls="users" aria-selected="true">Users</button>

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
                        <div class="tab-pane" id="users-sidebar" role="tabpanel" aria-labelledby="users-tab" data-sidebar-id="users-sidebar">
                            {{-- data-table-id is used for the click handelr to show the target table --}}
                            <button class="w-100 list-group-item statistic-extract-condition statistic-extract-condition-clicked" id="registrations-num-tab" data-table-id="registrations-num" type="button" aria-controls="registrations-num-tab" aria-selected="false">Number of new registrations</button>

                            <button class="w-100 list-group-item statistic-extract-condition" id="deletions-num-tab" data-table-id="deletions-num" type="button" aria-controls="deletions-num-tab" aria-selected="false">Number of deletions</button>
                        </div>
                        {{-- Visible if the user clicks the button, 'Reservations' in Part A --}}
                        <div class="tab-pane" id="reservations-sidebar" role="tabpanel" aria-labelledby="reservations-tab" data-sidebar-id="reservations-sidebar">
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
                <div class="statical-table-range" id="registrations-num" role="tabpanel">
                    <x-admin_statistic_table :data="$data"/>
                    <x-admin_statistic_chart :data="$data" chartId="registrations-num-chart" />
                </div>
            
                <div class="statical-table-range" id="deletions-num" role="tabpanel">
                    <x-admin_statistic_table :data="$data" />
                    <x-admin_statistic_chart :data="$data" chartId="deletions-num-chart" />
                </div>

                {{-- Table for Reservations --}}
                <div class="statical-table-range" id="reservations-num" role="tabpanel">
                    <x-admin_statistic_table :data="$data" />
                    <x-admin_statistic_chart :data="$data" chartId="reservations-num-chart" />
                </div>

                <div class="statical-table-range" id="cancellations-num" role="tabpanel">
                    <x-admin_statistic_table :data="$data" />
                    <x-admin_statistic_chart :data="$data" chartId="cancellations-num-chart" />
                </div>

                <div class="statical-table-range" id="sales-num" role="tabpanel">
                    <x-admin_statistic_table :data="$data" />
                    <x-admin_statistic_chart :data="$data" chartId="sales-num-chart" />
                </div>
            </div>  
        </div>
        
    </div>
@endsection