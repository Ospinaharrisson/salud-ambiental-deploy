@if($districts->isNotEmpty())
    <li id="desktop-district-item" class="desktop-navbar-item">
        <div class="desktop-navbar-image-wrapper">
            <img
                class="desktop-navbar-image"
                src="{{ asset('assets/images/user/Components/Sections/Navbar/district-logo.png') }}"
                alt="Política Distrital"
            >
        </div>

        <div class="desktop-navbar-text">
            <span>Política Distrital</span>
        </div>

        <ul class="desktop-navbar-dropdown">
            @foreach($districts as $district)
                <li
                    id="desktop-district-{{ $district->id }}"
                    class="desktop-dropdown-submenu"
                >
                    <button
                        type="button"
                        class="desktop-dropdown-button"
                    >
                        {{ $district->name }}
                    </button>
                    <ul
                        class="desktop-dropdown-submenu-list"
                        id="desktop-district-submenu-{{ $district->id }}"
                    >
                        @include(
                            'User.Components.Navbar.Viewports.Desktop.Fragments.pages',
                            ['module' => $district]
                        )

                        @include(
                            'User.Components.Navbar.Viewports.Desktop.Fragments.records',
                            ['module' => $district]
                        )

                        @include(
                            'User.Components.Navbar.Viewports.Desktop.Fragments.collections',
                            ['module' => $district]
                        )
                    </ul>
                </li>
            @endforeach
        </ul>
    </li>
@endif