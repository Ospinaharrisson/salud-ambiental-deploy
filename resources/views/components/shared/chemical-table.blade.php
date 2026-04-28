
<div class="table-responsive">
    <table class="table table-hover border mt-2 mb-4">
        <thead>
            <tr class="table-header">
                <th style="background-color: {{ $theme }}" 
                    wire:click="sortByColumn('name')"
                    class="sorting {{ $sortField === 'name' ? 'sorting-' . $sortBy : 'sorting' }}">
                    <div class="cell-header">
                        <span class="cell-text">Nombre</span>
                        <span class="sort-icon"></span>
                    </div>
                </th>

                <th style="background-color: {{ $theme }}" 
                    wire:click="sortByColumn('cas_number')"
                    class="sorting {{ $sortField === 'cas_number' ? 'sorting-' . $sortBy : 'sorting' }}">
                    <div class="cell-header">
                        <span class="cell-text">N° Registro CAS</span>
                        <span class="sort-icon"></span>
                    </div>
                </th>

                <th style="background-color: {{ $theme }}" 
                    wire:click="sortByColumn('onu_number')"
                    class="sorting {{ $sortField === 'onu_number' ? 'sorting-' . $sortBy : 'sorting' }}">
                    <div class="cell-header">
                        <span class="cell-text">N° Registro ONU</span>
                        <span class="sort-icon"></span>
                    </div>
                </th>

                <th style="background-color: {{ $theme }}" 
                    wire:click="sortByColumn('monthly_stored')"
                    class="sorting {{ $sortField === 'monthly_stored' ? 'sorting-' . $sortBy : 'sorting' }}">
                    <div class="cell-header">
                        <span class="cell-text">Cantidad Menusalmente Almacenada</span>
                        <span class="sort-icon"></span>
                    </div>
                </th>

                <th style="background-color: {{ $theme }}" 
                    wire:click="sortByColumn('monthly_used')"
                    class="sorting {{ $sortField === 'monthly_used' ? 'sorting-' . $sortBy : 'sorting' }}">
                    <div class="cell-header">
                        <span class="cell-text">Cantidad Mensual utilizada</span>
                        <span class="sort-icon"></span>
                    </div>
                </th>

                <th style="background-color: {{ $theme }}" 
                    wire:click="sortByColumn('score')"
                    class="sorting {{ $sortField === 'score' ? 'sorting-' . $sortBy : 'sorting' }}">
                    <div class="cell-header">
                        <span class="cell-text">Puntaje</span>
                        <span class="sort-icon"></span>
                    </div>
                </th>

                <th style="background-color: {{ $theme }}">
                    <div class="cell-header">
                        <span class="cell-text">{{ $actionsTitle ?? 'Detalles' }}</span>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody class="text-center">
            @forelse($items as $item)
                <tr class="table-row">
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->cas_number }}</td>
                    <td>{{ $item->onu_number }}</td>
                    <td>
                        <div class="unit-wrapper">
                            <span>{{ $item->monthly_stored }}</span>
                            <span>Kg</span>
                        </div>
                    </td>
                    <td>
                        <div class="unit-wrapper">
                            <span>{{ $item->monthly_used }}</span>
                            <span>Kg</span>
                        </div>
                    </td>
                    <td>{{ $item->score }}</td>
                    <td>
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <button class="btn btn-sm modal-button"
                                style="padding: 6px 6px; border: 1px solid {{ $theme }} !important; background-color: {{ clarifyColor($theme, 0.9) }}"
                                type="button"
                                data-bs-toggle="modal" 
                                data-bs-target="#recordModal"
                                data-name="{{ $item->name }}"
                                data-cas="{{ $item->cas_number }}"
                                data-onu="{{ $item->onu_number }}"
                                data-stored="{{ $item->monthly_stored }}"
                                data-used="{{ $item->monthly_used }}"
                                data-score="{{ $item->score }}"
                                data-stamps='@json($item->stamps->map(fn($stamp) => [
                                    "code" => $stamp->code,
                                    "image" => asset($stamp->path)
                                ]))'
                                data-details='@json(
                                    $item->details->groupBy("type")->map(function($group) {
                                        return $group->map(fn($d) => $d->value);
                                    })
                                )'>
                                    Ver
                            </button>
                            @if($actionsEnabled)
                                @include('components.shared.includes.table-actions')
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12">
                        <em>Sin elementos disponibles</em>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>