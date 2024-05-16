<div class="modal fade" id="deactivate-reservation-{{ $reservation->id }}">
    <div class="modal-dialog">
        <form action="{{ route('admin.reservations.deactivate', $reservation->id) }}" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header justify-content-between modal-head-color-red">
                    <h1 class="modal-title ms-auto fs-5 text-white"><i class="fa-solid fa-trash-can"></i> Deactivate
                        Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-5 text-dark text-center mt-3">
                    Are you sure you want to deactivate the reservation below?
                    <div class="row text-start my-2">
                        <ul class="col-auto list-unstyled lato-bold modal-head-color-red-transparent mx-auto px-2 py-1">
                            <li>Res. ID: <span>{{ $reservation->id }}</span></li>
                            <li>User Name: <span>{{ $reservation->user->name }}</span></li>
                            <li>Date: <span>{{ (new DateTime($reservation['date']))->format('F j, Y (D)') }}</span></li>
                            <li>Area: <span>{{ $reservation->area->name }}</span></li>
                            <li>Type: <span>{{ $reservation->area->attribute->name }}</span></li>
                            <li>Fee: <span>${{ $reservation->fee_log }}</span></li>
                        </ul>
                    </div>
                    The reservation data will no longer be accessible to the user
                    <br>but not permanently deleted.
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn text-dark btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white btn-red">Deactivate</button>
                </div>
            </div>
        </form>
    </div>
</div>
