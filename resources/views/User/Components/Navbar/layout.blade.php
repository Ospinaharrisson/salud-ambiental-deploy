<div class="navbar-layout">
    @include('User.Components.Navbar.Partials.branding')
    <div class="content-desktop-view">
        @include('User.Components.Navbar.Viewports.Desktop.layout')
    </div>
    <div class="content-mobile-view">
        @include('User.Components.Navbar.Viewports.Mobile.layout')
    </div> 
    <div id="main-navbar-container"></div>
</div>