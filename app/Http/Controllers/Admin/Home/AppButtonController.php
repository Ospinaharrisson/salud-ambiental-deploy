<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Content\AppButton;
use App\Services\Admin\Content\Home\AppButtonService;

class AppButtonController extends Controller
{
    protected $buttonManager;

    public function __construct(AppButtonService $buttonManager)
    {
        $this->buttonManager = $buttonManager;
    }

    /* #region vistas */

    public function appButtonHomeView()
    {
        return view('Admin.Dashboard.Home.app-buttons.app-home');
    }
    
    public function destroyAppButton($id)
    {
        $button = AppButton::findOrFail($id);
        $this->buttonManager->destroy($button);
        return redirect()->route('admin.home.app')->with('mensaje', 'Botón eliminado exitosamente.');
    }

    public function appButtonCreateView()
    {
        return view('Admin.Dashboard.Home.app-buttons.app-create');
    }

    public function appButtonUpdateView($id)
    {
        $button = AppButton::findOrFail($id);
        return view('Admin.Dashboard.Home.app-buttons.app-edit', compact('button'));
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeAppButton(Request $request)
    {
        $this->buttonManager->store($request);
        return redirect()->route('admin.home.app')->with('mensaje', 'Botón guardado exitosamente.');
    }

    public function updateAppButton(Request $request, $id)
    {
        $button = AppButton::findOrFail($id);
        $this->buttonManager->update($request, $button);

        return redirect()->route('admin.home.app')->with('mensaje', 'Botón actualizado exitosamente.');
    }

    public function toggleAppButton($id)
    {
        $button = AppButton::findOrFail($id);
        $this->buttonManager->toggle($button);

        return redirect()->back()->with('mensaje', 'El estado del botón ha sido actualizado exitosamente.');
    }

    public function sortAppButton(Request $request)
    {
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            AppButton::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    /* #endregion acciones */
}
