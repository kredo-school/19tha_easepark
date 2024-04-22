@extends('layouts.admin')

@section('title', 'edit registered attributes')

@section('content')
<div class="container mt-3">
    <div class="mx-auto justify-content-center my-3">
        <h2 class="col-auto lato-bold p-2"><i class="fa-solid fa-pen-to-square"></i>Edit Attribute</h2>
        <div class="row col-auto card shadow-sm mx-auto">
            <div class="col-12">
                <label for="attribute_edit" class="form-label">Attribute</label>
                <input type="text" class="form-control mb-3" id="attribute_edit" placeholder="EV">
            </div>
            <div class="row">
                <input type="button" class="btn btn-dark" id="cancel" value="Cancel">
                <input type="button" class="btn btn-info" id="save" value="Save">
                
            </div>

        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <h2 class="col-auto lato-bold p-2"><i class="fa-solid fa-pen-to-square"></i>Edit Attribute</h2>
            <div class="card">
                <form action="#" method="post">
                    @csrf
                    <label for="attribute_edit" class="form-label">Attribute</label>
                    <input type="text" name="attribute" class="form-control mb-3" id="attribute_edit" placeholder="#" autofocus>
                    
                    @error('attribute')
                    <div class="text-danger small">{{$message}}
                    </div>
                    @enderror

                    <div class="row mb-3">
                        <div class="col">
                            <a href="#" role="button" class="btn btn-white">{{__('Cancel')}}</a>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-blue w-100">{{__('Save')}}</button>
                        </div>
                    </div>
                    

                </form>
                <label for="attribute_edit" class="form-label"></label>
            </div>
    </div>
</div>


@endsection
