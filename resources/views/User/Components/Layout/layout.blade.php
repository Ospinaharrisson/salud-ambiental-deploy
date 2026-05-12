<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="image/png" href="{{ asset('assets/images/shared/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">  

    <title>@yield('title', 'Salud Ambiental')</title>

    <script>
        (function () {
          const theme = localStorage.getItem("theme");
        
          if (theme === "dark") {
            document.documentElement.classList.add("app-contrast");
          }
        })();
    </script>
    
    @include('Shared.Imports.css-imports')

    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/user-theme.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/user-responsive.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/Components/Sections/App-Buttons/app-button.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/Components/Sections/Contact/contact.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/Components/Sections/Navbar/desktop.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/Components/Sections/Navbar/mobile.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/user/Components/Sections/Footer/footer.css')}}" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @include('User.Components.Sections.Navbar.navbar')
    @include('User.Components.Sections.AppButtons.app-buttons')
    
    <main class="main-content">
        @yield('content')
    </main>

    @include('User.Components.Sections.Contact.contact')
    @include('User.Components.Sections.Footer.footer')

    
    @include('Shared.Imports.js-imports')
    <script src="{{ asset('assets/js/user/Components/Sections/Navbar/navbar-behavior.js') }}"></script>
    <script src="{{ asset('assets/js/user/Components/Layout/font-behavior.js') }}"></script>
    <script src="{{ asset('assets/js/user/Components/Layout/contrast-toggle.js') }}"></script>
    @stack('scripts')
    @stack('modals')

</body>
</html>
