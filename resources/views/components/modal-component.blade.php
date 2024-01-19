@props([
    'title' => '',
])

<div>
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">
                        {{ $title }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="showModalBody">
                    {{ $slot }}
                </div>
                <div class="modal-footer" id="showModalButtons"></div>
            </div>
        </div>
    </div>
</div>
