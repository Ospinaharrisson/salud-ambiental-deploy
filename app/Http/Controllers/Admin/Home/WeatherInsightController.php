<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Content\WeatherInsight;
use App\Services\Admin\Content\Home\InsightService;

class WeatherInsightController extends Controller
{
    protected $insightManager;

    public function __construct(InsightService $insightManager)
    {
        $this->insightManager = $insightManager;
    }

    /* #region vistas */

    public function insightHomeView()
    {
        return view('Admin.Dashboard.Home.weather-insight.insight-home');
    }

    public function insightCreateView()
    {
        return view('Admin.Dashboard.Home.weather-insight.insight-create');
    }

    public function insightUpdateView($id)
    {
        $insight = WeatherInsight::findOrFail($id);
        return view('Admin.Dashboard.Home.weather-insight.insight-edit', compact('insight'));
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeInsight(Request $request)
    {
        $this->insightManager->store($request);
        return redirect()->route('admin.home.insight')->with('mensaje', 'Indicador guardado exitosamente.');
    }

    public function updateInsight(Request $request, $id)
    {
        $insight = WeatherInsight::findOrFail($id);
        $this->insightManager->update($request, $insight);

        return redirect()->route('admin.home.insight')->with('mensaje', 'Indicador actualizado exitosamente.');
    }

    public function toggleInsight($id)
    {
        $insight = WeatherInsight::findOrFail($id);
        $this->insightManager->toggle($insight);

        return redirect()->back()->with('mensaje', 'El estado del indicador ha sido actualizado exitosamente.');
    }

    public function sortInsight(Request $request)
    {
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            WeatherInsight::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyInsight($id)
    {
        $insight = WeatherInsight::findOrFail($id);
        $this->insightManager->destroy($insight);
        return redirect()->route('admin.home.insight')->with('mensaje', 'Indicador eliminado exitosamente.');
    }
    /* #endregion acciones */
}
