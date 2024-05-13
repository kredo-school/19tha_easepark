<div class="modal fw-bold" id="registerGuidanceModal">
    <div class="modal-dialog text-center modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-head-color">
                <h2 class="text-white mx-auto">Welcome to our website!</h2>
                <button type="button" class="btn-close btn-sm ms-auto" data-bs-dismiss="modal" style="filter: invert(1);"></button>
            </div>
            <div class="modal-body mx-4 d-flex align-items-center" style="height: 200px">
                <div>
                    <p>
                        To make a reservation, please register as a member or login if you already have an account.
                    </p>
                    <div class="d-flex justify-content-center">
                        <a href="{{route('register')}}" class="btn btn-blue text-white fw-bold me-4">Register</a>
                        <a href="{{route('login')}}" class="btn btn-outline-blue fw-bold">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>