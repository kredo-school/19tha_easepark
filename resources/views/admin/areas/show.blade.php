@extends('layouts.app')
@section('title', 'default')
@section('content')
<div class="col-md-2">
    <button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#delete-area">Delete (default)</button>
</div>
@include('admin.areas.modal.delete')
@endsection
