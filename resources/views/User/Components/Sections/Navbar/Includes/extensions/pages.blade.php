@forelse($pages->get($module->id, collect()) as $page)
    <li>
        <a class="dropdown-item nav-active" href="{{ route('page.show', ['id' => $page->id, 'slug' => $page->slug]) }}">
            {{ $page->name }}
        </a>
    </li>
@empty
    <li class="dropdown-item">Sin páginas disponibles</li>
@endforelse