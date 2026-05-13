@if(isset($districts))
    @foreach($districts as $district)
        <li class="mobile-navbar-item">
            <button
                class="mobile-navbar-button"
                type="button"
            >
                <div class="mobile-navbar-button-content">
                    <img
                        class="mobile-navbar-button-image"
                        src="{{ renderBase64Image($district->image) }}"
                        alt="{{ $district->name }}"
                    >
                    <span class="mobile-navbar-button-text">
                        {{ $district->name }}
                    </span>
                </div>
                <span class="mobile-navbar-arrow">
                    &#9662;
                </span>
            </button>
            @if(isset($pages) || $navCollections->has($district->id))
                <ul class="mobile-navbar-dropdown">
                    @include(
                        'User.Components.Navbar.Viewports.Mobile.Fragments.pages',
                        ['module' => $district]
                    )
                    @include(
                        'User.Components.Navbar.Viewports.Mobile.Fragments.records',
                        ['module' => $district]
                    )
                    @include(
                        'User.Components.Navbar.Viewports.Mobile.Fragments.collections',
                        ['module' => $district]
                    )
                </ul>
            @endif
        </li>
    @endforeach
@endif