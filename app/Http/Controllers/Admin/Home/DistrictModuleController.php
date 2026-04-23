<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Home\Module;
use App\Services\Admin\Content\Home\ModuleService;

class DistrictModuleController extends Controller
{
    protected $districtManager;

    public function __construct(ModuleService $districtManager)
    {
        $this->districtManager = $districtManager;
    }

    /* #region vistas */

    public function districtHomeView()
    {
        return view('Admin.Dashboard.Home.modules.district-home');
    }

    public function districtCreateView()
    {
        return view('Admin.Dashboard.Home.modules.district-create');
    }

    public function districtUpdateView($id)
    {
        $district = Module::findOrFail($id);
        return view('Admin.Dashboard.Home.modules.district-edit', compact('district'));
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeDistrict(Request $request)
    {
        $this->districtManager->store($request);
        return redirect()->route('admin.home.district')->with('mensaje', 'Distrito guardado exitosamente.');
    }

    public function updateDistrict(Request $request, $id)
    {
        $district = Module::findOrFail($id);
        $this->districtManager->update($request, $district);

        return redirect()->route('admin.home.district')->with('mensaje', 'Distrito actualizado exitosamente.');
    }

    public function toggleDistrict($id)
    {
        $district = Module::findOrFail($id);
        $this->districtManager->toggle($district);

        return redirect()->back()->with('mensaje', 'El estado del distrito ha sido actualizado exitosamente.');
    }

    public function sortDistrict(Request $request)
    {
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            Module::where('id', $id)->where('type', 'district')->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyDistrict($id)
    {
        $district = Module::findOrFail($id);
        $this->districtManager->destroy($district);
        return redirect()->route('admin.home.district')->with('mensaje', 'Distrito eliminado exitosamente.');
    }
    /* #endregion acciones */
}
