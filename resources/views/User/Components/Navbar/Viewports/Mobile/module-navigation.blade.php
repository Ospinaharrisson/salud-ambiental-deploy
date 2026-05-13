
@foreach($modules as $module)
    <li class="mobile-navbar-item">
        <button
            class="mobile-navbar-button"
            type="button"
        >
            <div class="mobile-navbar-button-content">
                <img
                    class="mobile-navbar-button-image"
                    src="{{ renderBase64Image($module->image) }}"
                    alt="{{ $module->name }}"
                >
                <span class="mobile-navbar-button-text">
                    {{ $module->name }}
                </span>
            </div>
            <span class="mobile-navbar-arrow">
                &#9662;
            </span>
        </button>
        @if(isset($pages) || $navCollections->has($module->id))
            <ul class="mobile-navbar-dropdown">
                @include(
                    'User.Components.Navbar.Viewports.Mobile.Fragments.pages'
                )
                @include(
                    'User.Components.Navbar.Viewports.Mobile.Fragments.records'
                )
                @include(
                    'User.Components.Navbar.Viewports.Mobile.Fragments.collections'
                )
            </ul>
        @endif
    </li>
@endforeach