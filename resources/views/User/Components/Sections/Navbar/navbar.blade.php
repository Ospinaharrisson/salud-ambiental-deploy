<nav>
    @include('User.Components.Sections.Navbar.Includes.navbar-items.middle')
    <div id="navbar-desktop-source" style="display:none">
        @include('User.Components.Sections.Navbar.Includes.Viewports.desktop')
    </div>
    <div id="navbar-mobile-source" style="display:none">
        @include('User.Components.Sections.Navbar.Includes.Viewports.mobile')
    </div>
    <div id="main-navbar-container"></div>
</nav>