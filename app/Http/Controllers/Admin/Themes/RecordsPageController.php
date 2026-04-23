<?php

namespace App\Http\Controllers\Admin\Themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Themes\RecordsPage;
use App\Services\Admin\Content\Themes\RecordPageService;

use App\Helpers\Admin\CurrentModule;

class RecordsPageController extends Controller
{
    protected $pageService; 

    public function __construct(RecordPageService $pageService)
    {
        $this->pageService = $pageService;
    }

    /* #region vistas */
    
    public function recordsHomeView()
    {
        $count = RecordsPage::where('module_id', CurrentModule::get()->id)->count();
        return view('Admin.Dashboard.Themes.records.record-home', [
            'module' => CurrentModule::get(),
            'count' => $count
        ]);
    }

    public function recordsCreateView()
    {
        return view('Admin.Dashboard.Themes.records.record-create');
    }

    public function recordsEditView($module, $page_id)
    {
        $page = RecordsPage::findOrFail($page_id);
        return view('Admin.Dashboard.Themes.records.record-edit', compact('page'));
    }

    /* #endregion Vistas */

    /* #region acciones */

    public function storeRecord(Request $request)
    {
        $this->pageService->store($request);
        return redirect()->route('admin.themes.record', ['module' => CurrentModule::get()])->with('mensaje', 'Página creada correctamente.');
    }

    public function updateRecord(Request $request, $module, $page_id)
    {
        $page = RecordsPage::findOrFail($page_id);
        $this->pageService->update($request, $page);

        return redirect()->route('admin.themes.record', ['module' => $module])->with('mensaje', 'Página actualizada exitosamente.');
    }

    public function toggleRecord($module, $page_id)
    {
        $page = RecordsPage::findOrFail($page_id);
        $this->pageService->toggle($page);

        return redirect()->route('admin.themes.record', ['module' => $module])->with('mensaje', 'El estado de la página ha sido actualizado exitosamente.');
    }

    public function destroyRecord($module, $page_id)
    {
        $page = RecordsPage::findOrFail($page_id);
        $this->pageService->destroy($page);
        return redirect()->route('admin.themes.record', ['module' => $module])->with('mensaje', 'Página eliminada exitosamente.');
    }
    /* #endregion acciones */
}
