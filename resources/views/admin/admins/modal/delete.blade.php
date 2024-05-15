{{-- delete --}}
<div class="modal fade" id="delete-admin-{{ auth('admin')->user()->id }}">
    <div class="modal-dialog">
        <form method="post" action="{{ route('admin.admins.delete') }}">
            @csrf
            @method('DELETE')

            <div class="modal-content">
                <div class="modal-header justify-content-between modal-head-color-red">
                    <h1 class="modal-title ms-auto fs-5 text-white"><i class="fa-solid fa-trash-can me-1"></i>Delete
                        Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-5 text-dark text-center mt-3">
                    Are you sure you want to delete the admin account below?
                    <div class="my-4">
                        <span class="modal-head-color-red-transparent px-2 py-1">{{ auth('admin')->user()->name }}</span>
                    </div>
                    Once deleted, it cannot be undone.
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn text-white btn-red">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
