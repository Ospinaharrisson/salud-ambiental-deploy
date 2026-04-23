<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Home\HomePage;
use App\Services\Admin\Content\Home\PageService;

class HomePageController extends Controller
{
    protected $pageManager;

    public function __construct(PageService $pageManager)
    {
        $this->pageManager = $pageManager;
    }

    /* #region vistas */
    public function pageHomeView()
    {
        $count = HomePage::count();
        return view('Admin.Dashboard.Home.page.page-home', compact('count'));
    }

    public function pageCreateView()
    {
        return view('Admin.Dashboard.Home.page.page-create');
    }

    public function pageEditView($id)
    {
        $page = HomePage::findOrFail($id);
        return view('Admin.Dashboard.Home.page.page-edit', compact('page'));
    }
    /* #endregion vistas */

    /* #region acciones */

    public function storePage(Request $request)
    {
        $this->pageManager->store($request);
        return redirect()->route('admin.home.page')->with('mensaje', 'Pagina guardada exitosamente.');
    }

    public function updatePage(Request $request, $id)
    {
        $page = HomePage::findOrFail($id);
        $this->pageManager->update($request, $page);

        return redirect()->route('admin.home.page')->with('mensaje', 'pagina actualizada exitosamente.');
    }

    public function togglePage($id)
    {
        $page = HomePage::findOrFail($id);
        $this->pageManager->toggle($page);

        return redirect()->back()->with('mensaje', 'El estado de la pagina ha sido actualizado exitosamente.');
    }

    public function destroyPage($id)
    {
        $page = HomePage::findOrFail($id);
        $this->pageManager->destroy($page);
        return redirect()->route('admin.home.page')->with('mensaje', 'Pagina eliminada exitosamente.');
    }
    /* #endregion acciones */
}
