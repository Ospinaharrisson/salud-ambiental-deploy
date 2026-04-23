
{{-- Créditos a Flatpickr --}}

@php
    $name = $name ?? 'date';
    $label = $label ?? ucfirst($name);
    $required = $required ?? false;
    $id = $id ?? $name;
    $object = $form['object'] ?? null;
    $isEdit = $form['action'] === 'edit';
    $value = old($name, $isEdit && !empty($object->{$name}) ? $object->{$name} : '');
@endphp

<div class="mb-4">
    <div class="d-flex justify-content-between">
        <label class="form-label">
            {{ $label }} @if($required) <span class="text-danger">*</span> @endif
        </label>
        
        <div class="text-right">
            <small>Powered by <a href="https://flatpickr.js.org" target="_blank" rel="noopener noreferrer">Flatpickr</a></small>
        </div>
    </div>

    <input 
        type="text" 
        id="flatpickr-{{ $id }}" 
        class="form-control input bg-white text-dark" 
        placeholder="Seleccione una fecha"
        autocomplete="off"
        @if($required) data-required="true" @endif
    >

    <input 
        type="date" 
        name="{{ $name }}" 
        id="{{ $id }}" 
        class="d-none"
        value="{{ $value }}"
        @if($required) required @endif
    >
</div>

@once
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/airbnb.css" rel="stylesheet">
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const inputs = document.querySelectorAll('[id^="flatpickr-"]');

                inputs.forEach(input => {
                    const hiddenId = input.id.replace('flatpickr-', '');
                    const hiddenInput = document.getElementById(hiddenId);

                    flatpickr(input, {
                        locale: 'es',
                        altInput: true,
                        altFormat: 'd/m/Y',
                        dateFormat: 'Y-m-d',
                        defaultDate: hiddenInput.value || null,
                        onChange: function(selectedDates, dateStr) {
                            hiddenInput.value = dateStr;
                        }
                    });

                    if (hiddenInput.value) {
                        input.value = hiddenInput.value;
                    }
                });
            });
        </script>
    @endpush
@endonce
