<!-- Modal -->
<div class="modal fade" id="registerArea" tabindex="-1" aria-labelledby="registerAreaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-between modal-head-color">
                <h1 class="modal-title ms-auto fs-5 text-white"><i class="fa-solid fa-circle-plus"></i> Register New
                    Area</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mx-5">
                <form method="POST" action="{{ route('admin.areas.register') }}" id="registerForm">
                    @csrf

                    {{-- Name --}}
                    <div class="row">
                        <label for="name" class="form-label">{{ __('Area Name') }}</label>
                    </div>
                    <div class="row mb-4">
                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Attributes --}}
                    <div class="row">
                        <label for="attriute" class="form-label">{{ __('Attribute') }}</label>
                    </div>
                    <div class="row mb-4">
                        <select id="attribute" name="attribute_id"
                            class="form-select @error('attribute_id') is-invalid @enderror" required
                            autocomplete="attribute">
                            @foreach ($all_attributes as $attribute)
                                <option value="{{ $attribute->id }}"
                                    {{ old('attribute_id') == $attribute->id ? 'selected' : '' }}>
                                    {{ $attribute->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('attribute_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Fees --}}
                    <div class="row">
                        <label for="fee" class="form-label">{{ __('Fee') }}</label>
                    </div>
                    <div class="row mb-4">
                        <select id="fee" name="fee_id" class="form-select @error('fee_id') is-invalid @enderror"
                            required autocomplete="fee">
                            @foreach ($all_fees as $fee)
                                <option value="{{ $fee->id }}" {{ old('fee_id') == $fee->id ? 'selected' : '' }}>
                                    {{ $fee->name }} : {{ $fee->fee }}
                                </option>
                            @endforeach
                        </select>
                        @error('fee_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- ADDRESS --}}
                    <div class="row">
                        <label for="address" class="form-label">{{ __('Address') }}</label>
                    </div>
                    <div class="row mb-4">
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                            name="address" required autocomplete="address" value="{{ old('address') }}">
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- MAX NUMBER --}}
                    <div class="row">
                        <label for="max_number" class="form-label">{{ __('Max') }}</label>
                    </div>
                    <div class="row mb-4">
                        <input id="max_num" type="number" class="form-control @error('max_num') is-invalid @enderror"
                            name="max_num" required autocomplete="max_number" value="{{ old('max_num') }}">
                        @error('max_num')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="modal-footer border-0 text-center justify-content-center">
                            <button type="button" class="btn text-dark btn-cancel"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn text-white btn-blue">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
