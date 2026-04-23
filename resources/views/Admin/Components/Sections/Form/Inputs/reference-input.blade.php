@php
    $name = $name ?? 'select';
    $label = $label ?? 'Tipo de referencia';
    $required = $required ?? false;
    $id = $id ?? 'type-input';

    $typeField = "{$name}[type]";
    $linkField = "{$name}[link]";
    $fileField = "{$name}[file]";

    $object = $form['object'] ?? null;
    $isEdit = $form['action'] === 'edit';

    $currentType = old($typeField,
        !empty($object->link) ? 'link' :
        (!empty($object->mime_type) && !empty($object->content_base64) ? (
            str_starts_with($object->mime_type, 'image/') ? 'image' : 'document'
        ) : 'link')
    );

    $currentLink = old($linkField, $object->link ?? null);
    $currentMime = $current_mime ?? $object->mime_type ?? null;
    $currentBase64 = $current_base64 ?? $object->content_base64 ?? null;

    $allowClear = $allow_clear ?? false;
@endphp

<div class="mb-4">
    {{-- Selector --}}
    <label for="{{ $id }}" class="form-label fw-bold">
        {{ $label }} @if($required)<span class="text-danger">*</span>@endif
    </label>
    <select name="{{ $typeField }}" id="{{ $id }}" class="form-control mb-3 tipo-selector" @if($required) required @endif>
        <option value="link" {{ $currentType === 'link' ? 'selected' : '' }}>Enlace</option>
        <option value="image" {{ $currentType === 'image' ? 'selected' : '' }}>Imagen</option>
        <option value="document" {{ $currentType === 'document' ? 'selected' : '' }}>Documento</option>
    </select>

    {{-- LINK --}}
    <div class="tipo-input tipo-link" style="display: none;">
        <label for="input-link-{{ $id }}" class="form-label fw-bold">URL</label>
        <input type="url" name="{{ $linkField }}" id="input-link-{{ $id }}" class="form-control" value="{{ $currentLink }}" placeHolder="ingrese el enlace...">
    </div>

    {{-- IMAGE --}}
    <div class="tipo-input tipo-image" style="display: none;">
        <label for="input-img-{{ $id }}" class="form-label fw-bold">Imagen</label>
        <label for="input-img-{{ $id }}" class="btn btn-outline-secondary w-100 mb-2">Seleccionar imagen</label>
        <input type="file" name="{{ $fileField }}" id="input-img-{{ $id }}" class="d-none" accept="image/*">
        <small id="file-name-img-{{ $id }}" class="text-muted fst-italic d-block">Ningún archivo seleccionado</small>

        {{-- Imagen actual --}}
        @if ($currentType === 'image' && $currentMime && str_starts_with($currentMime, 'image/') && $currentBase64)
            <div class="mt-2">
                <p class="text-sm text-muted mb-1">Imagen actual:</p>
                <img src="data:{{ $currentMime }};base64,{{ $currentBase64 }}" class="img-thumbnail" style="max-height: 150px;">
            </div>
        @endif

        {{-- Nueva imagen --}}
        <div id="preview-img-container-{{ $id }}" class="mt-2" style="display: none;">
            <p class="text-sm text-muted mb-1">Previsualización de nueva imagen:</p>
            <img id="preview-img-{{ $id }}" class="img-thumbnail" style="max-height: 150px;">
        </div>
    </div>

    {{-- DOCUMENT --}}
    <div class="tipo-input tipo-document" style="display: none;">
        <label for="input-doc-{{ $id }}" class="form-label fw-bold">Documento</label>
        <label for="input-doc-{{ $id }}" class="btn btn-outline-secondary w-100 mb-2">Seleccionar documento</label>
        <input type="file" name="{{ $fileField }}" id="input-doc-{{ $id }}" class="d-none" accept=".pdf">
        <small id="file-name-doc-{{ $id }}" class="text-muted fst-italic d-block">Ningún archivo seleccionado</small>

        <div id="preview-doc-container-{{ $id }}" class="mt-2">
            @if ($currentType === 'document' && $currentMime && $currentBase64)
                <a href="{{ generateBlankLink($currentBase64, $currentMime) }}" target="_blank" class="btn btn-sm btn-outline-secondary me-2">
                    Ver documento actual
                </a>
            @endif
            <a id="preview-doc-link-{{ $id }}" href="#" target="_blank" class="btn btn-sm btn-outline-primary" style="display: none;">
                Ver nuevo documento
            </a>
        </div>
    </div>

    {{-- Clear --}}
    @if (!$required && $allowClear)
        <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" name="{{ $name }}[clear]" id="clear-{{ $id }}" value="1">
            <label class="form-check-label text-danger" for="clear-{{ $id }}">
                Eliminar redirección actual
            </label>
        </div>
    @endif
</div>

@once
    @push('scripts')
        <script src="{{ asset('assets/js/admin/Forms/Inputs/type-selector.js') }}"></script>
    @endpush
@endonce
