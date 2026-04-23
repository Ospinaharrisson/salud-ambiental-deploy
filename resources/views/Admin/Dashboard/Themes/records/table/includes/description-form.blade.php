@php
    $id = $config['id'] ?? 'generic';
    $label = $config['title'] ?? 'Descripciones asociadas';
    $route = $config['route'] ?? 'admin.index';
    $params = $config['params'] ?? [];
    $method = $config['method'] ?? 'POST';
    $type = $config['type'] ?? '';
    $step = $config['step'] ?? '';
    $content = $descriptions ?? [];
@endphp

<div class="box-shadow rounded my-5 description-form" data-id="{{ $id }}">
    <div class="bg p-2">
        <h6 class="text-main m-0">{{ $label }}</h6>
    </div>
    <form action="{{ route($route, $params) }}" method="POST" class="m-4">
        @csrf
        @if ($method === 'PATCH')
            @method('PATCH')
        @endif

        <input type="text" name="type" value="{{ $type }}" hidden>
        <input type="text" name="step" value="{{ $step }}" hidden>

        <div id="{{ $id }}-container">
            <div class="mb-4">
                <label>Descripción</label>
                <input type="text" name="descriptions[]" 
                       class="form-control" 
                       placeholder="Descripción" 
                       value="{{ $content[0] ?? '' }}" 
                       required>
            </div>

            @if(count($content) > 1)
                @foreach(array_slice($content, 1) as $desc)
                    <div class="mb-4">
                        <label>Descripción</label>
                        <div class="input-group mb-3 description-template">
                            <input type="text" name="descriptions[]" 
                                   class="form-control" 
                                   placeholder="Descripción" 
                                   value="{{ $desc ?? '' }}" 
                                   required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-danger btn-sm remove-description">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            {{-- template base sin .description-template --}}
            <div id="{{ $id }}-template" class="mb-4 d-none">
                <label>Descripción</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Descripción">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger btn-sm remove-description">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center mt-4 mb-4">
            <button type="button"  id="{{ $id }}-add-description" class="btn btn-outline-primary me-3">añadir descripción</button>  
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>