{{-- delete --}}
<div class="modal fade" id="delete-reservation" tabindex="-1" role="dialog" aria-labelledby="delete-reservation" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-between modal-head-color-red">
                <h1 class="modal-title ms-auto fs-5 text-white"><i class="fa-solid fa-trash-can me-2"></i>Delete
                    Reservation</h1>
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
                
                <table class="table text-center">
                    <thead class="table-danger">
                        <th>ID</th>
                        <th>Area</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Fee</th>
                    </thead>
                    <tbody>
                        <th>{{ 1 }}</th>
                        <th>Area D, 2F</th>
                        <th>March 18 (Sun)</th>
                        <th>Disability</th>
                        <th>$20</th>
                    </tbody>
                </table>

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
