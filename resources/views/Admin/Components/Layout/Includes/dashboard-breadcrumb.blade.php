<nav aria-label="breadcrumb" style="--theme: {{ $theme }}">
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $item)
            <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                @if(!$loop->last && isset($item['url']))
                    <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                @else
                    {{ $item['label'] }}
                @endif
            </li>
        @endforeach
    </ol>
</nav>