<footer>
    @if((isset($lines) && $lines->isNotEmpty()) || (isset($networks) && $networks->isNotEmpty()))
        <div class="content-section extension-container">
            <h2>Líneas de interés</h2>
            @include('User.Components.Footer.Includes.extensions.lines')
            @include('User.Components.Footer.Includes.extensions.networks')
        </div>
    @endif
    @if(isset($footerItems) && $footerItems->isNotEmpty())
        <div id="main-footer">
            @include('User.Components.Footer.Includes.footer-items.top')
                <div class="container-fluid">
                    <div class="footer-container footer-middle row">
                        @foreach ($footerItems as $category => $items)
                            <div class="col">
                                <p class="footer-title mb-2">{{ $category }}</p>
                                @foreach ($items as $item)
                                    @if ($item->link)
                                        <a class="footer-link my-2" href="{{ $item->link }}" target="_blank">
                                            {{ $item->name }}
                                        </a>
                                    @else
                                        <span class="footer-text my-2">{{ $item->name }}</span>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @include('User.Components.Footer.Includes.footer-items.bottom')    
        </div>
    @endif
</footer>