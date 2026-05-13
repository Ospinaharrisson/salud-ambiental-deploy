@forelse($pages->get($module->id, collect()) as $page)
    <li
        id="desktop-page-{{ $page->id }}"
        class="desktop-dropdown-item"
    >
        <a
            class="desktop-dropdown-link"
            href="{{ route('page.show', ['id' => $page->id, 'slug' => $page->slug]) }}"
        >
            {{ $page->name }}
        </a>
    </li>
@empty
    <li class="desktop-dropdown-item">
        <span class="desktop-dropdown-link">
            Sin páginas disponibles
        </span>
    </li>
@endforelse