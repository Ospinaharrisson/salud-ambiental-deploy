<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Content\CollectionPoint;
use App\Services\Admin\Content\Home\CollectionPointService;

class CollectionPointController extends Controller
{
    protected $pointManager;

    public function __construct(CollectionPointService $pointManager)
    {
        $this->pointManager = $pointManager;
    }

    /* #region vistas */

    public function collectionHomeView()
    {
        return view('Admin.Dashboard.Home.collection-point.collection-home');
    }

    public function collectionCreateView()
    {
        return view('Admin.Dashboard.Home.collection-point.collection-create');
    }

    public function collectionUpdateView($id)
    {
        $point = CollectionPoint::findOrFail($id);
        return view('Admin.Dashboard.Home.collection-point.collection-edit', compact('point'));
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeCollection(Request $request)
    {
        $this->pointManager->store($request);
        return redirect()->route('admin.home.collection')->with('mensaje', 'Punto de recolección guardado exitosamente.');
    }

    public function updateCollection(Request $request, $id)
    {
        $point = CollectionPoint::findOrFail($id);
        $this->pointManager->update($request, $point);

        return redirect()->route('admin.home.collection')->with('mensaje', 'Punto de recolección actualizado exitosamente.');
    }

    public function toggleCollection($id)
    {
        $point = CollectionPoint::findOrFail($id);
        $this->pointManager->toggle($point);

        return redirect()->back()->with('mensaje', 'El estado del punto ha sido actualizado exitosamente.');
    }

    public function sortCollection(Request $request)
    {
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            CollectionPoint::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }
    
    public function destroyCollection($id)
    {
        $point = CollectionPoint::findOrFail($id);
        $this->pointManager->destroy($point);
        return redirect()->route('admin.home.collection')->with('mensaje', 'Punto de recolección eliminado exitosamente.');
    }
    /* #endregion acciones */
}
