@extends('layouts.app')
@section('title', 'default')
@section('content')
<div class="col-md-2">
    <button type="button" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#register-fee">Register (default)</button>
</div>
@include('admin.fees.modal.register')
@endsection
