@extends('Admin.Components.Layout.layout', ['sidebar' => true])

@section('content')
    @if($paginatedItems->isEmpty())
    <div class="box-rounded bg text-center rounded-3 p-3">
        <span class="text-main">No hay Elementos disponibles</span>
    </div>
    @else
        @foreach($paginatedItems as $group)
            @include('Admin.Components.Sections.Table.dashboard-table', [
                'header' => [
                    'enabled' => true,
                    'title' => $group['category'],
                    'action' => [
                        'enabled' => true,
                        'name' => 'Añadir nuevo elemento',
                        'route' => 'admin.home.footer.create',
                        'params' => [
                            'category' => $group['category']
                        ],
                        'icon' => 'bi bi-plus-circle'
                    ]
                ],
                'list' => $group['items'],
                'columns' => [ ['label' => 'Nombre', 'width' => '80%'] ],
                'fields' => ['name'],
                'sort' => ['enabled' => true, 'id' => 'sortable-footer', 'route' => 'admin.home.footer.sort'],
                'status' => ['enabled' => true],
                'edit' => [
                    'enabled' => true,
                    'route' => 'admin.home.footer.edit',
                    'params' => [
                        'category' => $group['category'],
                        'id' => fn($item) => $item->id,
                    ]
                ],
                'toggle' => [
                    'enabled' => true,
                    'route' => 'admin.home.footer.toggle',
                    'params' => [
                        'category' => $group['category'],
                        'id' => fn($item) => $item->id,
                    ]
                ],
                'pagination' => [
                    'enabled' => true,
                    'pagination' => $paginatedItems,
                    'message' => 'página :current de :total'
                ]
            ])
        @endforeach
    @endif
@endsection
