@if ($items && method_exists($items, 'hasPages') && $items->hasPages())
    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="text-muted small">
            Mostrando [{{ $items->firstItem() }} - {{ $items->lastItem() }}] de {{ $items->total() }} registros
        </div>

        <div>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item {{ $items->onFirstPage() ? 'disabled' : '' }}">
                    <button class="page-link" wire:click="gotoPage(1)" {{ $items->onFirstPage() ? 'disabled' : '' }}>
                        &laquo;
                    </button>
                </li>

                @php
                    $current = $items->currentPage();
                    $last = $items->lastPage();
                    $pages = [];
                    if ($current > 1) $pages[] = $current - 1;
                    $pages[] = $current;
                    if ($current < $last) $pages[] = $current + 1;
                @endphp

                @foreach ($pages as $page)
                    <li class="page-item {{ $current === $page ? 'active' : '' }}">
                        <button class="page-link" wire:click="gotoPage({{ $page }})">{{ $page }}</button>
                    </li>
                @endforeach

                <li class="page-item {{ !$items->hasMorePages() ? 'disabled' : '' }}">
                    <button class="page-link" wire:click="gotoPage({{ $items->lastPage() }})" {{ !$items->hasMorePages() ? 'disabled' : '' }}>
                        &raquo;
                    </button>
                </li>
            </ul>
        </div>
    </div>
@endif
