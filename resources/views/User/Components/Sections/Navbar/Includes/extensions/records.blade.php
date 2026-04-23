@forelse($recordsPages->get($module->id, collect()) as $recordPage)
    <li>
        <a class="dropdown-item nav-active" href="{{ route('page.record.show', ['id' => $recordPage->id, 'slug' => $recordPage->slug]) }}">
            {{ $recordPage->name }}
        </a>
    </li>
@empty
@endforelse
