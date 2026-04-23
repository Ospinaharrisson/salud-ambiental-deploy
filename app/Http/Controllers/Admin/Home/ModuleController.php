<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Home\Module;
use App\Services\Admin\Content\Home\ModuleService;

class ModuleController extends Controller
{
    protected $moduleManager;

    public function __construct(ModuleService $moduleManager)
    {
        $this->moduleManager = $moduleManager;
    }

    /* #region vistas */

    public function moduleHomeView()
    {
        return view('Admin.Dashboard.Home.modules.module-home');
    }

    public function moduleCreateView()
    {
        return view('Admin.Dashboard.Home.modules.module-create');
    }

    public function moduleUpdateView($id)
    {
        $module = Module::findOrFail($id);
        return view('Admin.Dashboard.Home.modules.module-edit', compact('module'));
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeModule(Request $request)
    {
        $this->moduleManager->store($request);
        return redirect()->route('admin.home.module')->with('mensaje', 'Módulo guardado exitosamente.');
    }

    public function updateModule(Request $request, $id)
    {
        $module = Module::findOrFail($id);
        $this->moduleManager->update($request, $module);

        return redirect()->route('admin.home.module')->with('mensaje', 'Módulo actualizado exitosamente.');
    }

    public function toggleModule($id)
    {
        $module = Module::findOrFail($id);
        $this->moduleManager->toggle($module);

        return redirect()->back()->with('mensaje', 'El estado del módulo ha sido actualizado exitosamente.');
    }

    public function sortModule(Request $request)
    {
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            Module::where('id', $id)->where('type', 'global')->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }
    
    public function destroyModule($id)
    {
        $module = Module::findOrFail($id);
        $this->moduleManager->destroy($module);
        return redirect()->route('admin.home.module')->with('mensaje', 'Módulo eliminado exitosamente.');
    }
    /* #endregion acciones */
}