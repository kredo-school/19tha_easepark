<div class="modal fade" id="register-fee">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.fees.register') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header justify-content-between modal-head-color">
                    <h1 class="modal-title ms-auto fs-5 text-white"><i class="fa-solid fa-circle-plus"></i> Register
                        New Fee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-6 fw-bold text-dark mt-3">
                    {{-- Fee Name --}}
                    <div class="mb-4">
                        <label for="name" class="form-label">Fee Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- Amount --}}
                    <div class="mb-4">
                        <label for="fee" class="form-label">Amount of the Fee</label>
                        <input id="fee" type="number" class="form-control @error('fee') is-invalid @enderror"
                            name="fee" value="{{ old('fee') }}" required autofocus>
                        @error('fee')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer border-0 text-center justify-content-center">
                    <button type="button" class="btn text-dark btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white btn-blue">Register</button>
                </div>

            </div>
        </form>
    </div>
</div>
