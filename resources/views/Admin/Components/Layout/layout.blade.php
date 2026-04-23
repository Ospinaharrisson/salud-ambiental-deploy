<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/images/shared/favicon.png') }}">
  
  <title>@yield('title', 'Panel de Administración')</title>

  {{-- Shared Imports --}}
  @include('Shared.Imports.css-imports')
  
  {{-- iziToast --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">

  {{-- adminLTE --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" />
  
  {{-- Custom Styles --}}
  <link rel="stylesheet" href="{{ asset('assets/css/admin/admin-theme.css') }}">
  
  @stack('styles')
</head>

<body>
  <div id="overlay" class="overlay"></div>
  <div class="d-flex">

    {{-- Sidebar --}}
    @if (!empty($sidebar) && $sidebar)
      <div id="sidebar" class="sidebar-container bg-alt-gradient border-end border-contrast d-flex flex-column">
        @include('Admin.Components.Sidebar.dashboard-sidebar')
      </div>
    @endif

    {{-- Contenido principal --}}
    <div class="flex-grow-1 d-flex flex-column" style="min-height: 100vh;">

      {{-- Navbar --}}
      <nav class="navbar navbar-expand-lg bg shadow-sm px-3" style="padding: 23px 0 23px 0">
        <div class="container-fluid d-flex justify-content-between align-items-center">

          @if (!empty($sidebar) && $sidebar)
            <button class="btn btn-link d-lg-none text-main" id="toggleSidebar">
              <i class="bi bi-list fs-3"></i>
            </button>
          @endif
          <span class="fs-5 fw-semibold text-title m-0">
            Panel de administración
          </span>

          <div class="dropdown">
            <a class="d-flex align-items-center text-decoration-none dropdown-toggle"
               href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ asset('assets/images/admin/icons/navbar-logo.png') }}" alt="user"
                   width="32" height="32" class="rounded-circle me-2 border border-contrast" />
              <span class="text-main text-hover" style="font-size: 0.8rem">{{ Auth::check() ? Auth::user()->name : 'Invitado' }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-small" aria-labelledby="userDropdown">
              <li>
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                  Cerrar sesión
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      @if(empty($hideBreadcrumb))
        <x-admin.dashboard-breadcrumb />
      @endif
      
      {{-- Contenido --}}
      <main class="flex-grow-1 py-3 px-5">
        @yield('content')
      </main>

      {{-- Footer --}}
      <footer class="bg py-3 mt-auto">
        <div class="container text-center">
          <span class="text-note">&copy; {{ date('Y') }} Salud Ambiental de Bogotá - Todos los derechos reservados.</span>
        </div>
      </footer>
    </div>
  </div>

    {{-- Shared Imports --}}
  @include('Shared.Imports.js-imports')
  <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
  <script src="{{ asset('assets/js/admin/sidebar/sidebar-toggle.js') }}"></script>
  @stack('scripts')
  
  @if(session('mensaje'))
    <script>
      iziToast.success({
        title: 'Éxito',
        message: '{{ session('mensaje') }}',
        position: 'topRight',
        timeout: 3000
      });
    </script>
  @endif

  @if(session('mensajeError'))
    <script>
      iziToast.error({
        title: 'Error',
        message: '{{ session('mensajeError') }}',
        position: 'topRight',
        timeout: 5000
      });
    </script>
  @endif

  @if($errors->any())
    <script>
      iziToast.error({
        title: 'Error',
        message: '{{ $errors->first() }}',
        position: 'topRight',
        timeout: 5000
      });
    </script>
  @endif

  @stack('modals')
  @include('Admin.Components.Layout.Includes.logout-modal')
</body>
</html>
