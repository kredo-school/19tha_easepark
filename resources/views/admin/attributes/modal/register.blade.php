{{-- register --}}
<div class="modal fade" id="register-attribute">
    <div class="modal-dialog">
        <form method="POST" action="#">
            @csrf
            <div class="modal-content">
                <div class="modal-header justify-content-between modal-head-color">
                    <h1 class="modal-title ms-auto fs-5 text-white"><i class="fa-solid fa-plus-circle"></i> Register New Attribute</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-5 text-dark mt-3">
                    <form action="#">
                        <div class="form-group">
                            <label for="name" class="ms-3">Attribute</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </div>
                        <div class="modal-footer border-0 text-center justify-content-center">
                            <button type="button" class="btn text-dark btn-cancel" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn text-white btn-blue">Register</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </form>
    </div>
</div>
