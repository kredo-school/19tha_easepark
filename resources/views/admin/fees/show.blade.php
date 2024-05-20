@extends('layouts.admin')

@section('title', 'Admin:Fees')

@section('content')
    <div class="my-1 dropdown-item" data-bs-toggle="modal" data-bs-target="#register-fee">
        <button class="btn btn-green">
            <i class="fa-solid fa-circle-plus"></i> Register New Fee
        </button>
    </div>
    @include('admin.fees.modal.register')
    <div class="card border w-75">
        <div class="card-header bg-light">
            <div class="row d-flex justify-content-center align-items-center">
                <h3 class="col-md-6 card-title mt-1">
                    <i class="fa-regular fa-credit-card"></i> Fees
                </h3>
                <div class="col-md-5  me-1">
                    <form action="{{ route('admin.fees.show') }}" class="ms-auto">
                        <div class="input-group">
                            <input type="search" name="search" placeholder="Search Fees"
                                value="{{ old('search', isset($search) ? $search : '') }}"
                                class="form-control form-control-sm">
                            <button type="submit" class="btn bg-dark text-white border" aria-label="Search Fees"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body px-0 py-0 mb-2">
            <div class="table-responsive">
                <table class="table table-hover align-middle border-0">
                    <thead class="small table-info">
                        <tr>
                            <th class="fw-bold">ID</th>
                            <th>Fee Name</th>
                            <th>Amount of Fee</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fees as $fee)
                            <tr>
                                <td>{{ $fee->id }}</td>
                                <td>{{ $fee->name }}</td>
                                <td>${{ $fee->fee }}</td>
                                <td>
                                    @if ($fee->trashed())
                                        <i class="fa-regular fa-circle text-secondary"></i>&nbsp; Inactive
                                    @else
                                        <i class="fa-solid fa-circle text-success"></i>&nbsp; Active
                                    @endif
                                </td>
                                <td class="text-center">
                                    @forelse ($fee->areas as $area)
                                        @if ($area->fee_id === $fee->id)
                                            <a href="{{ route('admin.fees.showEdit', ['id' => $fee->id]) }}"><span
                                            class="text-warning me-2"><i class="fa-solid fa-pen-to-square"></i></span></a>
                                            <button type="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                            data-bs-target="#warning-fee-{{ $fee->id }}"><span class="text-danger mx-1"><i
                                            class="fa-solid fa-exclamation"></i></span></button>
                                            @break
                                        @endif
                                    @empty
                                        @if ($fee->trashed())
                                            <button type="button" class="btn text-primary p-0" data-bs-toggle="modal"
                                            data-bs-target="#activate-fee-{{ $fee->id }}">
                                            <i class="fa-solid fa-rotate-left"></i></button>
                                        @else
                                            <a href="{{ route('admin.fees.showEdit', ['id' => $fee->id]) }}"><span
                                            class="text-warning me-2"><i class="fa-solid fa-pen-to-square"></i></span></a>
                                            <button type="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                            data-bs-target="#deactivate-fee-{{ $fee->id }}"><span class="text-danger"><i
                                            class="fa-solid fa-trash-can"></i></span></button>
                                        @endif
                                    @endforelse

                                    @include('admin.fees.modal.delete')
                                    @include('admin.fees.modal.warning')
                                    @include('admin.fees.modal.activate')
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No relevant data exists.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-2 w-75">
        {{ $fees->appends(request()->query())->links() }}
    </div>
@endsection
