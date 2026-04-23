<?php

namespace App\Http\Controllers\Admin\Themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Admin\CurrentModule;

use App\Models\Shared\Home\Module;
use App\Models\Shared\Themes\ModuleButton;
use App\Services\Admin\Content\Themes\ModuleButtonService;

class ModuleButtonController extends Controller
{
    protected $buttonManager;

    public function __construct(ModuleButtonService $buttonManager)
    {
        $this->buttonManager = $buttonManager;
    }
    
    /* #region vistas */

    public function buttonsHomeView()
    {
        return view('Admin.Dashboard.Themes.module-buttons.button-home');
    }

    public function createButtonView($module)
    {
        return view('Admin.Dashboard.Themes.module-buttons.button-create');
    }
    
    public function editButtonView($module, $button_id)
    {
        $module = CurrentModule::get();
        $button = ModuleButton::where('module_id', $module->id)->findOrFail($button_id);
        return view('Admin.Dashboard.Themes.module-buttons.button-edit', ['module' => $module], compact('button'));
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeButton(Request $request, $module)
    {
        $this->buttonManager->store($request);
        return redirect()->route('admin.themes.buttons', ['module' => $module])->with('mensaje', 'Botón guardado exitosamente.');
    }
    
    public function updateButton(Request $request, $module, $button_id)
    {
        $button = ModuleButton::findOrFail($button_id);
        $this->buttonManager->update($request, $button);

        return redirect()->route('admin.themes.buttons', ['module' => $module])->with('mensaje', 'Botón actualizado exitosamente.');
    }
    
    public function toggleButton($module, $button_id)
    {
        $button = ModuleButton::findOrFail($button_id);
        $this->buttonManager->toggle($button);

        return redirect()->back()->with('mensaje', 'El estado del botón ha sido actualizado exitosamente.');
    }

    public function sortButtons(Request $request, $module)
    {
        $module = CurrentModule::get();
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            ModuleButton::where('id', $id)
                ->where('module_id', $module->id)
                ->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyButton($module, $button_id)
    {
        $button = ModuleButton::findOrFail($button_id);
        $this->buttonManager->destroy($button);
        return redirect()->route('admin.themes.buttons', ['module' => $module])->with('mensaje', 'Botón eliminado exitosamente.');
    }
    /* #endregion acciones */
}
