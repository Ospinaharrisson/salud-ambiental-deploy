@if(isset($modules) || isset($districts))
    <nav id="mobile-navbar" class="mobile-navbar">
        <div class="mobile-navbar-wrapper">

            <img
                class="mobile-navbar-logo"
                src="{{ asset('assets/images/user/Components/Sections/Navbar/mobile-townhall-logo.png') }}"
                alt="Townhall Logo"
            >

            <button
                id="mobile-navbar-toggle"
                class="mobile-navbar-toggle"
                type="button"
                aria-label="Toggle navigation"
            >
                <span class="mobile-navbar-toggle-line"></span>
                <span class="mobile-navbar-toggle-line"></span>
                <span class="mobile-navbar-toggle-line"></span>
            </button>
        </div>

        <div id="mobile-navbar-content" class="mobile-navbar-collapse">

            <ul class="mobile-navbar-list">
                @include('User.Components.Navbar.Viewports.Mobile.district-navigation')
                @include('User.Components.Navbar.Viewports.Mobile.module-navigation')
            </ul>
        </div>
    </nav>
@endif