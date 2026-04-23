@php
    $action = $form['action'] ?? 'create';
    $route = $form['route'] ?? 'admin.index';
    $params = $form['params'] ?? [];
    $method = $action === 'edit' ? 'PATCH' : 'POST';
    $object = $form['object'] ?? null;
    $fields = $fields ?? [];
    $showHeader = $form['header'] ?? true;
    $modal = !($form['modal'] ?? false);
    $headerTitle = $title ?? 'Nuevo Registro';
@endphp


<div class="box-rounded box-shadow my-5">
    @if ($showHeader)
        <div class="box-header">
            <h5 class="text-main mb-0">{{ $headerTitle }}</h5>
        </div>
    @endif

    <div class="box-body">
        <form 
            action="{{ route($route, $params) }}" 
            method="POST" 
            enctype="multipart/form-data" 
            id="dashboardForm" 
            novalidate
            >
            @csrf
            @if ($method === 'PATCH')
                @method('PATCH')
            @endif

            @foreach ($fields as $field)
                @php
                    $name = $field['name'];
                    $id = $field['id'] ?? $name;
                    $label = $field['label'] ?? ucfirst($name);
                    $required = $field['required'] ?? false;
                    $type = $field['type'] ?? 'text';
                    $value = old($name, $form['object'][$name] ?? ($field['value'] ?? ''));
                    $placeHolder = $field['placeHolder'] ?? 'complete el campo...';
                    $isHidden = $field['hidden'] ?? false;
                @endphp

                @if ($isHidden)
                    <input type="hidden" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}">
                @else
                    <div class="form-section">
                        <label class="form-label fw-bold" for="{{ $id }}">{{ $label }} @if($required) <span class="text-danger">*</span> @endif</label>
                        <input 
                            type="{{ $type }}" 
                            name="{{ $name }}" 
                            id="{{ $id }}" 
                            class="form-control"
                            value="{{ $value }}"
                            placeHolder = "{{ $placeHolder }}"
                            {{ $required ? 'required' : '' }}
                            @if ($type === 'number') step="0.01" @endif
                        >
                    </div>
                @endif
            @endforeach

            @php
                $widgets = $widgets ?? [];
                $widgetOrder = array_keys($widgets);
            @endphp

            @foreach ($widgetOrder as $widgetType)
                @if (!empty($widgets[$widgetType]['enabled']))
                    @switch($widgetType)
                    
                        @case('textarea')
                            @include('Admin.Components.Sections.Form..Inputs.textarea-input', [
                                'name' => $widgets[$widgetType]['name'] ?? 'body',
                                'label' => $widgets[$widgetType]['label'] ?? ucfirst($widgets[$widgetType]['name'] ?? 'body'),
                                'required' => $widgets[$widgetType]['required'] ?? false,
                                'id' => $widgets[$widgetType]['id'] ??  'body',
                                'form' => $form
                            ])
                            @break
                            
                        @case('image')
                            @include('Admin.Components.Sections.Form..Inputs.image-input', [
                                'name' => $widgets[$widgetType]['name'] ?? 'imagen',
                                'label' => $widgets[$widgetType]['label'] ?? ucfirst($widgets[$widgetType]['name'] ?? 'imagen'),
                                'required' => $widgets[$widgetType]['required'] ?? false,
                                'id' => $widgets[$widgetType]['id'] ?? 'imagen',
                                'currentPreview' => $widgets[$widgetType]['currentPreview'] ?? true,
                                'form' => $form,
                                'modal' => $form['modal'] ?? false
                            ])
                            @break
                            
                        @case('select')
                            @include('Admin.Components.Sections.Form..Inputs.reference-input', [
                                'name' => $widgets[$widgetType]['name'] ?? 'select',
                                'label' => $widgets[$widgetType]['label'] ?? 'Archivo o enlace',
                                'required' => $widgets[$widgetType]['required'] ?? false,
                                'id' => $widgets[$widgetType]['id'] ?? 'file',
                                'allow_clear' => $widgets[$widgetType]['allow_clear'] ?? false,
                                'form' => $form
                            ])
                            @break
                            
                        @case('date')
                            @include('Admin.Components.Sections.Form..Inputs.date-input', [
                                'name' => $widgets[$widgetType]['name'] ?? 'date',
                                'label' => $widgets[$widgetType]['label'] ?? ucfirst($widgets[$widgetType]['name'] ?? 'date'),
                                'required' => $widgets[$widgetType]['required'] ?? false,
                                'id' => $widgets[$widgetType]['id'] ?? 'date',
                                'form' => $form
                            ])
                            @break
                            
                        @case('document')
                            @include('Admin.Components.Sections.Form..Inputs.document-input', [
                                'name' => $widgets[$widgetType]['name'] ?? 'documento',
                                'label' => $widgets[$widgetType]['label'] ?? 'documento',
                                'required' => $widgets[$widgetType]['required'] ?? false,
                                'id' => $widgets[$widgetType]['id'] ?? 'documento',
                                'form' => $form,
                                'current_base64' => $widgets[$widgetType]['current_base64'] ?? null,
                                'current_mime' => $widgets[$widgetType]['current_mime'] ?? null,
                            ])
                            @break
                            
                        @case('upload')
                            @include('Admin.Components.Sections.Form..Inputs.upload-input', [
                                'name' => $widgets[$widgetType]['name'] ?? 'files',
                                'label' => $widgets[$widgetType]['label'] ?? 'Seleccionar multiples archivos',
                                'required' => $widgets[$widgetType]['required'] ?? false,
                                'type' => $widgets[$widgetType]['type'] ?? 'file',
                                'max_files' => $widgets[$widgetType]['maxFiles'] ?? 8,
                                'id' => $widgets[$widgetType]['id'] ?? 'upload',
                            ])
                            @break
                        
                        @case('color')
                            @include('Admin.Components.Sections.Form..Inputs.color-input', [
                                'id' => $widgets[$widgetType]['id'] ?? 'color-input',
                                'name' => $widgets[$widgetType]['name'] ?? 'theme',
                                'label' => $widgets[$widgetType]['label'] ?? 'Seleccionar color',
                                'form' => $form
                            ])
                            @break

                        @case('checkbox')
                            @include('Admin.Components.Sections.Form..Inputs.checkbox-input', [
                                'name' => $widgets[$widgetType]['name'] ?? 'checkbox',
                                'label' => $widgets[$widgetType]['label'] ?? 'Activar opción',
                                'id' => $widgets[$widgetType]['id'] ?? 'checkbox',
                                'checked' => $widgets[$widgetType]['checked'] ?? false,
                                'form' => $form
                            ])
                            @break
                            
                        @default                            
                    @endswitch
                @endif
            @endforeach
            
            <button type="submit" class="btn btn-dashboard-primary w-100">
                {{ $action === 'edit' ? 'Guardar Cambios' : 'Guardar' }}
            </button>
        </form>
    </div>
</div>

<script src="{{ asset('assets/js/admin/Forms/form-enhancement.js') }}"></script>
<script src="{{ asset('assets/js/admin/Forms/form-validation.js') }}"></script>
