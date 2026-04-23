{{-- Edit Button --}}
<a href="{{ route('admin.themes.record.item.edit', ['module' => $module, 'page_id' => $pageRecordId, 'item_id' => $item->id]) }}" class="btn btn-edit btn-sm" title="Editar">
    <i class="bi bi-pencil"></i>
</a>

{{-- Toggle Button --}}
<form action="{{ route('admin.themes.record.item.toggle', ['module' => $module, 'page_id' => $pageRecordId, 'item_id' => $item->id]) }}" method="POST">
    @csrf
    @method('PATCH')
    <button type="submit" class="btn btn-sm {{ $item->is_active ? 'btn-toggle-off' : 'btn-toggle-on' }}" 
            title="{{ $item->is_active ? 'Desactivar' : 'Activar' }}">
        <i class="bi bi-power"></i>
    </button>
</form>

{{-- Delete Button --}}
<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $item->id }}">
    <i class="bi bi-trash"></i>
</button>

<div class="modal fade" id="deleteModal-{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $item->id }}">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar el registro <strong>{{ $item->name }}</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('admin.themes.record.item.destroy', ['module' => $module, 'page_id' => $pageRecordId, 'item_id' => $item->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
                            