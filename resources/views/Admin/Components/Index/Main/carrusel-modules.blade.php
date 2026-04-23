@php
    $defaultTheme = '#0D1B2A';
    $hoverClasses = [];
@endphp

<section>
  <div class="container">
    <div class="carousel-container">
      <div class="carousel-track" id="carouselTrack">
        @if(!empty($modules))
          @foreach($modules as $index => $module)
            @php
              $isHome = $module->is_home ?? false;
              $theme = $module->theme ?? $defaultTheme;
              $hoverClass = $isHome ? '' : hoverTextClass($theme, $hoverClasses);
            @endphp
            @if($isHome)
              {{-- Tarjeta Home --}}
              <div class="module-card" data-index="{{ $index }}">
                <div class="card-image-container bg-alt">
                  <img src="{{ asset('assets/images/shared/home-logo.png') }}" alt="Home">
                </div>
                <div style="height: 20%">
                  <div class="bg d-flex justify-content-center align-items-center w-100" style="height: 50%">
                    <h5 class="card-label">Página principal</h5>
                  </div>
                  <div class="text-center" style="height: 50%">
                    <a class="card-button btn-text text-center" href="{{ route('admin.home') }}">Acceder</a>
                  </div>
                </div>
              </div>
            @else
              {{-- Módulo dinámico --}}
              <div class="module-card" data-index="{{ $index }}" style="border: 1px solid {{ $theme }}">
                @if (!empty($module->image))
                  <div class="card-image-container" style="background-color: {{ clarifyColor($theme, 0.5) }}">
                    <img src="{{ renderBase64Image($module->image) }}" alt="{{ $module->name }}">
                  </div>
                @endif
                <div style="height: 20%">
                  <div class="d-flex justify-content-center align-items-center w-100" style="background-color: {{ $theme }}; height: 50%">
                    <h5 class="card-label">{{ $module->name }}</h5>
                  </div>
                  <div class="text-center" style="height: 50%">
                    <a class="card-button {{ $hoverClass }}" href="{{ route('admin.themes', $module) }}">Acceder</a>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        @endif
      </div>
      {{-- Indicadores --}}
      <div class="carousel-indicators">
        @foreach($modules as $index => $module)
          @php
            $isHome = $module->is_home ?? false;
            $color = $isHome ? $defaultTheme : ($module->theme ?? $defaultTheme);
            $activeClass = $isHome ? 'active' : '';
          @endphp
          <button class="indicator-btn {{ $activeClass }}" data-index="{{ $index }}" style="background-color: {{ $color }}"></button>
        @endforeach
      </div>
    </div>
  </div>
</section>

@php
  $homeIndex = collect($modules)->search(fn($m) => $m->is_home ?? false) ?? 0;
@endphp

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/admin/modules/main-style.css') }}">
  <style>
    {!! implode("\n", $hoverClasses) !!}
  </style>
@endpush

@push('scripts')
  <script>
    window.startModuleIndex = {{ $homeIndex }};
  </script>
  <script src="{{ asset('assets/js/admin/modules/main-style.js') }}"></script>
@endpush
