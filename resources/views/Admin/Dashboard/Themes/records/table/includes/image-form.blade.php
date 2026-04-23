@php
    $route = $config['route'] ?? 'admin.index';
    $params = $config['parmas'] ?? [];
    $method = $config['method'] ?? 'POST';
    $selectedIds = $selected ?? [];
    $selectedImages = collect($images)->whereIn('id', $selectedIds)->values();
    $availableImages = collect($images)->whereNotIn('id', $selectedIds)->values();
@endphp

<div id="image-selector" class="my-5">
    <div class="box-rounded box-shadow mt-5 mb-4">
        <h6 class="border-bottom p-2 m-0 bg">Imagenes disponibles</h6>
        <div class="image-container d-flex flex-wrap justify-content-center align-items-center gap-2 border p-2" id="available-images">
            @foreach($availableImages as $item)
                <div class="image-item" data-id="{{ $item->id }}">
                    <p class="text-center fw-bold m-0">{{ $item->code }}</p>
                    <img src="{{ asset($item->path) }}" alt="img" class="img-fluid" style="width:90px; height:90px; object-fit:cover;">
                </div>
            @endforeach
        </div>
    </div>

    <form id="image-selector-form" action="{{ route($route, $params) }}" method="POST">
        @csrf
        @if ($method === 'PATCH')
            @method('PATCH')
        @endif
        <div class="box-rounded box-shadow">
            <div class="d-flex p-2 border-bottom bg">
                <h6 class="m-0">Imágenes seleccionadas</h6>
            </div>

            <div class="image-container d-flex flex-wrap justify-content-center align-items-center gap-2 border p-2" id="selected-images">
                @foreach($selectedImages as $item)
                    <div class="image-item" data-id="{{ $item->id }}">
                        <p class="text-center fw-bold m-0">{{ $item->code }}</p>
                        <img src="{{ asset($item->path) }}" alt="img" class="img-fluid" style="width:90px; height:90px; object-fit:cover;">
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-end p-2 border-top bg-light">
                <button type="submit" class="btn btn-primary" id="submit-selected" disabled>
                    Guardar selección
                </button>
            </div>
        </div>

        <input name="selected_images[]" value="id" hidden>
        <div id="selected-inputs"></div>
    </form>
</div>

@push('scripts')
    <script src="{{ asset('assets/js/admin/modules/Themes/Records/image-form.js') }}"></script>
@endpush
