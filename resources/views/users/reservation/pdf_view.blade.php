@extends('layouts.app')
@section('title', 'PDF_view')
@section('content')
    <div class="container">
        <div class="my-3">
            <a href="{{ route('pdf_download') }}" class="btn btn-blue">Download PDF</a>
        </div>
        <div class="card">
            <div class="card-body">
                <p>{{ $title }}</p>
                <p>{{ $date }}</p>
                <p>{{ $userNames  }}</p>
            </div>
        </div>
    </div>
@endsection
