@props(['modalId', 'formAction', 'formMethod' => 'POST', 'modalTitle'])

<div class="font-sans-serif btn-reveal-trigger position-static">
    <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ $formAction }}" method="{{ $formMethod }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="{{ $modalId }}Label">{{ $modalTitle }}</h5>
                        <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <span class="fas fa-times fs-9"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ $slot }}
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Submit</button>
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
