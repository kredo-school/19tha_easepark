<!-- Delete -->
<div class="modal" id="delete-attribute-{{ $attribute->id }}">
    <div class="modal-dialog modal-sm">
        <form action="{{ route('admin.attributes.deactivate', $attribute->id) }}" method="POST">
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
                        <div class="col-8 text-center modal-head-color-red-transparent px-2 py-1">{{ $attribute->name }}</div>
                    </div>
                </div>
                <div class="text-center">Once delete, it cannot be undone.</div>
                <div class="modal-footer border-0 text-center justify-content-center">
                    <button type="button" class="btn text-dark btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white btn-red">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- restore -->
<div class="modal fade" id="restore-attribute-{{$attribute->id}}">
    <div class="modal-dialog modal-sm">
        <form action="{{ route('admin.attributes.restore', $attribute->id) }}" method="POST">
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
                    Once restore, it will be available for use.
                </div>
                <div class="modal-footer border-0 text-center justify-content-center">
                    <button type="button" class="btn text-dark btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white btn-info">Restore</button>
                </div>
            </div>
        </form>
    </div>
</div>