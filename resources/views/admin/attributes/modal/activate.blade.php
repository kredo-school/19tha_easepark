<!-- activate -->
<div class="modal" id="activate-attribute-{{$attribute->id}}">
    <div class="modal-dialog modal-sm">
        <form action="{{ route('admin.attributes.activate', $attribute->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="modal-content">
                <div class="modal-header justify-content-between modal-head-color">
                    <h1 class="modal-title ms-auto fs-5 text-white"><i class="fa-solid fa-rotate-left pe-2"></i> Activate Attribute</h1>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-5 text-dark mt-3">
                    Are you sure you want to activate the attribute below?
                    <div class="my-4 d-flex justify-content-center">
                        <div class="col-8 text-center modal-head-color-blue-transparent px-2 py-1">{{ $attribute->name }}</div>
                    </div>
                    The administrator regains access to this Attribute.
                </div>
                <div class="modal-footer border-0 text-center justify-content-center">
                    <button type="button" class="btn text-dark btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white btn-blue">Activate</button>
                </div>
            </div>
        </form>
    </div>
</div>
