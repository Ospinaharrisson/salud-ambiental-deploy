@forelse($recordsPages->get($module->id, collect()) as $recordPage)
    <li
        id="desktop-record-page-{{ $recordPage->id }}"
        class="desktop-dropdown-item"
    >
        <a
            class="desktop-dropdown-link"
            href="{{ route('page.record.show', ['id' => $recordPage->id, 'slug' => $recordPage->slug]) }}"
        >
            {{ $recordPage->name }}
        </a>
    </li>
@empty
@endforelse