@if(isset($modules))
    <div id="main-navbar-wrapper">
        <div id="main-navbar" class="navbar navbar-expand" aria-label="Main navigation">
            <ul class="navbar-nav container-fluid d-flex align-items-stretch justify-content-center">

                @if(isset($districts))
                    @include('User.Components.Sections.Navbar.Includes.extensions.districts')
                @endif

                @foreach($modules as $module)
                    <li id="module-{{ $module->id }}"
                        class="nav-item dropdown d-flex flex-column justify-content-start align-items-center text-center"
                        type="button">

                        <div class="nav-image-wrapper">
                            <img 
                                class="nav-image mb-2"
                                src="{{ renderBase64Image($module->image) }}"
                                alt="{{ $module->name }}">
                        </div>

                        <div class="nav-text">
                            <span>{{ $module->name }}</span>
                        </div>

                        @if(isset($pages) || $navCollections->has($module->id))
                            <ul class="dropdown-menu dropdown-list">
                                @include('User.Components.Sections.Navbar.Includes.extensions.pages')
                                @include('User.Components.Sections.Navbar.Includes.extensions.records')
                                @include('User.Components.Sections.Navbar.Includes.extensions.collections')
                            </ul>
                        @endif
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
@endif
