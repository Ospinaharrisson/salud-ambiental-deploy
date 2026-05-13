@if(isset($modules))
    <div id="desktop-navbar-wrapper" class="desktop-navbar-wrapper">
        <nav id="desktop-navbar" class="desktop-navbar" aria-label="Main navigation">
            <ul class="desktop-navbar-list">

                @if(isset($districts))
                    @include('User.Components.Navbar.Viewports.Desktop.district-navigation')
                @endif

                @foreach($modules as $module)
                    <li id="desktop-module-{{ $module->id }}" class="desktop-navbar-item">
                        <div class="desktop-navbar-image-wrapper">
                            <img 
                                class="desktop-navbar-image"
                                src="{{ renderBase64Image($module->image) }}"
                                alt="{{ $module->name }}"
                            >
                        </div>

                        <div class="desktop-navbar-text">
                            <span>{{ $module->name }}</span>
                        </div>

                        @if(isset($pages) || $navCollections->has($module->id))
                            <ul class="desktop-navbar-dropdown">
                                @include('User.Components.Navbar.Viewports.Desktop.Fragments.pages')
                                @include('User.Components.Navbar.Viewports.Desktop.Fragments.records')
                                @include('User.Components.Navbar.Viewports.Desktop.Fragments.collections')
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
@endif