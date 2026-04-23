<div class="container-fluid">
    <div class="footer-container footer-bottom">
        <div class="d-flex justify-content-start mt-2">
            <div class="me-4">
                <span class="footer-title">@ 2024 Secretaría de salud</span>
            </div>
            @if ($accessibilityItems->isNotEmpty())
                <div class="mx-4">
                    <span class="footer-title d-inline">Ayudas de accesibilidad: </span>
                    <div class="d-inline-block">
                        @foreach ($accessibilityItems as $item)
                            <a href="{{ $item->link ?? '#' }}" class="footer-link" target="_blank">
                                <span>{{ $item->name }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>