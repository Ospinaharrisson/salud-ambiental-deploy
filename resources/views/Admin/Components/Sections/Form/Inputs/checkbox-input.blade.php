@php
    $name = $name ?? 'checkbox';
    $label = $label ?? 'Activar opción';
    $id = $id ?? $name;
    $form = $form ?? [];
    $object = $form['object'] ?? null;
    $isEdit = ($form['action'] ?? 'create') === 'edit';

    $value = old($name, $isEdit && $object ? $object->$name : ($checked ?? false));
@endphp

<div class="form-group mb-4">
    <div class="form-check">
        <input
            type="checkbox"
            name="{{ $name }}"
            id="{{ $id }}"
            class="form-check-input"
            value="1"
            {{ $value ? 'checked' : '' }}
        >
        <label class="form-check-label" for="{{ $id }}">
            {{ $label }}
        </label>
    </div>
</div>