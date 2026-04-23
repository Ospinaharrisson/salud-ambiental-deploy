<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Content\EstablishmentButton;
use App\Services\Admin\Content\Home\EstablishmentButtonService;

class EstablishmentButtonController extends Controller
{
    protected $establishmentManager;

    public function __construct(EstablishmentButtonService $establishmentManager)
    {
        $this->establishmentManager = $establishmentManager;
    }

    /* #region vistas */

    public function establishmentHomeView()
    {
        return view('Admin.Dashboard.Home.establishment-buttons.establishment-home');
    }

    public function establishmentCreateView()
    {
        return view('Admin.Dashboard.Home.establishment-buttons.establishment-create');
    }

    public function establishmentUpdateView($id)
    {        
        $establishment = EstablishmentButton::findOrFail($id);
        return view('Admin.Dashboard.Home.establishment-buttons.establishment-edit', compact('establishment'));
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeEstablishment(Request $request)
    {
        $this->establishmentManager->store($request);
        return redirect()->route('admin.home.establishment')->with('mensaje', 'Establecimiento guardado exitosamente.');
    }

    public function updateEstablishment(Request $request, $id)
    {
        $establishment = EstablishmentButton::findOrFail($id);
        $this->establishmentManager->update($request, $establishment);

        return redirect()->route('admin.home.establishment')->with('mensaje', 'Establecimiento actualizado exitosamente.');
    }

    public function toggleEstablishment($id)
    {
        $establishment = EstablishmentButton::findOrFail($id);
        $this->establishmentManager->toggle($establishment);

        return redirect()->back()->with('mensaje', 'El estado del establecimiento ha sido actualizado exitosamente.');
    }

    public function sortEstablishment(Request $request)
    {
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            EstablishmentButton::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyEstablishment($id)
    {
        $establishment = EstablishmentButton::findOrFail($id);
        $this->establishmentManager->destroy($establishment);
        return redirect()->route('admin.home.establishment')->with('mensaje', 'Establecimiento eliminado exitosamente.');
    }

    /* #endregion acciones */

}
