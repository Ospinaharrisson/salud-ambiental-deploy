<link rel="stylesheet" href="{{ asset('assets/css/admin/sidebar/sidebar-style.css') }}">

<aside class="dashboard-sidebar bg-alt-gradient">
    <ul class="dashboard-sidebar-list">

        {{-- Ítem fijo de inicio --}}
        <li class="dashboard-sidebar-item">
            <a href="{{ route('admin.index') }}" class="dashboard-sidebar-link nav-hover">
                <i class="bi bi-house-fill dashboard-sidebar-icon"></i>
                <span style="font-size: 1.15rem">Inicio - Admin</span>
            </a>
        </li>

        <li class="dashboard-sidebar-divider bg"></li>

        {{-- Ítems sin categoría --}}
        @php
            $uncategorizedItems = collect($navigationItems)
                ->filter(fn($_, $key) => $key === null || $key === '')
                ->flatten(1);
        @endphp

        @foreach ($uncategorizedItems as $nav)
            @php
                $currentRoute = Route::currentRouteName();
                $isActive = Str::startsWith($currentRoute, $nav['route']);
            @endphp
            <li class="dashboard-sidebar-item" style="margin-top: 0.6rem !Important; margin-bottom: 0.8rem !important">
                @if (Str::startsWith($nav['route'], 'admin.themes.') && isset($module))
                    <a href="{{ route($nav['route'], $module) }}"
                       class="dashboard-sidebar-link nav-hover {{ $isActive ? 'active' : '' }}">
                @else
                    <a href="{{ route($nav['route']) }}"
                       class="dashboard-sidebar-link nav-hover {{ $isActive ? 'active' : '' }}">
                @endif                   
                        <span><i class="{{ $nav['icon'] ?? 'bi bi-square' }} me-2"></i> {{ $nav['name'] }}</span>
                    </a>
            </li>
        @endforeach
        {{-- Ítems agrupados por categoría --}}
        @php
            $categoryIcons = [
                'Galería' => 'bi-images',
                'Indicadores' => 'bi-geo-alt',
                'Navegación' => 'bi-link-45deg',
                'Contenido' => 'bi-file-earmark-text',
                'Gestión' => 'bi-tools',
                'Multimedia' => 'bi-camera-video',
            ];
        @endphp
        
        @foreach($navigationItems as $category => $items)
            @if ($category !== '' && $category !== null)
                @php
                    $collapseId = 'sidebar-collapse-' . Str::slug($category);
                    $icon = $categoryIcons[$category] ?? 'bi-folder-fill';
                @endphp
                <li class="dashboard-sidebar-item" style="margin-top: 0.6rem !Important; margin-bottom: 0.8rem !important">
                    <button class="dashboard-sidebar-link nav-hover w-100 text-start d-flex justify-content-between align-items-center"
                            data-bs-toggle="collapse"
                            data-bs-target="#{{ $collapseId }}"
                            aria-expanded="false"
                            aria-controls="{{ $collapseId }}">
                        <span><i class="{{ $icon }} me-2"></i> {{ $category }}</span>
                        <i class="bi bi-chevron-down small toggle-icon"></i>
                    </button>
                    <ul class="collapse w-100 ps-3" id="{{ $collapseId }}">
                        @foreach ($items as $nav)
                            @php
                                $currentRoute = Route::currentRouteName();
                                $isActive = Str::startsWith($currentRoute, $nav['route']);
                            @endphp

                            <li class="dashboard-sidebar-subitem">
                                @if (Str::startsWith($nav['route'], 'admin.themes.') && isset($module))
                                    <a href="{{ route($nav['route'], $module) }}"
                                       class="dashboard-sidebar-link nav-hover d-block {{ $isActive ? 'active' : '' }}">
                                @else
                                    <a href="{{ route($nav['route']) }}"
                                       class="dashboard-sidebar-link nav-hover d-block {{ $isActive ? 'active' : '' }}">
                                @endif
                                        <i class="{{ $nav['icon'] ?? 'bi bi-square' }} me-2"></i>
                                        {{ $nav['name'] }}
                                    </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    </ul>
</aside>

<script src="{{ asset('assets/js/admin/sidebar/sidebar.js') }}"></script>