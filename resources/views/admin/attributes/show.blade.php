
@extends('layouts.admin')

@section('title', 'Admin | Attributes')

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
                    <i class="fa-solid fa-wheelchair pe-2"></i>Attributes
                    </h3>
                    <div class="col justify-content-end me-1">
                        <form action="{{ route('admin.attributes.show') }}" class="ms-auto">
                            <div class="input-group">
                                <input type="search" name="search_attributes" placeholder="Search Attributes"
                                class="form-control form-control-sm" value="{{ old('search', isset($search) ? $search : '') }}">
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attributes as $attribute)
                            <tr>
                                <td class="text-center">{{ $attribute->id }}</td>
                                <td>{{ $attribute->name }}</td>
                                <td>
                                    @if($attribute->trashed())
                                        <span class="text-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($attribute->trashed())
                                    <!-- // Pressing the icon displays a restore modal in the delete.blade file. -->
                                        <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#restore-attribute-{{$attribute->id}}">
                                            <span class="text-success"><i class="fa-solid fa-rotate-left"></i></span>
                                        </button>
                                    @else
                                        <!-- // Press the icon to display the EDIT BLADE. -->
                                        <a href="{{ route('admin.attributes.showEdit', $attribute->id) }}">
                                            <span class="text-warning me-2"><i class="fa-solid fa-pen-to-square"></i></span>
                                        </a>
                                        <!-- // Press the button to display the delete modal. -->
                                        <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#delete-attribute-{{ $attribute->id }}">
                                            <span class="text-danger"><i class="fa-solid fa-trash-can"></i></span>
                                        </button>
                                    @endif
                                    @include('admin.attributes.modal.delete', ['attribute' => $attribute])

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No relevant data exists.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Pagination -->
        <div class="d-flex col-8 justify-content-center mt-2">
            {{ $attributes->links() }}
        </div>
    </div>
@endsection
