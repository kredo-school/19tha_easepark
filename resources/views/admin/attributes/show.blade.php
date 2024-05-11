@extends('layouts.admin')

@section('title', 'admin:attributes_show')

@section('content')

<div class="container">
    <div class="col-4 mb-3">
        <button type="button" class="btn btn-green w-100" data-bs-toggle="modal" data-bs-target="#register-attribute">
            <i class="fa-solid fa-circle-plus pe-2"></i>Register New Attribute
        </button>
    </div>
    @include('admin.attributes.modal.register')
    <div class="card col-8 border">
        <div class="card-header bg-light">
            <div class="row">
                <h3 class="col card-title mt-1">
                <i class="fa-solid fa-wheelchair pe-2"></i>Attribute
                </h3>
                <div class="col justify-content-end me-1">
                    <form action="#" class="ms-auto">
                        <div class="input-group">
                            <input type="search_attributes" name="search_attributes" placeholder="Search Attributes" value=""
                            class="form-control form-control-sm">
                            <button type="submit" class="btn bg-dark text-white border" aria-label="Search Attributes"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="card-body px-0 py-0">
            <table class="table table-hover align-middle border-0">
                <thead>
                    <tr class="table-info">
                        <th scope="col" class="fw-bold text-center">ID</th>
                        <th scope="col">Attribute Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_attributes as $attribute)
                    <tr>
                        <td class="text-center">{{ $attribute->id }}</td>
                        <td>{{ $attribute->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.attributes.edit', $attribute->id ) }}"><span class="text-warning me-2"><i class="fa-solid fa-pen-to-square"></i></span>
                            </a>
                            <button type="button" class="btn btn-sm delete-btn" data-bs-toggle="modal" data-bs-target="#delete-attribute" data-id="{{ $attribute->id }}" data-name="{{ $attribute->name }}"><span class="text-danger"><i class="fa-solid fa-trash-can"></i>
                            </span></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @include('admin.attributes.modal.delete')
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function (){
        var deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(function(button){
            button.addEventListener('click', function(){
                var id = button.getAttribute('data-id');
                var name = button.getAttribute('data-name');
                var modal = document.getElementById('delete-attribute');
                var nameSpan = modal.querySelector('span');
                var form = modal.querySelector('form');
                nameSpan.textContent = name;
                form.action = '/admin/attributes/' + id + '/destroy';
            });
        });
    });
</script>

@endsection
