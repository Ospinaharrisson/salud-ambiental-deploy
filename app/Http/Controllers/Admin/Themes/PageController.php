<?php

namespace App\Http\Controllers\Admin\Themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Shared\Home\Module;
use App\Models\Shared\Themes\Page;

use App\Helpers\Admin\CurrentModule;

use App\Services\Admin\Content\Themes\PageService;

class PageController extends Controller
{
    protected $pageService; 

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    /* #region Vistas */

    public function pageHomeView()
    {
        $module = CurrentModule::get();
        return view('Admin.Dashboard.Themes.Page.page-home', compact('module'));
    }

    public function pageCreateView($module)
    {
        return view('Admin.Dashboard.Themes.Page.page-create');
    }

    public function pageUpdateView($module, $page_id)
    {
        $page = Page::findOrFail($page_id);
        return view('Admin.Dashboard.Themes.Page.page-edit', compact('page'));
    }

    /* #endregion Vistas */

    /* #region acciones */

    public function storePage(Request $request)
    {
        $this->pageService->store($request);
        return redirect()->route('admin.themes.page', ['module' => CurrentModule::get()])->with('mensaje', 'Página creada correctamente.');
    }

    public function updatePage(Request $request, $module, $page_id)
    {
        $page = Page::findOrFail($page_id);
        $this->pageService->update($request, $page);

        return redirect()->route('admin.themes.page', ['module' => $module])->with('mensaje', 'Página actualizada exitosamente.');
    }

    public function togglePage($module, $page_id)
    {
        $page = Page::findOrFail($page_id);
        $this->pageService->toggle($page);
 
        return redirect()->route('admin.themes.page', ['module' => $module])->with('mensaje', 'El estado de la página ha sido actualizado exitosamente.');
    }
    
    public function sortPages(Request $request, $module)
    {
        $module = CurrentModule::get();
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            Page::where('id', $id)
                ->where('module_id', $module->id)
                ->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }
    
    public function destroyPage($module, $page_id)
    {
        $page = Page::findOrFail($page_id);
        $this->pageService->destroy($page);
        return redirect()->route('admin.themes.page', ['module' => $module])->with('mensaje', 'Página eliminada correctamente.');
    }
    /* #endregion acciones */
}
