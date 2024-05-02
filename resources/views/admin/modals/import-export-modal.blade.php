@props(['importRoute', 'exportRoute', 'title'])
<button type="button" class="btn btn-success radius-30" data-bs-toggle="modal" data-bs-target="#importModal">
    Import {{ $title }}
</button>
<form action="{{ $exportRoute }}" method="GET">
    @csrf
    <button type="submit" class="btn btn-danger radius-30 mt-2 mt-lg-0 me-3" id="exportBtn">{{ __('Export') }}</button>
</form>
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">{{ __('Import') }} {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ $importRoute }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="position-relative mb-3">
                        <input type="file" name="file" class="form-control ps-5 radius-30" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('Import') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
