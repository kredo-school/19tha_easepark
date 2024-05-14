@extends('layouts.admin')

@section('title', 'admin | attributes_edit')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="col-auto lato-bold p-2 "><i class="fa-solid fa-pen-to-square mx-2"></i>Edit Attribute</h2>
            <div class="card p-4">
                <form action="{{ route('admin.attributes.update', $attribute->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <label for="attribute_edit" class="form-label">Attribute</label>
                    <input type="text" name="name" class="form-control mb-3" id="attribute_edit" placeholder="Attribute" value="{{ $attribute->name }}">
                    
                    @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror


                    <div class="row justify-content-center">
                        <div class="col-4">
                            <a href="{{ route('admin.attributes.show')}}" role="button" class="btn btn-cancel w-100">{{__('Cancel')}}</a>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-blue w-100">{{__('Save')}}</button>
                        </div>
                    </div>


                </form>
            </div>
    </div>
</div>


@endsection
