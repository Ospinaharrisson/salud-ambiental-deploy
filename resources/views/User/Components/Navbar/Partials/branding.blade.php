<nav class="navbar-branding">
    <div class="navbar-branding-main">
        <a href="{{ route('home') }}" class="navbar-branding-townhall-link">
            <img
                class="navbar-branding-townhall-logo"
                src="{{ asset('assets/images/user/Components/Sections/Navbar/townhall-logo.png') }}"
                alt="Logo alcaldía" 
            />
        </a>

        <a href="{{ route('home') }}" class="navbar-branding-home-link">
            <img
                class="navbar-branding-home-logo"
                src="{{ asset('assets/images/shared/home-logo.png') }}"
                alt="Logo Inicio" 
            />
        </a>

        <form class="navbar-branding-search">

            <input
                type="text"
                class="navbar-branding-search-input"
                placeholder="Buscar"
            />

            <button
                type="submit"
                class="navbar-branding-search-button">

                <img
                    class="navbar-branding-search-icon"
                    src="{{ asset('assets/images/user/Components/Sections/Navbar/search-icon.png') }}"
                    alt="Buscar" 
                />
            </button>
        </form>
    </div>
</nav>