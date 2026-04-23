<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Content\LineOfInterest;
use App\Services\Admin\Content\Home\LineOfInterestService;

class LineOfInterestController extends Controller
{
    protected $lineManager;

    public function __construct(LineOfInterestService $lineManager)
    {
        $this->lineManager = $lineManager;
    }

    /* #region vistas */

    public function lineHomeView()
    {
        return view('Admin.Dashboard.Home.line-of-interest.line-home');
    }

    public function lineCreateView()
    {
        return view('Admin.Dashboard.Home.line-of-interest.line-create');
    }

    public function lineUpdateView($id)
    {
        $line = LineOfInterest::findOrFail($id);
        return view('Admin.Dashboard.Home.line-of-interest.line-edit', compact('line'));
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeLine(Request $request)
    {
        $this->lineManager->store($request);
        return redirect()->route('admin.home.line')->with('mensaje', 'Línea de interés guardada exitosamente.');
    }

    public function updateLine(Request $request, $id)
    {
        $line = LineOfInterest::findOrFail($id);
        $this->lineManager->update($request, $line);

        return redirect()->route('admin.home.line')->with('mensaje', 'Línea de interés actualizada exitosamente.');
    }

    public function toggleLine($id)
    {
        $line = LineOfInterest::findOrFail($id);
        $this->lineManager->toggle($line);

        return redirect()->back()->with('mensaje', 'El estado de la línea ha sido actualizado exitosamente.');
    }

    public function sortLine(Request $request)
    {
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            LineOfInterest::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyLine($id)
    {
        $line = LineOfInterest::findOrFail($id);
        $this->lineManager->destroy($line);
        return redirect()->route('admin.home.line')->with('mensaje', 'Línea de interés eliminada exitosamente.');
    }
    /* #endregion acciones */
}
