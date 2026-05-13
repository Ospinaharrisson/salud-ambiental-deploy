@forelse($recordsPages->get($module->id, collect()) as $recordPage)
    <li class="mobile-dropdown-item">
        <a
            class="mobile-dropdown-link"
            href="{{ route('page.record.show', ['id' => $recordPage->id, 'slug' => $recordPage->slug]) }}"
        >
            {{ $recordPage->name }}
        </a>
    </li>
@empty
@endforelse