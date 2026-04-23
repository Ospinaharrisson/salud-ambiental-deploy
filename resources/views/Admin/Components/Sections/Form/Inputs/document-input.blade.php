@php
    $name = $name ?? 'documento';
    $label = $label ?? ucfirst($name);
    $required = $required ?? false;
    $id = $id ?? 'documento';
    $object = $form['object'] ?? null;
    $isEdit = $form['action'] === 'edit';
    $currentDoc = $currentDoc ?? ($isEdit && !empty($object->{$name}) ? $object->{$name} : null);
    $currentDoc = $currentDoc ?? ($current_base64 ?? null);
    $currentMime = $currentMime ?? ($current_mime ?? 'application/pdf');
@endphp

<div class="mb-4">
    <label for="{{ $id }}" class="form-label">
        {{ $label }} @if($required)<span class="text-danger">*</span>@endif
    </label>

    <label for="{{ $id }}" class="btn btn-outline-dashboard-secondary w-100 mb-1">
        Seleccionar documento
    </label>

    <input 
        type="file"
        name="{{ $name }}"
        id="{{ $id }}"
        class="d-none"
        accept=".pdf"
        data-file-name="fileName-{{ $id }}"
        data-preview-doc-link="preview-doc-link-{{ $id }}"
        data-preview-doc-container="preview-doc-container-{{ $id }}"
    >
    <small id="fileName-{{ $id }}" class="text-muted fst-italic d-block">Ningún archivo seleccionado</small>

    @if ($currentDoc && $currentMime)
        <div class="mt-2">
            <p class="text-sm text-muted mb-1">Documento actual:</p>
            <a href="{{ generateBlankLink($currentDoc, $currentMime) }}"
               target="_blank"
               class="btn btn-sm btn-outline-primary">
                Ver documento
            </a>
        </div>
    @endif

    <div id="preview-doc-container-{{ $id }}" class="mt-2" style="display: none;">
        <p class="text-sm text-muted">Previsualización de nuevo documento:</p>
        <a id="preview-doc-link-{{ $id }}" href="#" target="_blank" class="btn btn-sm btn-outline-secondary">
            Ver nuevo documento
        </a>
    </div>
</div>

@once
    @push('scripts')
        <script src="{{ asset('assets/js/admin/Forms/Inputs/document.js') }}"></script>
    @endpush
@endonce
