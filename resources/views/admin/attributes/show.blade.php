@extends('layouts.admin')

@section('title', 'admin:attributes_show')

@section('content')
<div class="container">
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-attribute">Delete</button>
</div>  
@include('admin.attributes.modal.delete')
@endsection