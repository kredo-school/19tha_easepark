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
                {{-- Will be included {{route('admin.areas.register')}} later --}}
                <form method="POST" action="#">
                    @csrf
        
                    {{-- Name --}}
                    <div class="row">
                        <label for="name" class="form-label">{{ __('Area Name') }}</label>
                    </div>
        
                    <div class="row mb-4">
                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        
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
                        {{-- Sample attribute data --}}
                        @php
                        $attributes = ['EV', 'General', 'Disability'];
                        @endphp
                        {{-- Sample attribute data --}}
        
                        <select id="attribute" name="attribute" class="form-control @error('attribute') is-invalid @enderror" required autocomplete="attribute">
                            @foreach ($attributes as $attribute)
                                <option value="{{ $attribute }}">{{ $attribute }}</option>
                            @endforeach
                        </select>
        
                        @error('attribute')
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
                        {{-- Sample fee data --}}
                        @php
                        $fees = ['20_Normal Season', '30_Peak Season', '15_Promotion'];
                        @endphp
                        {{-- Sample fee data --}}
        
                        <select id="fee" name="fee" class="form-control @error('fee') is-invalid @enderror" required autocomplete="fee">
                            @foreach ($fees as $fee)
                                <option value="{{ $fee }}">{{ $fee }}</option>
                            @endforeach
                        </select>
        
                        @error('fee')
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
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address">
        
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    {{-- MAX NUMBER --}}
                    <div class="row">
                        <label for="max_number" class="form-label">{{ __('Max Number') }}</label>
                    </div>
        
                    <div class="row mb-4">
                        <input id="max_number" type="number" class="form-control @error('max_number') is-invalid @enderror" name="max_number" required autocomplete="max_number">
        
                        @error('max_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <div class="row mb-3">
                        <div class="modal-footer border-0 text-center justify-content-center">
                            <button type="button" class="btn text-dark btn-cancel" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn text-white btn-blue">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
