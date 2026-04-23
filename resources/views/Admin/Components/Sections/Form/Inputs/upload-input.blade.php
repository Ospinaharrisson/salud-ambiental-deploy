@php
    $id = $id ?? 'upload';
    $name = $name ?? 'none';
    $label = $label ?? 'Seleccionar múltiples archivos';
    $type = $type ?? 'image';

    $accept = match($type) {
        'image' => 'image/*',
        'pdf' => 'application/pdf',
        default => '*/*',
    };

    $required = $required ?? false;
    $maxFiles = $max_files ?? 8;
@endphp

<div class="form-section">
    <label class="form-label" for="{{ $id }}">
        {{ $label }} @if($required) <span class="text-danger">*</span> @endif
    </label>

    <div class="file-upload-wrapper d-flex flex-column" tabindex="0">
        <i class="far fa-images"></i>
        <span class="file-upload-text my-4">Arrastra o haz clic para subir archivos</span>
        <input
            id="upload"
            type="file"
            name="{{ $name }}[]"
            multiple
            {{ $required ? 'required' : '' }}
            accept="{{ $accept }}"
            data-type="{{ $type }}"
            data-max-files="{{ $maxFiles }}"
        >
        <div>
            <button class="upload-button mb-3">buscar archivo</button>
        </div>
    </div>

    <div class="file-list mt-3">
        <ul style="padding: 0 !important"></ul>
    </div>

    <div class="invalid-feedback">
        Este campo es obligatorio.
    </div>
</div>

@once
    @push('styles')
        <link href="{{ asset('assets/css/admin/Forms/inputs/upload.css') }}" rel="stylesheet">
    @endpush
    @push('scripts')
        <script src="{{ asset('assets/js/admin/Forms/Inputs/upload.js') }}"></script>
    @endpush
@endonce
