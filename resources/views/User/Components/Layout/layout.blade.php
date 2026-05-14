<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="image/png" href="{{ asset('assets/images/shared/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">  

    <title>@yield('title', 'Salud Ambiental')</title>

    <script src="{{ asset('assets/js/user/Components/dark-mode.js') }}"></script>
    
    @include('Shared.Imports.css-imports')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/user-theme.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/user-responsive.css')}}" />

    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/user/Components/Navbar/branding.css') }}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/user/Components/Navbar/desktop.css') }}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/user/Components/Navbar/mobile.css') }}" />
    
    
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/Components/Utilities/app-button.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/Components/Utilities/accesibility-button.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/Components/Utilities/contact.css')}}" />

    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/Components/Footer/footer.css')}}" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @include('User.Components.Navbar.layout')
    @include('User.Components.Utilities.layout')
    
    <main class="main-content">
        @yield('content')
    </main>

    @include('User.Components.Footer.footer')

    @include('Shared.Imports.js-imports')
    <script src="{{ asset('assets/js/user/Components/Layout/font-behavior.js') }}"></script>
    <script src="{{ asset('assets/js/user/Components/Layout/contrast-toggle.js') }}"></script>

    <script src="{{ asset('assets/js/user/Components/Navbar/desktop-navbar-behavior.js') }}"></script>
    <script src="{{ asset('assets/js/user/Components/Navbar/mobile-navbar-behavior.js') }}"></script>
    
    <script src="{{ asset('assets/js/user/Components/Utilities/contact-modal.js') }}"></script>
    @stack('scripts')
    @stack('modals')
</body>
</html>
