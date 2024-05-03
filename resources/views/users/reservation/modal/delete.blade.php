{{-- delete --}}
<div class="modal fade" id="delete-reservation" tabindex="-1" role="dialog" aria-labelledby="delete-reservation" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content justify-content-center">
            <div class="modal-header modal-head-color-red text-center justify-content-between">
                <h1 class="modal-title fs-5 text-white ms-auto"><i class="fa-solid fa-trash-can me-2"></i>Delete Reservation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-5">
                <form action="#">
                @csrf
                @method('DELETE')

                <p class="text-center my-4">
                    Are you sure you want to delete the following reservation?<br>
                    All associated data will be permanently removed.                    
                </p>

                <div class="row justify-content-center">
                    <div class="col-10 modal-head-color-red-transparent pt-3">
                        <ul>
                            <li>Area D, 2F &nbsp; March 18(Sun)	&nbsp; Disability &nbsp; $20</li>
                        </ul>
                    </div>
                </div>

                <p class="text-center my-4">
                    Once deleted, it cannot be undone.
                </p>

            <div class="modal-footer border-0">
                <button type="button" class="btn text-dark btn-cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn text-white btn-red">Delete</button>
            </div>
            </form>
        </div>
    </div>
</div>
