<div class="modal fade" id="activate-reservation-{{ $reservation->id }}">
    <div class="modal-dialog">

        <form action="{{ route('admin.reservations.activate', $reservation->id) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="modal-content">
                <div class="modal-header justify-content-between modal-head-color">
                    <h1 class="modal-title ms-auto fs-5 text-white"><i class="fa-solid fa-rotate-left"></i> Activate Reservation
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-5 text-dark text-center mt-3">
                    Are you sure you want to activate this reservation?
                    <div class="row text-start my-2">
                        <ul class="col-auto list-unstyled lato-bold modal-head-color-blue-transparent mx-auto px-2 py-1">
                            <li>Res. ID: <span>{{ $reservation->id }}</span></li>
                            <li>User Name: <span>{{ $reservation->user->name }}</span></li>
                            <li>Date: <span>{{ (new DateTime($reservation['date']))->format('F j, Y (D)') }}</span></li>
                            <li>Area: <span>{{ $reservation->area->name }}</span></li>
                            <li>Type: <span>{{ $reservation->area->attribute->name }}</span></li>
                            <li>Fee: <span>${{ $reservation->fee_log }}</span></li>
                        </ul>
                    </div>
                    The reservation will be reinstated.
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white btn-blue">Activate</button>
                </div>
            </div>
        </form>
    </div>
</div>
