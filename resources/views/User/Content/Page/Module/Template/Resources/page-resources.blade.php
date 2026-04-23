@if(isset($categoriesByGroup) && count($categoriesByGroup))

    @if($totalAssets >= 1)
        @livewire('user.page.asset-searcher', [
            'pageId' => $page->id,
            'theme' => $theme
        ], key('asset-searcher-' . $page->id))
    @endif

    @foreach($categoriesByGroup as $group => $categories)
        @php
            $groupKey = (string)$group;
            $groupId = 'asset-container-' . md5($page->id . '-' . $group);
            $groupConfig = $config['groups'][$groupKey] ?? null;
        @endphp

        <div class="group-block">

            @if($group !== '')
                <h4>{{ $group }}</h4>
            @endif

            <div class="d-flex justify-content-center">
                <div id="{{ $groupId }}" class="asset-container mb-4">
                    <div class="asset-content border shadow-sm">
                        <div class="asset-header">
                            <h3 class="asset-title m-0"></h3>
                            <button type="button" class="btn asset-close" aria-label="Cerrar">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </div>

                        <div class="ql-editor asset-description"></div>

                        @livewire('user.page.asset-content', [
                            'categoryId' => $category->id ?? null,
                            'theme' => $theme,
                            'alpha' => '0.5'
                        ], key('asset-content-' . $page->id . '-' . ($category->id ?? uniqid())))
                    </div>
                </div>
            </div>

            @if($categories->count() < 5)

                <div class="group-block-row">
                    @foreach($categories as $index => $category)
                        @php
                            $alphaSteps = [1, 0.85, 0.7, 0.55];
                            $alpha = $alphaSteps[$index % 4];
                            $basis = $groupConfig['bases'][$index] ?? ($groupConfig['basis'] ?? '100%');
                        @endphp

                        <div class="resource-item slide-up"
                             data-index="{{ $index }}"
                             data-resource-id="{{ $category->id }}"
                             data-item='@json($category)'
                             style="flex:0 0 {{ $basis }}; background-color: {{ clarifyColor($theme, $alpha) }}">
                            {{ $category->name }}
                            <span>documentos de la categoria: {{ $category->assets->count() }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="group-view-wrapper">

                    <div class="d-flex justify-content-end mt-2 mb-2">
                        <div class="align-items-center me-2">
                        <span class="text-muted">ver todos</span>
                        </div>
                        <button type="button" class="carousel-button toggle-group-view" aria-label="Expandir" style="width: 30px; height: 30px">
    						<i class="bi bi-chevron-down toggle-icon" style="font-size: 16px"></i>
						</button>
                    </div>

                    <div class="group-expanded-view">
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            @foreach($categories as $index => $category)
                                @php
                                    $alphaSteps = [1.2, 0.92, 0.74, 0.66];
                                    $alpha = $alphaSteps[$index % 4];
                                    $basis = $groupConfig['bases'][$index] ?? ($groupConfig['basis'] ?? '100%');
                                @endphp

                                <div class="resource-item"
                                     data-index="{{ $index }}"
                                     data-resource-id="{{ $category->id }}"
                                     data-item='@json($category)'
                                     style="flex:0 0 {{ $basis }}; min-width:220px; background-color: {{ clarifyColor($theme, $alpha) }}">
                                    {{ Str::limit($category->name, 50, '...') }}
                                    <span>documentos de la categoria: {{ $category->assets->count() }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

					<div class="carousel-wrapper overflow-hidden">
                    	<div class="carousel-row d-flex align-items-center justify-content-between">

                    	    <div class="button-wrapper">
                    	        <button type="button" class="carousel-button carousel-prev" aria-label="Anterior">
                    	            <i class="bi bi-arrow-left"></i>
                    	        </button>
                    	    </div>

                    	    <div class="carousel-viewport flex-grow-1">
                    	        <div class="carousel-track d-flex">
                    	            @foreach($categories as $index => $category)
                    	                @php
                    	                    $alphaSteps = [1.2, 0.92, 0.74, 0.66];
                    	                    $alpha = $alphaSteps[$index % 4];
                    	                    $basis = $groupConfig['bases'][$index] ?? ($groupConfig['basis'] ?? '100%');
                    	                @endphp

                    	                <div class="resource-item"
                    	                     data-index="{{ $index }}"
                    	                     data-resource-id="{{ $category->id }}"
                    	                     data-item='@json($category)'
                    	                     style="flex:0 0 {{ $basis }}; background-color: {{ clarifyColor($theme, $alpha) }}">
                    	                    {{ Str::limit($category->name, 70, '...') }}
                    	                    <span>documentos de la categoria: {{ $category->assets->count() }}</span>
                    	                </div>
                    	            @endforeach
                    	        </div>
                    	    </div>

                    	    <div class="button-wrapper">
                    	        <button type="button" class="carousel-button carousel-next" aria-label="Siguiente">
                    	            <i class="bi bi-arrow-right"></i>
                    	        </button>
                    	    </div>

                    	</div>
					</div>
                </div>
            @endif
        </div>
    @endforeach
@endif

@push('scripts')
	<script src="{{ asset('assets/js/user/Content/Page/page-asset.js') }}"></script>
	<script src="{{ asset('assets/js/user/Content/Page/page-search.js') }}"></script>
	<script src="{{ asset('assets/js/user/Content/Page/page-carousel.js') }}"></script>
@endpush