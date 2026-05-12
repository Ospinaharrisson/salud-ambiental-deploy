@if($navCollections->has($module->id))
    @foreach($navCollections[$module->id] as $collection)
        <li class="mobile-collection">
            <button class="mobile-collection-btn w-100 text-start d-flex align-items-center justify-content-between" type="button">
                <span>{{ $collection->name }}</span>
                <span class="arrow">&#9662;</span>
            </button>

            <ul class="mobile-collection-list">
                @foreach($collection->entries as $entry)
                    <li class="collection-nav-item">
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