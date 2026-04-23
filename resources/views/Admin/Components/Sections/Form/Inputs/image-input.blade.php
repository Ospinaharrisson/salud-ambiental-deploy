@php
    $name = $name ?? 'imagen';
    $label = $label ?? ucfirst($name);
    $required = $required ?? false;
    $id = $id ?? 'imagen';
    $object = $form['object'] ?? null;
    $isEdit = $form['action'] === 'edit';
    $showPreview = $currentPreview ?? true;
    $currentImage = $isEdit && !empty($object->{$name}) ? $object->{$name} : null;
@endphp

<div class="mb-4">
    <label for="{{ $id }}" class="form-label fw-bold">
        {{ $label }} @if($required) <span class="text-danger">*</span> @endif
    </label>

    <label for="{{ $id }}" class="btn btn-outline-dashboard-secondary w-100 mb-1">
        Seleccionar imagen
    </label>

    <input 
        type="file" 
        name="{{ $name }}" 
        id="{{ $id }}" 
        class="d-none" 
        accept="image/*" 
        @if($required) required @endif

        data-file-name="fileName-{{ $id }}"
        data-preview-label="preview-label-{{ $id }}"
        data-preview-image="preview-image-{{ $id }}"
        data-preview-container="preview-container-{{ $id }}"
        data-modal-image="modal-preview-image-{{ $id }}"
        data-preview-btn="btn-preview-{{ $id }}"
    >

    <small id="fileName-{{ $id }}" class="text-muted fst-italic d-block">Ningún archivo seleccionado</small>

    @if ($currentImage && $showPreview)
        <div class="mt-2">
            <p class="text-sm text-muted">Imagen Actual:</p>
            <img src="{{ renderBase64Image($currentImage) }}" alt="Current image" class="img-thumbnail" style="max-height: 150px;">

            <button type="button" class="btn btn-sm btn-outline-secondary mt-2" data-bs-toggle="modal" data-bs-target="#currentImageModal-{{ $id }}">
                Ver imagen Actual
            </button>
        </div>
    @endif

    <div id="preview-container-{{ $id }}" class="mt-2" style="display: {{ $isEdit ? 'none' : 'block' }};">
        <div id="preview-label-{{ $id }}" style="display: none;">
            <p class="text-sm text-muted">Preview:</p>
        </div>
        <img id="preview-image-{{ $id }}" class="img-thumbnail" style="max-height: 150px;">
    </div>

    @if(!$modal)
        <button type="button" id="btn-preview-{{ $id }}" class="btn btn-sm btn-outline-primary d-none mt-2" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $id }}">
            Previsualización de la imagen
        </button>
    @endif
</div>

@if ($currentImage && $showPreview)
    <div class="modal fade" id="currentImageModal-{{ $id }}" tabindex="-1" aria-labelledby="currentImageModalLabel-{{ $id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="currentImageModalLabel-{{ $id }}">imagen actual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ renderBase64Image($currentImage) }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endif

<div class="modal fade" id="imageModal-{{ $id }}" tabindex="-1" aria-labelledby="imageModalLabel-{{ $id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel-{{ $id }}">Previsualización de la nueva imagen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modal-preview-image-{{ $id }}" class="img-fluid">
            </div>
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script src="{{ asset('assets/js/admin/Forms/Inputs/image.js') }}"></script>
    @endpush
@endonce
