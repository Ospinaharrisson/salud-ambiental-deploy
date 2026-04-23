@php
    $name = $name ?? 'theme';
    $label = $label ?? 'Seleccionar color';
    $id = $id ?? 'color-input';
    $form = $form ?? [];
    $object = $form['object'] ?? null;
    $isEdit = $form['action'] === 'edit';
    $defaultColor = '#74b9ff';
    $value = old($name) ?? ($isEdit && $object?->$name ? $object->$name : $defaultColor);
@endphp

<div class="form-group mb-4">
    <div class="pickr-container">
        <label for="{{ $id }}">{{ $label }}</label>
        <div class="input-group my-colorpicker2 colorpicker-element" data-colorpicker-id="2">
            <input id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" class="form-control" placeholder="color" style="caret-color: transparent;" readonly>
            <div class="input-group-append">
                <span class="input-group-text" id="color-indicator">
                    <i class="fas fa-square" id="color-square" style="color: {{ $value }};"></i>
                </span>
            </div>
        </div>
        <div id="color-picker-container"></div>
    </div>
</div>

@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/admin/Forms/Inputs/color.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr"></script>
        <script src="{{ asset('assets/js/admin/Forms/Inputs/color.js') }}"></script>
    @endpush
@endonce
