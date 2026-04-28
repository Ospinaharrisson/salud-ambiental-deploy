<?php

namespace App\Http\Livewire\Admin\Index;

use Livewire\Component;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Shared\Home\Module;

class CardModules extends Component
{
    public function render()
    {
        $homeModule = (object)[
            'id' => null,
            'name' => 'Página principal',
            'theme' => null,
            'image' => null,
            'is_home' => true,
            'is_active' => true,
        ];

        $perPage = 8;
        $page = request()->get('page', 1);

        $modulesQuery = Module::orderByDesc('is_active')->orderBy('order')->get();
        $allModules = collect([$homeModule])->concat($modulesQuery);

        $paginatedModules = new LengthAwarePaginator(
            $allModules->forPage($page, $perPage),
            $allModules->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('Admin.Components.Index.Main.card-modules', ['modules' => $paginatedModules]);
    }
}
