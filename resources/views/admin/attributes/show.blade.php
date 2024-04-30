@extends('layouts.app')

@section('title', 'Admin: show attribute')

@section('content')
<div class="col-md-2">
    <button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#register-attribute">register (default)</button>
</div>
@include('admin.attributes.modal.register')
@endsection