{{-- activate --}}
<div class="modal fade" id="activate-fee-{{ $fee->id }}">
    <div class="modal-dialog">

        <form action="{{ route('admin.fees.activate', $fee->id) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="modal-content">
                <div class="modal-header justify-content-between modal-head-color">
                    <h1 class="modal-title ms-auto fs-5 text-white"><i class="fa-solid fa-rotate-left"></i> Activate Fee
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-5 text-dark text-center mt-3">
                    Are you sure you want to activate this fee?
                    <br>
                    <div class="my-4">
                        <span class="modal-head-color-blue-transparent px-2 py-1">{{ $fee->name }}</span>
                    </div>
                    The fee will be available for use.
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white btn-blue">Activate</button>
                </div>
            </div>
        </form>
    </div>
</div>
