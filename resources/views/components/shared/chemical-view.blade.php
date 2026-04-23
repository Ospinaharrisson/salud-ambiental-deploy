<div class="border rounded p-3 my-5">  
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <span>Mostrando</span>
            <select class="form-select d-inline-block w-auto mx-2" wire:model="perPage">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span>registros</span>
        </div>
        <div>
            <label for="searchItem" class="me-2">Buscar:</label>
            <input id="searchItem" type="text" wire:model="searchRequest" class="form-control d-inline-block w-auto" placeholder="valor del elemento">
        </div>
    </div>
    <div>
        <x-shared.chemical-table :module="$module" :pageRecordId="$pageRecordId" :items="$items" :theme="$theme" :sortField="$sortField" :sortBy="$sortBy" :actionsEnabled="$actionsEnabled"/>
        @include('Shared.Components.pagination')
    </div>
    
    @include('components.shared.includes.modal-table')
</div>

@push('scripts')
    <script src="{{ asset('assets/js/shared/chemical-table/modal-info.js') }}"></script>
@endpush
