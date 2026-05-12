@if($navCollections->has($module->id))
    @foreach($navCollections[$module->id] as $collection)
        <li id="collection-{{ $collection->id }}" class="dropdown-submenu dropend">
            <button class="dropdown-item nav-active dropdown-toggle" type="button">
                {{ $collection->name }}
            </button>
            <ul class="dropdown-menu dropdown-list" id="submenu-{{ $collection->id }}">
                @foreach($collection->entries as $entry)
                    <li>
                        <a href="#"
                            class="dropdown-item nav-active dynamic-link" 
                            data-link="{{ $entry->link }}"
                            data-model="NavEntry"
                            data-id="{{ $entry->id }}"
                            target="_blank" 
                            rel="noopener noreferrer"
                        >
                            {{ $entry->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>                  
    @endforeach
@endif
