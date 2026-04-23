<div aria-label="breadcrumb" class="breadcrumb-wrapper">
    <ol class="page-breadcrumb breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/images/user/Icons/icon-home.png') }}" alt="Home">
            </a>
        </li>

        @foreach($items as $item)
            <li class="breadcrumb-item {{ $item['active'] ?? false ? 'active' : '' }}" {{ ($item['active'] ?? false) ? 'aria-current=page' : '' }}>
                <span>{{ $item['label'] }}</span>
            </li>
        @endforeach
    </ol>
    <div class="theme-separator"></div>
</div>
