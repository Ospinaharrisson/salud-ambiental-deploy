@forelse($pages->get($module->id, collect()) as $page)
    <li class="mobile-dropdown-item">
        <a
            class="mobile-dropdown-link"
            href="{{ route('page.show', ['id' => $page->id, 'slug' => $page->slug]) }}"
        >
            {{ $page->name }}
        </a>
    </li>
@empty
    <li class="mobile-dropdown-item mobile-dropdown-empty">
        <span class="mobile-dropdown-text">
            Sin páginas disponibles
        </span>
    </li>
@endforelse