<?php

namespace App\Http\Controllers\Admin\Themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Admin\CurrentModule;
use App\Models\Shared\Content\EstablishmentAsset;
use App\Services\Admin\Content\Themes\EstablishmentAssetService;

class AccreditedController extends Controller
{
    protected $establishmentManager;

    public function __construct(EstablishmentAssetService $establishmentManager)
    {
        $this->establishmentManager = $establishmentManager;
    }

    /* #region vistas */

    public function accreditedHomeView()
    {
        return view('Admin.Dashboard.Themes.Accredited.accredited-home');
    }

    public function createAccreditedView($module)
    {
        return view('Admin.Dashboard.Themes.Accredited.accredited-create');
    }

    public function editAccreditedView($module, $accredited_id)
    {
        $module = CurrentModule::get();
        $accredited = EstablishmentAsset::where('module_id', $module->id)
            ->findOrFail($accredited_id);

        return view(
            'Admin.Dashboard.Themes.Accredited.accredited-edit',
            ['module' => $module],
            compact('accredited')
        );
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeAccredited(Request $request, $module)
    {
        $this->establishmentManager->store($request);
        return redirect()->route('admin.themes.accredited', ['module' => $module])
            ->with('mensaje', 'Establecimiento acreditado guardado exitosamente.');
    }

    public function updateAccredited(Request $request, $module, $accredited_id)
    {
        $accredited = EstablishmentAsset::findOrFail($accredited_id);
        $this->establishmentManager->update($request, $accredited);

        return redirect()->route('admin.themes.accredited', ['module' => $module])
            ->with('mensaje', 'Establecimiento acreditado actualizado exitosamente.');
    }

    public function toggleAccredited($module, $accredited_id)
    {
        $accredited = EstablishmentAsset::findOrFail($accredited_id);
        $this->establishmentManager->toggle($accredited);

        return redirect()->back()
            ->with('mensaje', 'El estado del establecimiento acreditado ha sido actualizado exitosamente.');
    }

    public function sortAccredited(Request $request, $module)
    {
        $module = CurrentModule::get();
        $items = $request->input('order');

        foreach ($items as $index => $id) {
            EstablishmentAsset::where('id', $id)
                ->where('module_id', $module->id)
                ->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden de establecimientos acreditados actualizado correctamente.']);
    }

    public function destroyAccredited($module, $accredited_id)
    {
        $accredited = EstablishmentAsset::findOrFail($accredited_id);
        $this->establishmentManager->destroy($accredited);

        return redirect()->route('admin.themes.accredited', ['module' => $module])
            ->with('mensaje', 'Establecimiento acreditado eliminado exitosamente.');
    }

    /* #endregion acciones */
}