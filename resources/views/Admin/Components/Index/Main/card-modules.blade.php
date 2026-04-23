<section class="mt-4">
  <div class="container-fluid">
    <div class="row">
      @foreach($modules as $module)
        @php
          $isHome = $module->is_home ?? false;
          $theme = $module->theme ?? '#0D1B2A';
        @endphp

        <div class="col-lg-3 col-6 position-relative">
          @if($isHome)
            <div class="small-box d-flex flex-column justify-content-between bg-alt" style=" height: 170px; overflow: hidden; position: relative;">
          @else
            <div class="small-box {{ $module->is_active ? '' : 'inactive' }} d-flex flex-column justify-content-between"
            style="background-color: {{ clarifyColor($theme, 0.8) }}; height: 170px; overflow: hidden; position: relative;">
          @endif
              
            @unless($module->is_active ?? true)
              <div class="overlay dark d-flex justify-content-center align-items-center" style="z-index: 9999;">
                <i class="fas fa-power-off fa-2x text-white"></i>
              </div>
            @endunless

            <div class="inner d-flex" style="height: 100%; overflow: hidden;">
              <div class="w-50 d-flex flex-column justify-content-center">
                <h3 style="color: #fff; margin: 0;">{{ $isHome ? 'Inicio' : 'Módulo' }}</h3>
                <p class="mb-1" style="color: #fff; line-height: 1.2">{{ $module->name }}</p>
              </div>
              <div class="w-50 d-flex align-items-center justify-content-center overflow-hidden">
                @if($isHome)
                  <img src="{{ asset('assets/images/shared/home-logo.png') }}"
                       alt="Inicio"
                       style="height: 100%; max-width: 120px; object-fit: contain;">
                @elseif (!empty($module->image))
                  <img src="{{ renderBase64Image($module->image) }}"
                       alt="Módulo"
                       style="height: 100%; max-width: 100%; object-fit: contain;">
                @endif
              </div>
            </div>

            @if($module->is_active ?? true)
              <a href="{{ $isHome ? route('admin.home') : route('admin.themes', $module->id) }}"
                 class="small-box-footer mt-auto" style="background-color: {{ $theme }}">
                Acceder <i class="fas fa-arrow-circle-right"></i>
              </a>
            @else
              <div class="small-box-footer mt-auto" style="background-color: {{ $theme }}">
                Inactivo
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
  @include('Admin.Components.Sections.Pagination.pagination', [
    'pagination' => $modules,
    'message' => ''
  ])
</section>