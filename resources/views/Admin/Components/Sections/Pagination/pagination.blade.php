{{-- Paginación del Carrusel --}}

@if ($pagination instanceof \Illuminate\Pagination\LengthAwarePaginator && $pagination->hasPages())
<div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
    
    <div class="text-muted small">
        @php
            $from = $pagination->firstItem();
            $to = $pagination->lastItem();
            $current = $pagination->currentPage();
            $total = $pagination->total();  
            $last = $pagination->lastPage();
        
            $message = $message ?? '[registro :from - :to] Página :current de :last';
            $replacements = [
                ':total' => $total,
                ':from' => $from,
                ':to' => $to,
                ':current' => $current,
                ':last' => $last,
            ];
            $message = strtr($message, $replacements);
        @endphp
        {{ $message }}
    </div>
    {{-- Nueva paginación con números --}}
    <div>
        <ul class="pagination pagination-sm mb-0">
            {{-- Primera página --}}
            <li class="page-item {{ $pagination->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $pagination->url(1) }}" aria-label="Primera">
                    &laquo;
                </a>
            </li>
            {{-- Páginas vecinas --}}
            @php
                $current = $pagination->currentPage();
                $last = $pagination->lastPage();
                    
                $pages = [];
                    
                if ($current > 1) $pages[] = $current - 1;
                $pages[] = $current;
                if ($current < $last) $pages[] = $current + 1;
            @endphp
                    
            @foreach ($pages as $page)
                <li class="page-item {{ $current === $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $pagination->url($page) }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Última página --}}
            <li class="page-item {{ !$pagination->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $pagination->url($pagination->lastPage()) }}" aria-label="Última">
                    &raquo;
                </a>
            </li>
        </ul>
    </div>
</div>
@endif
