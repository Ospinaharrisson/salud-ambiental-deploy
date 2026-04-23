@if($districts->count())
  <li id="district-parent" 
      class="nav-item dropdown d-flex flex-column justify-content-start align-items-center text-center" 
      type="button">

      <div id="district-toggle" class="d-flex flex-column justify-content-center align-items-center">
          <div class="nav-image-wrapper">
              <img class="nav-image mb-2"
                   src="{{ asset('assets/images/user/Components/Sections/Navbar/district-logo.png') }}"
                   alt="Política Distrital">
          </div>
      </div>

      <div class="nav-text"><span>Política Distrital</span></div>

      <ul class="dropdown-menu dropdown-list" id="district-menu">
          @foreach($districts as $district)
              <li class="dropdown-submenu dropend" id="district-{{ $district->id }}">
                  <button class="dropdown-item nav-active dropdown-toggle" type="button" id="district-btn-{{ $district->id }}">
                      {{ $district->name }}   
                  </button>
                  <ul class="dropdown-menu dropdown-list" id="district-submenu-{{ $district->id }}">
                      @include('User.Components.Sections.Navbar.Includes.extensions.pages', ['module' => $district])
                      @include('User.Components.Sections.Navbar.Includes.extensions.records', ['module' => $district])
                      @include('User.Components.Sections.Navbar.Includes.extensions.collections', ['module' => $district])
                  </ul>
              </li>
          @endforeach
      </ul>
  </li>
@endif
