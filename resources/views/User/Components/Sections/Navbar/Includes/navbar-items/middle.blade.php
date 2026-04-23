<nav class="navbar navbar-expand-lg py-4">
    <div class="container-fluid justify-content-around align-items-center">
    
        <a href="{{ route('home') }}">
            <img class="start-logo img-fluid" 
               src="{{ asset('assets/images/user/Components/Sections/Navbar/townhall-logo.png') }}" 
               alt="Logo alcaldía">
        </a>

        <a href="{{ route('home') }}" class="mx-lg-3 mx-md-2">
            <img class="middle-logo img-fluid" 
               src="{{ asset('assets/images/shared/home-logo.png') }}" 
               alt="Logo Inicio">
        </a>

        <form class="navbar-search d-flex align-items-center">
            <input type="text" id="search-bar" class="form-control me-2" placeholder="Buscar">
            <button type="submit" class="btn p-0">
                <img class="search-icon" 
                    src="{{ asset('assets/images/user/Components/Sections/Navbar/search-icon.png') }}" 
                    alt="buscar">
            </button>
        </form>
    </div>
</nav>
