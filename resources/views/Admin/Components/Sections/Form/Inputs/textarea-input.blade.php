
{{-- Créditos a Quill --}}

@php
    $name = $name ?? 'body';
    $id = $id ?? 'body';
    $label = $label ?? ucfirst($name);
    $required = $required ?? false;
    $formObject = $form['object'] ?? null;
    $formAction = $form['action'] ?? 'create';
    $value = old($name, $formAction === 'edit' && $formObject ? ($formObject[$name] ?? '') : '');
@endphp

<div class="form-section">
    <div class="d-flex justify-content-between">
        <label for="{{ $id }}" class="form-label">
            {{ $label }} @if($required) <span class="text-danger">*</span> @endif
        </label>
        
        <div class="text-right">
            <small>Powered by <a href="https://quilljs.com" target="_blank" rel="noopener noreferrer">Quill</a></small>
        </div>
    </div>

    {{-- Contenedor visual del editor --}}
    <div id="editor-{{ $id }}" class="form-control" style="min-height: 300px;">{!! $value !!}</div>

    {{-- Campo oculto que guarda el contenido --}}
    <textarea 
        name="{{ $name }}" 
        id="{{ $id }}" 
        style="display: none;" 
        {{ $required ? 'required' : '' }}
    >{{ $value }}</textarea>
</div>

@once
    @push('styles')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @endpush
    @push('scripts')
        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
        <script src="{{ asset('assets/js/admin/Forms/Inputs/quill/quill-config.js') }}"></script>
    @endpush
@endonce
