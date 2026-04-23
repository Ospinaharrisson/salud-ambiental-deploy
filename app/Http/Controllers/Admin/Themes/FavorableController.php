<?php

namespace App\Http\Controllers\Admin\Themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Admin\CurrentModule;
use App\Models\Shared\Content\EstablishmentAsset;
use App\Services\Admin\Content\Themes\EstablishmentAssetService;

class FavorableController extends Controller
{
    protected $establishmentManager;

    public function __construct(EstablishmentAssetService $establishmentManager)
    {
        $this->establishmentManager = $establishmentManager;
    }

    /* #region vistas */

    public function favorableHomeView()
    {
        return view('Admin.Dashboard.Themes.Favorable.favorable-home');
    }

    public function createFavorableView($module)
    {
        return view('Admin.Dashboard.Themes.Favorable.favorable-create');
    }

    public function editFavorableView($module, $favorable_id)
    {
        $module = CurrentModule::get();
        $favorable = EstablishmentAsset::where('module_id', $module->id)
            ->findOrFail($favorable_id);

        return view(
            'Admin.Dashboard.Themes.Favorable.favorable-edit',
            ['module' => $module],
            compact('favorable')
        );
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeFavorable(Request $request, $module)
    {
        $this->establishmentManager->store($request);
        return redirect()->route('admin.themes.favorable', ['module' => $module])
            ->with('mensaje', 'Establecimiento favorable guardado exitosamente.');
    }

    public function updateFavorable(Request $request, $module, $favorable_id)
    {
        $favorable = EstablishmentAsset::findOrFail($favorable_id);
        $this->establishmentManager->update($request, $favorable);

        return redirect()->route('admin.themes.favorable', ['module' => $module])
            ->with('mensaje', 'Establecimiento favorable actualizado exitosamente.');
    }

    public function toggleFavorable($module, $favorable_id)
    {
        $favorable = EstablishmentAsset::findOrFail($favorable_id);
        $this->establishmentManager->toggle($favorable);

        return redirect()->back()
            ->with('mensaje', 'El estado del establecimiento favorable ha sido actualizado exitosamente.');
    }

    public function sortFavorable(Request $request, $module)
    {
        $module = CurrentModule::get();
        $items = $request->input('order');

        foreach ($items as $index => $id) {
            EstablishmentAsset::where('id', $id)
                ->where('module_id', $module->id)
                ->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden de establecimientos favorables actualizado correctamente.']);
    }

    public function destroyFavorable($module, $favorable_id)
    {
        $favorable = EstablishmentAsset::findOrFail($favorable_id);
        $this->establishmentManager->destroy($favorable);

        return redirect()->route('admin.themes.favorable', ['module' => $module])
            ->with('mensaje', 'Establecimiento favorable eliminado exitosamente.');
    }

    /* #endregion acciones */
}