@extends('layouts.app')
@section('title', 'default')
@section('content')
<div class="col-md-2">
    <button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#delete-admin">delete (default)</button>
</div>
@include('admin.admins.modal.delete')
@endsection