@if($navCollections->has($module->id))
    @foreach($navCollections[$module->id] as $collection)
        <li
            id="desktop-collection-{{ $collection->id }}"
            class="desktop-dropdown-submenu"
        >
            <button
                type="button"
                class="desktop-dropdown-button"
                id="desktop-collection-button-{{ $collection->id }}"
            >
                {{ $collection->name }}
            </button>
            <ul
                id="desktop-submenu-{{ $collection->id }}"
                class="desktop-dropdown-submenu-list"
            >
                @foreach($collection->entries as $entry)
                    <li
                        id="desktop-entry-{{ $entry->id }}"
                        class="desktop-dropdown-submenu-item"
                    >
                        <a
                            href="#"
                            class="desktop-dropdown-link dynamic-link"
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