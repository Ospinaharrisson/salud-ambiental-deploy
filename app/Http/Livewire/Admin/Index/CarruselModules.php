<?php

namespace App\Http\Livewire\Admin\Index;

use Livewire\Component;
use App\Models\Shared\Home\Module;

class CarruselModules extends Component
{
    public function render()
    {
        $modules = Module::where('is_active', true)->orderBy('order')->limit(12)->get();
    
        $modulesArray = $modules->values()->all();
        $midIndex = floor(count($modulesArray) / 2);
    
        $homeModule = (object)[
            'id' => null,
            'name' => 'Página principal',
            'theme' => null,
            'image' => null,
            'is_home' => true,
        ];
    
        array_splice($modulesArray, $midIndex, 0, [$homeModule]);
    
        return view('Admin.Components.Index.Main.carrusel-modules', [
            'modules' => $modulesArray
        ]);
    }
}
