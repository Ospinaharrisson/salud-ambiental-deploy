<div>
    <div class="box-rounded box-shadow my-5" id="{{ $sort['id'] ?? '' }}">
        @if (!empty($header['enabled']))
            <div class="box-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                {{-- Título + badge --}}
                <div class="d-flex align-items-center gap-2" style="flex: 1;">
                    <h5 class="text-main mb-0">
                        {{ $header['title'] ?? '' }}
                    </h5>

                    @if (!empty($header['status']['enabled']))
                        @php
                            $statusKey = $header['status']['key'] ?? 'is_active';
                            $var = $header['status']['object'] ?? null;
                            $isActive = $var[$statusKey] ?? false;
                        @endphp
                        <span class="text-light badge {{ $isActive ? 'badge-dashboard-on' : 'badge-dashboard-off' }}">
                            {{ $isActive ? 'Activo' : 'Inactivo' }}
                        </span>
                    @endif
                </div>

                {{-- Botón principal --}}
                @if (!empty($header['action']['enabled']))
                    @php
                        $action = $header['action'];
                        $actionRoute = $action['route'] ?? 'admin.index';
                        $actionParams = $action['params'] ?? [];
                        $actionName = $action['name'] ?? 'Agregar';
                        $actionIcon = $action['icon'] ?? 'null';
                        $redirect = $action['redirect'] ?? true;
                        $buttonId = $action['id'] ?? null;
                        $resolvedActionParams = [];
                        foreach ($actionParams as $key => $param) {
                            if ($param instanceof Closure) {
                                $resolvedActionParams[$key] = $param(null);
                            } else {
                                $resolvedActionParams[$key] = $param;
                            }
                        }
                        if (isset($module) && !is_null($module)) {
                            $resolvedActionParams['module'] = $module;
                        }
                        if (isset($ancestors) && is_array($ancestors) && !empty($ancestors)) {
                            foreach ($ancestors as $ancestorKey => $ancestorValue) {
                                $resolvedActionParams[$ancestorKey] = $ancestorValue;
                            }
                        }
                    @endphp
                    <a 
                        @if($buttonId) id="{{ $buttonId }}" @endif
                        @if($redirect !== false)
                            href="{{ route($actionRoute, $resolvedActionParams) }}"
                        @else
                            href="#" onclick="event.preventDefault();"
                        @endif
                        class="btn btn-sm btn-outline-dashboard-primary d-inline-flex align-items-center justify-content-center"
                    >
                        <i class="bi bi-{{ $actionIcon }} me-2"></i> {{ $actionName }}
                    </a>
                @endif
            </div>
        @endif

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-spacing table-hover align-middle w-100" style="table-layout: fixed;" id="dashboardTable">
                    <colgroup>
                        @if (!empty($sort['enabled']))
                            <col style="width: 10% !important;">
                        @endif
                        @foreach (($fields ?? []) as $index => $field)
                            @php
                                $col = $columns[$index] ?? null;
                                $width = is_array($col) && isset($col['width']) ? $col['width'] : null;
                            @endphp
                            <col {!! $width ? "style=\"width: $width !important; max-width: $width !important; min-width: $width !important;\"" : '' !!}>
                        @endforeach
                        @if (!empty($status['enabled']))
                            <col style="width: 10% !important;">
                        @endif
                        @if (!empty($status['extra']['enabled']))
                            <col style="width: 10% !important;">
                        @endif
                        @if (!empty($edit['enabled']) || !empty($toggle['enabled']) || (!empty($actions['enabled']) && !empty($actions['buttons'])))
                            <col style="width: 20% !important;">
                        @endif
                    </colgroup>

                    @if (!empty($columns))
                        <thead class="table-header">
                            <tr>
                                @if (!empty($sort['enabled']))
                                    <th class="table-header-cell text-center align-middle">Orden</th>
                                @endif

                                @foreach (($fields ?? []) as $index => $field)
                                    <th class="table-header-cell px-3 py-2 text-{{ $alignments[$field] ?? 'start' }} align-middle">
                                        {{ is_array($columns[$index] ?? null) ? $columns[$index]['label'] : ($columns[$index] ?? ucfirst($field)) }}
                                    </th>
                                @endforeach
                                @if (!empty($status['enabled']))
                                    <th class="table-header-cell text-center align-middle">Estado</th>
                                @endif
                                @if (!empty($status['extra']['enabled']))
                                    <th class="table-header-cell text-center align-middle">
                                        {{ $status['extra']['label'] ?? 'Estado adicional' }}
                                    </th>
                                @endif
                                @if (!empty($edit['enabled']) || !empty($toggle['enabled']) || (!empty($actions['enabled']) && !empty($actions['buttons'])))
                                    <th class="table-header-cell text-center align-middle">Acciones</th>
                                @endif
                            </tr>
                        </thead>
                    @endif

                    @if (!empty($items) && !empty($fields))
                        @php
                            $pageSize = $pageSize['enabled'] ?? true;
                        @endphp
                        @if($pageSize)
                            {{-- Selector de cantidad de registros por página --}}
                            <div class="d-flex justify-content-end align-items-center mb-2" style="gap: 0.5rem;">
                                <label for="perPage" class="me-2 mb-0">Mostrar</label>
                                <select id="perPage" class="form-select form-select-sm w-auto" wire:model="perPage">
                                    @foreach([5, 10, 25, 50, 100] as $size)
                                        <option value="{{ $size }}">{{ $size }}</option>
                                    @endforeach
                                </select>
                                <span class="ms-2">registros</span>
                            </div>
                        @endif
                        @php
                            $resolvedSortParams = [];
                            $sortParams = $sort['params'] ?? [];
                            foreach ($sortParams as $key => $param) {
                                if ($param instanceof Closure) {
                                    $resolvedSortParams[$key] = $param(null);
                                } elseif (in_array($param, ['id', 'item-id'])) {
                                    $resolvedSortParams[$key] = null;
                                } else {
                                    $resolvedSortParams[$key] = $param;
                                }
                            }
                            if (isset($module) && !is_null($module)) {
                                $resolvedSortParams['module'] = $module;
                            }
                            if (isset($ancestors) && is_array($ancestors) && !empty($ancestors)) {
                                foreach ($ancestors as $ancestorKey => $ancestorValue) {
                                    $resolvedSortParams[$ancestorKey] = $ancestorValue;
                                }
                            }
                        @endphp
                        <tbody @if(!empty($sort['enabled'])) class="sortable" data-route="{{ route($sort['route'], $resolvedSortParams) }}" @endif>
                            @forelse ($items ?? [] as $item)
                                <tr data-id="{{ $item->id }}">
                                    @if (!empty($sort['enabled']))
                                        <td class="table-body-cell text-center align-middle handle">
                                            <i class="bi bi-list fs-5" title="Arrastrar para reordenar"></i>
                                        </td>
                                    @endif

                                    @foreach (($fields ?? []) as $field)
                                        @php $alignment = $alignments[$field] ?? 'start'; @endphp
                                        <td class="table-body-cell px-3 py-2 text-{{ $alignment }} align-middle">
                                            @php $text = $item[$field] ?? 'Sin datos'; @endphp
                                            {{ mb_strlen($text) > 70 ? mb_strimwidth($text, 0, 70, '...') : $text }}
                                        </td>
                                    @endforeach

                                    @if (!empty($status['enabled']))
                                        @php
                                            $statusKey = $status['statusKey'] ?? 'is_active';
                                            $isActive = $item[$statusKey] ?? false;
                                        @endphp
                                        <td class="table-body-cell text-center align-middle">
                                            <span class="text-light badge {{ $isActive ? 'badge-dashboard-on' : 'badge-dashboard-off' }}">
                                                {{ $isActive ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </td>
                                    @endif

                                    @if (!empty($status['extra']['enabled']))
                                        @php
                                            $extraKey = $status['extra']['key'] ?? null;
                                            $extraValue = $extraKey ? ($item[$extraKey] ?? false) : false;
                                        @endphp
                                    
                                        <td class="table-body-cell text-center align-middle">
                                            <span class="text-light badge {{ $extraValue ? 'badge-dashboard-on' : 'badge-dashboard-off' }}">
                                                {{ $extraValue ? 'Sí' : 'No' }}
                                            </span>
                                        </td>
                                    @endif

                                    @if (!empty($edit['enabled']) || !empty($toggle['enabled']) || (!empty($actions['enabled']) && !empty($actions['buttons'])))
                                        <td class="table-body-cell text-center align-middle">
                                            <div class="d-flex flex-wrap justify-content-center gap-2 flex-sm-row flex-column">

                                                {{-- Botones de acciones personalizados --}}
                                                @if (!empty($actions['enabled']) && !empty($actions['buttons']))
                                                    @foreach ($actions['buttons'] as $button)
                                                        @php
                                                            $route = $button['route'] ?? 'admin.index';
                                                            $params = $button['params'] ?? [$item['id']];
                                                            $class = $button['class'] ?? 'btn-outline-dashboard-primary';
                                                            $class = $class instanceof Closure ? $class($item) : $class;
                                                            $icon = $button['icon'] ?? 'arrow-right-square';
                                                            $title = $button['title'] ?? 'Nueva acción';

                                                            $resolvedParams = [];
                                                            foreach ($params as $key => $param) {
                                                                if ($param instanceof Closure) {
                                                                    $resolvedParams[$key] = $param($item);
                                                                } elseif (in_array($param, ['id', 'item-id'])) {
                                                                    $resolvedParams[$key] = $item->id;
                                                                } else {
                                                                    $resolvedParams[$key] = $param;
                                                                }
                                                            }
                                                            if (isset($module) && !is_null($module)) {
                                                                $resolvedParams['module'] = $module;
                                                            }
                                                            if (isset($ancestors) && is_array($ancestors) && !empty($ancestors)) {
                                                                foreach ($ancestors as $ancestorKey => $ancestorValue) {
                                                                    $resolvedParams[$ancestorKey] = $ancestorValue;
                                                                }
                                                            }
                                                        @endphp
                                                        <a href="{{ route($route, $resolvedParams) }}" class="btn btn-sm {{ $class }}" title="{{ $title }}">
                                                            <i class="bi bi-{{ $icon }}"></i>
                                                        </a>
                                                    @endforeach
                                                @endif

                                                {{-- Botón Edit --}}
                                                @if (!empty($edit['enabled']))
                                                    @php
                                                        $editRoute = $edit['route'] ?? 'admin.index';
                                                        $editParams = $edit['params'] ?? [$item->id];
                                                        $redirect = $edit['redirect'] ?? true;
                                                        $buttonId = $edit['id'] ?? null;
                                                        $resolvedEditParams = [];
                                                        foreach ($editParams as $key => $param) {
                                                            if ($param instanceof Closure) {
                                                                $resolvedEditParams[$key] = $param($item);
                                                            } elseif (in_array($param, ['id', 'item-id'])) {
                                                                $resolvedEditParams[$key] = $item->id;
                                                            } else {
                                                                $resolvedEditParams[$key] = $param;
                                                            }
                                                        }
                                                        if (isset($module) && !is_null($module)) {
                                                            $resolvedEditParams['module'] = $module;
                                                        }
                                                        if (isset($ancestors) && is_array($ancestors) && !empty($ancestors)) {
                                                            foreach ($ancestors as $ancestorKey => $ancestorValue) {
                                                                $resolvedEditParams[$ancestorKey] = $ancestorValue;
                                                            }
                                                        }
                                                    @endphp
                                                        <a 
                                                        @if($buttonId) id="{{ $buttonId }}" @endif
                                                        @if($redirect !== false)
                                                            href="{{ route($editRoute, $resolvedEditParams) }}"
                                                        @else
                                                            href="#" onclick="event.preventDefault();"
                                                        @endif
                                                        class="btn btn-edit btn-sm" title="Editar"
                                                    >
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                @endif

                                                {{-- Botón Toggle --}}
                                                @if (!empty($toggle['enabled']))
                                                    @php
                                                        $toggleRoute = $toggle['route'] ?? 'admin.index';
                                                        $toggleParams = $toggle['params'] ?? [$item->id];
                                                        $resolvedToggleParams = [];
                                                        foreach ($toggleParams as $key => $param) {
                                                            if ($param instanceof Closure) {
                                                                $resolvedToggleParams[$key] = $param($item);
                                                            } elseif (in_array($param, ['id', 'item-id'])) {
                                                                $resolvedToggleParams[$key] = $item->id;
                                                            } else {
                                                                $resolvedToggleParams[$key] = $param;
                                                            }
                                                        }
                                                        if (isset($module) && !is_null($module)) {
                                                            $resolvedToggleParams['module'] = $module;
                                                        }
                                                        if (isset($ancestors) && is_array($ancestors) && !empty($ancestors)) {
                                                            foreach ($ancestors as $ancestorKey => $ancestorValue) {
                                                                $resolvedToggleParams[$ancestorKey] = $ancestorValue;
                                                            }
                                                        }
                                                        $statusKey = $statusKey ?? 'is_active';
                                                        $isActive = $item[$statusKey] ?? false;
                                                    @endphp
                                                    <form action="{{ route($toggleRoute, $resolvedToggleParams) }}" method="POST" style="display:inline-block">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm {{ $isActive ? 'btn-toggle-off' : 'btn-toggle-on' }}" title="{{ $isActive ? 'Desactivar' : 'Activar' }}">
                                                            <i class="bi bi-power"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                {{-- Botón Delete --}}
                                                @if (!empty($delete['enabled']))
                                                    @php
                                                        $deleteRoute = $delete['route'] ?? 'admin.index';
                                                        $deleteParams = $delete['params'] ?? [$item->id];
                                                        $resolvedDeleteParams = [];
                                                        foreach ($deleteParams as $key => $param) {
                                                            if ($param instanceof Closure) {
                                                                $resolvedDeleteParams[$key] = $param($item);
                                                            } elseif (in_array($param, ['id', 'item-id'])) {
                                                                $resolvedDeleteParams[$key] = $item->id;
                                                            } else {
                                                                $resolvedDeleteParams[$key] = $param;
                                                            }
                                                        }
                                                        if (isset($module) && !is_null($module)) {
                                                            $resolvedDeleteParams['module'] = $module;
                                                        }
                                                        if (isset($ancestors) && is_array($ancestors) && !empty($ancestors)) {
                                                            foreach ($ancestors as $ancestorKey => $ancestorValue) {
                                                                $resolvedDeleteParams[$ancestorKey] = $ancestorValue;
                                                            }
                                                        }
                                                        $deleteIcon = $delete['icon'] ?? 'trash';
                                                        $modalId = 'deleteModal-' . $item->id;
                                                    @endphp
                                                    <button type="button" class="btn btn-sm btn-danger" title="Eliminar" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                                        <i class="bi bi-{{ $deleteIcon }}"></i>
                                                    </button>

                                                    {{-- Modal --}}
                                                    <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="{{ $modalId }}Label">Confirmar eliminación</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {{ $delete['message'] ?? '¿Está seguro de eliminar este elemento?' }}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                    <form action="{{ route($deleteRoute, $resolvedDeleteParams) }}" method="POST" style="display:inline-block">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="table-body-cell text-center text-muted py-4">
                                        Sin resultados
                                    </td>
                                </tr>
                            @endforelse
                            @if (!empty($create['enabled']))
                                @php
                                    $createRoute = $create['route'] ?? 'admin.index';
                                    $createParams = $create['params'] ?? [];
                                    $resolvedCreateParams = [];

                                    foreach ($createParams as $key => $param) {
                                        $resolvedCreateParams[$key] = $param instanceof Closure ? $param([]) : $param;
                                    }
                                
                                    $name = $create['name'] ?? 'Agregar nuevo elemento';
                                    $icon = $create['icon'] ?? 'bi bi-plus-circle';
                                @endphp
                                <tr>
                                    <td colspan="{{ count($fields ?? []) + ($sort['enabled'] ?? false ? 1 : 0) + ($status['enabled'] ?? false ? 1 : 0) + ($status['extra']['enabled'] ?? false ? 1 : 0) + ((($edit['enabled'] ?? false) || ($toggle['enabled'] ?? false) || (!empty($actions['buttons'] ?? []))) ? 1 : 0) }}">
                                        <a href="{{ route($createRoute, $resolvedCreateParams) }}" class="btn btn-dashboard-primary w-100">
                                            <i class="{{ $icon }} me-2"></i> {{ $name }}
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>

    @if (!empty($sort['enabled']))
        @once
            @push('scripts')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const tbody = document.querySelector('.sortable');
                        if (!tbody) return;

                        new Sortable(tbody, {
                            animation: 150,
                            handle: '.handle',
                            onEnd: function () {
                                const ids = Array.from(tbody.querySelectorAll('tr')).map(row => row.dataset.id);
                                const route = tbody.dataset.route;
                            
                                let loader = iziToast.info({
                                    title: 'Guardando...',
                                    message: 'Espere un momento',
                                    timeout: false,
                                    close: false,
                                    position: 'topRight',
                                    icon: 'fa fa-spinner fa-spin'
                                });
                            
                                fetch(route, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({ order: ids })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    iziToast.destroy();
                                    if (data.mensaje) {
                                        iziToast.success({
                                            title: 'Éxito',
                                            message: data.mensaje,
                                            position: 'topRight',
                                            timeout: 3000
                                        });
                                    }
                                })
                                .catch(() => {
                                    iziToast.destroy();
                                    iziToast.error({
                                        title: 'Error',
                                        message: 'No se pudo actualizar el orden',
                                        position: 'topRight'
                                    });
                                });
                            }
                        });
                    });
                </script>
            @endpush
        @endonce
    @endif

    @include('Shared.Components.pagination')
</div>