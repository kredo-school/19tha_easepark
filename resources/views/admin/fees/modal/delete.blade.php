{{-- delete --}}
<div class="modal fade" id="delete-fee-{{ $fee->id }}">
    <div class="modal-dialog">
        <form action="{{ route('admin.fees.destroy', ['id' => $fee->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header justify-content-between modal-head-color-red">
                    <h1 class="modal-title ms-auto fs-5 text-white"><i class="fa-solid fa-trash-can"></i> Delete
                        Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-5 text-dark text-center mt-3">
                    Are you sure you want to delete the fee below?

                    <div class="my-4">
                        <span class="modal-head-color-red-transparent px-2 py-1 fw-bold">{{ $fee->name }}</span>
                    </div>
                    Once deleted, it cannot be undone.
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn text-dark btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white btn-red">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
