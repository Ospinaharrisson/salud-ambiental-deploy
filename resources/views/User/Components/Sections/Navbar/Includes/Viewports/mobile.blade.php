@if(isset($modules) || isset($districts))
    <nav id="mobile-navbar" class="navbar d-flex flex-column align-items-stretch">
        <div class="mobile-nav-wrapper">
            <img class="mobile-townhall-img" src="{{ asset('assets/images/user/Components/Sections/Navbar/mobile-townhall-logo.png') }}" alt="hall logo">
            <button class="navbar-toggler align-self-center" type="button" id="mobile-navbar-toggle" aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
            </button>
        </div>
        <div id="mobile-navbar-content" class="collapse-container">
            <ul class="list-unstyled mt-3 p-0">
                @if(isset($districts))
                    @foreach($districts as $district)
                        <li class="mobile-nav-item">
                            <button class="mobile-nav-btn w-100 text-start d-flex align-items-center justify-content-between" type="button">
                                <div class="d-flex align-items-center">
                                    <img src="{{ renderBase64Image($district->image) }}" alt="{{ $district->name }}" class="me-2" width="40" height="40">
                                    <span class="nav-btn-text">{{ $district->name }}</span>
                                </div>
                                <span class="arrow">&#9662;</span>
                            </button>

                            @if(isset($pages) || $navCollections->has($district->id))
                                <ul class="mobile-dropdown">
                                    @include('User.Components.Sections.Navbar.Includes.extensions.pages', ['module' => $district])
                                    @include('User.Components.Sections.Navbar.Includes.extensions.records', ['module' => $district])
                                    @include('User.Components.Sections.Navbar.Includes.extensions.collections-mobile', ['module' => $district])
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endif

                @foreach($modules as $module)
                    <li class="mobile-nav-item">
                        <button class="mobile-nav-btn w-100 text-start d-flex align-items-center justify-content-between" type="button">
                            <div class="d-flex align-items-center">
                                <img src="{{ renderBase64Image($module->image) }}" alt="{{ $module->name }}" class="me-2" width="40" height="40">
                                <span class="nav-btn-text">{{ $module->name }}</span>
                            </div>
                            <span class="arrow">&#9662;</span>
                        </button>

                        @if(isset($pages) || $navCollections->has($module->id))
                            <ul class="mobile-dropdown">
                                @include('User.Components.Sections.Navbar.Includes.extensions.pages')
                                @include('User.Components.Sections.Navbar.Includes.extensions.records')
                                @include('User.Components.Sections.Navbar.Includes.extensions.collections-mobile')
                            </ul>
                        @endif
                    </li>
                @endforeach

            </ul>
        </div>
    </nav>
@endif
