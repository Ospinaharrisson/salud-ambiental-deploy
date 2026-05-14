<div>
    <div class="d-flex justify-content-center mt-2 mb-5">
        <div class="asset-searcher">
            <input type="text" class="form-control" wire:model.defer="query" placeholder="Buscar Archivo...">
            <button type="button" class="btn p-0 m-0" wire:click="searchAssets" id="openSearch">
                <img src="{{ asset('assets/images/user/Components/Navbar/search-icon.png') }}" alt="buscar">
            </button>
        </div>
    </div>
    
    <div id="searchModal" class="offcanvas-modal" wire:ignore.self>
        <div class="offcanvas-header">
            <h3>Resultados de búsqueda</h3>
            <button type="button" id="closeSearch" aria-label="Cerrar">&times;</button>
        </div>

        <div class="offcanvas-body">
            <div class="offcanvas-filters bg-light">
                <div class="canvas-select-wrapper">
                    <select class="offcanvas-input canvas-select" wire:model.lazy="filterType" wire:change="applyFilters">
                        <option value="">Tipo de documento</option>
                        <option value="link">Enlace</option>
                        <option value="image">Imagen</option>
                        <option value="document">Documento</option>
                        <option value="geo">Mapa</option>
                    </select>
                </div>
                @if($categories && $categories->isNotEmpty())
                    <div class="canvas-select-wrapper">
                        <select class="offcanvas-input canvas-select" wire:model.lazy="filterCategory" wire:change="applyFilters">
                            <option value="" selected>Todas las categorías</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div>
                    <button wire:click="toggleOrder" class="offcanvas-input btn" value="{{ $sortOrder === 'asc' ? 'desc' : 'asc' }}">
                        Ordenar {{ $sortOrder === 'asc' ? 'A → Z' : 'Z → A' }}
                    </button>
                </div>
            </div>

            <div class="offcanvas-assets">
                @if($results && $results->isNotEmpty())
                    <div class="offcanvas-items">
                        @foreach ($results as $result)
                            <div class="canvas-card" style="background-color: {{ clarifyColor($theme, 0.1) }};">
                                <div class="card-header">
                                    <div class="title">{{ Str::limit($result->name, 20, '...') }}</div>
                                    <div class="icon" style="background: linear-gradient(to right, {{ clarifyColor($theme, 0.4) }}, {{ $theme }});">
                                        <div class="icon-content">
                                            <img src="{{ assetIcon($result->type) }}" alt="icon">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-item">
                                        <i class="bi bi-tag"></i>
                                        <strong>Categoría:</strong>
                                        <span class="text-muted">{{ $result->category->name }}</span>
                                    </div>
                                    @if($result->category->groupTitle)
                                        <div class="card-item">
                                            <i class="bi bi-people"></i>
                                            <strong>Grupo:</strong>
                                            <span class="text-muted">{{ $result->category->groupTitle }}</span>
                                        </div>
                                    @endif
                                    <div class="card-item">  
                                        <i class="bi bi-file-earmark-text"></i>
                                        <strong>Tipo:</strong>
                                        <span class="text-muted">{{ assetName($result->type) }}</span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="#" 
                                        class="btn w-100 dynamic-link"
                                        style="background: linear-gradient(to right, {{ clarifyColor($theme, 0.4) }}, {{ $theme }});"
                                        data-link="{{ $result->link }}"
                                        data-model="PageAsset"
                                        data-id="{{ $result->id }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        Ver
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($results->hasPages())
                        <div class="theme-separator me-4"></div>
                        <div class="mt-3 d-flex justify-content-center gap-2">
                            <button
                                type="button"
                                wire:click="previousPage"
                                class="btn btn-sm {{ $results->onFirstPage() ? 'btn-secondary disabled' : 'canvas-button' }}"
                                {{ $results->onFirstPage() ? 'disabled' : '' }}>
                                anterior
                            </button>
                    
                            <span class="px-2 fw-semibold align-self-center">
                                Página {{ $results->currentPage() }} de {{ $results->lastPage() }}
                            </span>
                    
                            <button
                                type="button"
                                wire:click="nextPage"
                                class="btn btn-sm {{ $results->hasMorePages() ? 'canvas-button' : 'btn-secondary disabled' }}"
                                {{ $results->hasMorePages() ? '' : 'disabled' }}>
                                siguiente
                            </button>
                        </div>
                    @endif
                @else
                    <p class="no-results-message">No hay coincidencias</p>
                @endif
            </div>
        </div>
    </div>
</div>