{{-- Warning if the selected attribute is used --}}
<div class="modal fade" id="warning-attribute-{{ $attribute->id }}">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-between modal-head-color-red">
                    <h1 class="modal-title ms-auto fs-5 text-white"><i class="fa-solid fa-exclamation mx-2"></i> Warning</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-5 text-dark text-center mt-3">
                    The Attribute you selected is used in the Area below.
                    <div class="modal-head-color-red-transparent py-1">
                        @foreach ($attribute->areas as $area)
                            <ul class="text-start my-auto">
                                <li>{{ $area->name }}</li>
                            </ul>
                        @endforeach
                    </div>
                    If you want to delete it,<br>
                    please change the Attributes of these Areas first.
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn text-dark btn-cancel" data-bs-dismiss="modal">Close</button>
                    <a href="{{ route('admin.areas.show') }}" class="btn text-white btn-red">Show Areas</a>
                </div>
            </div>
    </div>
</div>
