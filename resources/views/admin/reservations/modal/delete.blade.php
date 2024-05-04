<div class="modal fade" id="delete-reservation">
    <div class="modal-dialog">
        <form action="#">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header justify-content-between modal-head-color-red">
                    <h1 class="modal-title ms-auto fs-5 text-white"><i class="fa-solid fa-trash-can"></i> Delete
                        Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-5 text-dark text-center mt-3">
                    Are you sure you want to delete the user's reservation below?
                    <div class="row text-start my-2">
                        <ul class="col-auto list-unstyled lato-bold modal-head-color-red-transparent mx-auto px-2 py-1">
                            <li>User Name: <span>{{'John Doe'}}</span></li>
                            <li>Date: <span>{{'March 21 (Wed)'}}</span></li>
                            <li>Area: <span>{{'Area A, 1F'}}</span></li>
                            <li>Type: <span>{{'Disability'}}</span></li>
                            <li>Fee: <span>${{20}}</span></li>
                        </ul>
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
