<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Content\HealthNetwork;
use App\Services\Admin\Content\Home\HealthNetworkService;

class HealthNetworkController extends Controller
{
    protected $networkManager;

    public function __construct(HealthNetworkService $networkManager)
    {
        $this->networkManager = $networkManager;
    }

    /* #region vistas */

    public function networkHomeView()
    {
        return view('Admin.Dashboard.Home.health-network.network-home');
    }

    public function networkCreateView()
    {
        return view('Admin.Dashboard.Home.health-network.network-create');
    }

    public function networkUpdateView($id)
    {
        $network = HealthNetwork::findOrFail($id);
        return view('Admin.Dashboard.Home.health-network.network-edit', compact('network'));
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeNetwork(Request $request)
    {
        $this->networkManager->store($request);
        return redirect()->route('admin.home.network')->with('mensaje', 'Subred guardada exitosamente.');
    }

    public function updateNetwork(Request $request, $id)
    {
        $network = HealthNetwork::findOrFail($id);
        $this->networkManager->update($request, $network);

        return redirect()->route('admin.home.network')->with('mensaje', 'Subred actualizada exitosamente.');
    }

    public function toggleNetwork($id)
    {
        $network = HealthNetwork::findOrFail($id);
        $this->networkManager->toggle($network);

        return redirect()->back()->with('mensaje', 'El estado de la subred ha sido actualizado exitosamente.');
    }

    public function sortNetwork(Request $request)
    {
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            HealthNetwork::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyNetwork($id)
    {
        $network = HealthNetwork::findOrFail($id);
        $this->networkManager->destroy($network);
        return redirect()->route('admin.home.network')->with('mensaje', 'Subred eliminada exitosamente.');
    }
    /* #endregion acciones */
}
