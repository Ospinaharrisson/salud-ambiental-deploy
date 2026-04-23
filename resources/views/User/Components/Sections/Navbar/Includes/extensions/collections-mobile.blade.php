@if($navCollections->has($module->id))
    @foreach($navCollections[$module->id] as $collection)
        <li class="mobile-collection">
            <button class="mobile-collection-btn w-100 text-start d-flex align-items-center justify-content-between" type="button">
                <span>{{ $collection->name }}</span>
                <span class="arrow">&#9662;</span>
            </button>

            <ul class="mobile-collection-list">
                @foreach($collection->entries as $entry)
                    @php
                        $href = $entry->link ?? null;
                        if (!$href && !empty($entry->mime_type) && !empty($entry->content_base64)) {
                            $href = generateBlankLink($entry->content_base64, $entry->mime_type);
                        }
                    @endphp

                    @if($href)
                        <li class="collection-nav-item">
                            <a class="dropdown-item nav-active" href="{{ $href }}" target="_blank" rel="noopener noreferrer">
                                {{ $entry->name }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
    @endforeach
@endif