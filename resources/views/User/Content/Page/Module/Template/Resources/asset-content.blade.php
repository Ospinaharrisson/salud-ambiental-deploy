<div>
    @if($items->total() > 5)
        <div class="asset-perpage">
            <label>Mostrando</label>
            <select wire:model="perPage">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
            <span>Elementos</span>
        </div>
    @endif
    
    <ul class="asset-list">
        @foreach($items as $asset)
            @php
                $href = $asset['link'] ?? null;
                if (!$href && !empty($asset['mime_type']) && !empty($asset['content_base64'])) {
                    $href = generateBlankLink($asset['content_base64'], $asset['mime_type']);
                }
            @endphp
            @if($href)
                <li class="asset-item" style="background-color: {{ clarifyColor($theme, 0.1) }};" title="{{ $asset['title'] ?? $asset['name']}}">
                    <div class="d-flex align-items-center" style="flex: 0 0 90%">
                        <img src="{{ assetIcon($asset['type']) }}" alt="icon">
                        <p>{{ $asset['name'] }}</p>
                    </div>
                    <div class="d-flex justify-content-end" style="flex: 0 0 10%">
                        <a href="{{ $href }}" class="btn btn-sm" target="_blank">Ver</a>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>

    @if ($items->hasPages())
        <div class="asset-pagination">
            {{ $items->links() }}
        </div>
    @endif
</div>