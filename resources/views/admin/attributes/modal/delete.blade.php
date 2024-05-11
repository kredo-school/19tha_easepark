<div class="modal" id="delete-attribute">
    <div class="modal-dialog modal-sm">
        <form id="delete-form" action="{{ route('admin.attributes.destroy', $attribute->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header justify-content-between modal-head-color-red">
                    <h1 class="modal-title ms-auto fs-5 text-white"><i class="fa-solid fa-trash-can pe-2"></i> Delete Confirmation </h1>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-5 text-dark mt-3">
                    <p>Are you sure you want to delete the attribute below?</p>
                    <div class="my-4 d-flex justify-content-center">
                        <div class="col-8 text center modal-head-color-red-transparent px-2 py-1">
                            <span id="attribute-name" class="fw-bold">{{ $attribute->name }}</span>
                        </div>
                    </div>
                    Once delete, it cannot be undone.
                </div>
                <div class="modal-footer border-0 text-center justify-content-center">
                    <button type="button" class="btn text-dark btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white btn-red">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
