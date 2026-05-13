@if($navCollections->has($module->id))
    @foreach($navCollections[$module->id] as $collection)

        <li class="mobile-dropdown-collection">

            <button
                class="mobile-dropdown-button"
                type="button"
            >
                <span>
                    {{ $collection->name }}
                </span>

                <span class="mobile-navbar-arrow">
                    &#9662;
                </span>
            </button>

            <ul class="mobile-dropdown-collection-list">

                @foreach($collection->entries as $entry)

                    <li class="mobile-dropdown-collection-item">

                        <a
                            href="#"
                            class="mobile-dropdown-link dynamic-link"
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