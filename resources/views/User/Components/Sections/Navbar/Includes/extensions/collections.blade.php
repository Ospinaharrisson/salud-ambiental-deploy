@if($navCollections->has($module->id))
    @foreach($navCollections[$module->id] as $collection)
        <li id="collection-{{ $collection->id }}" class="dropdown-submenu dropend">
            <button class="dropdown-item nav-active dropdown-toggle" type="button">
                {{ $collection->name }}
            </button>
            <ul class="dropdown-menu dropdown-list" id="submenu-{{ $collection->id }}">
                @foreach($collection->entries as $entry)
                    @php
                        $href = $entry->link ?? null;
                        if (!$href && !empty($entry->mime_type) && !empty($entry->content_base64)) {
                            $href = generateBlankLink($entry->content_base64, $entry->mime_type);
                        }
                    @endphp
                    
                    @if($href)
                        <li>
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
