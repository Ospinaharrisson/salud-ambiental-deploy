<?php

namespace App\Http\Controllers\Admin\Themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Shared\Themes\Page;
use App\Models\Shared\Themes\PageAssetCategory;
use App\Models\Shared\Content\PageAsset;

use App\Helpers\Admin\CurrentModule;

use App\Services\Admin\Content\Themes\PageAssetCategoryService;
use App\Services\Admin\Content\Themes\PageAssetService;

class PageAssetController extends Controller
{
    protected $categoryService;
    protected $assetService;

    public function __construct(PageAssetCategoryService $categoryService, PageAssetService $assetService)
    {
        $this->categoryService = $categoryService;
        $this->assetService = $assetService;
    }

    /* #region Vistas */

    public function categoryHomeView($module, $page_id)
    {
        $page = Page::findOrFail($page_id);
        return view('Admin.Dashboard.Themes.Page.Assets.category-home', [
            'module' => CurrentModule::get(),
            'page' => $page
        ]);
    }

    public function categoryCreateView($module, $page_id)
    {
        $page = Page::findOrFail($page_id);
        return view('Admin.Dashboard.Themes.Page.Assets.category-create', ['page' => $page]);
    }

    public function categoryUpdateView($module, $page_id, $category_id)
    {
        $category = PageAssetCategory::findOrFail($category_id);
        return view('Admin.Dashboard.Themes.Page.Assets.category-edit', ['page_id' => $page_id, 'category' => $category]);
    }

    /* #region Vistas Archivos */

    public function assetHomeView($module, $page_id, $category_id)
    {
        $category = PageAssetCategory::findOrFail($category_id);
        return view('Admin.Dashboard.Themes.Page.Assets.asset-home', [
            'module' => CurrentModule::get(),
            'page_id' => $page_id,
            'category' => $category
        ]);
    }
    public function assetCreateView($module, $page_id, $category_id)
    {
        $category = PageAssetCategory::findOrFail($category_id);
        return view('Admin.Dashboard.Themes.Page.Assets.asset-create', ['page_id' => $page_id, 'category' => $category]);
    }

    public function assetUpdateView($module, $page_id, $category_id, $asset_id)
    {
        $asset = PageAsset::findOrFail($asset_id);
        return view('Admin.Dashboard.Themes.Page.Assets.asset-edit', ['page_id' => $page_id,'category_id' => $category_id,'asset' => $asset]);
    }

    /* #endregion */

    /* #endregion Vistas */

    /* #region acciones categoria */

    public function storeCategory(Request $request)
    {
        $this->categoryService->store($request);
        return redirect()->route('admin.themes.page.categories', ['module' => CurrentModule::get(), 'page_id' => $request->page_id])->with('mensaje', 'Categoria creada correctamente.');
    }

    public function updateCategory(Request $request, $module, $page_id, $category_id)
    {
        $category = PageAssetCategory::findOrFail($category_id);
        $this->categoryService->update($request, $category);
        return redirect()->route('admin.themes.page.categories', ['module' => CurrentModule::get(), 'page_id' => $request->page_id])->with('mensaje', 'Categoria actualizada correctamente.');
    }

    public function toggleCategory($module, $page_id, $category_id)
    {
        $category = PageAssetCategory::findOrFail($category_id);
        $this->categoryService->toggle($category);
        return redirect()->route('admin.themes.page.categories', ['module' => $module, 'page_id' => $page_id])->with('mensaje', 'El estado se actualizo correctamente.');
    }

    public function sortCategories(Request $request, $module, $page_id)
    {
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            PageAssetCategory::where('id', $id)
                ->where('page_id', $page_id)
                ->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyCategory($module, $page_id, $category_id)
    {
        $category = PageAssetCategory::findOrFail($category_id);
        $this->categoryService->destroy($category);
        return redirect()->route('admin.themes.page.categories', ['module' => $module, 'page_id' => $page_id])->with('mensaje', 'Categoria eliminada correctamente.');
    }
    /*  #region Acciones assets*/

    public function storeAsset(Request $request, $module, $page_id, $category_id)
    {
        $this->assetService->store($request);
        return redirect()->route('admin.themes.page.categories.asset', ['module' => $module, 'page_id' => $page_id, 'category_id' => $category_id])->with('mensaje', 'Categoria creada correctamente.');
    }

    public function updateAsset(Request $request, $module, $page_id, $category_id, $asset_id)
    {
        $asset = PageAsset::findOrFail($asset_id);
        $this->assetService->update($request, $asset);
        return redirect()->route('admin.themes.page.categories.asset', ['module' => $module, 'page_id' => $page_id, 'category_id' => $category_id])->with('mensaje', 'Categoria actualizada correctamente.');
    }

    public function toggleAsset($module, $page_id, $category_id, $asset_id)
    {
        $asset = PageAsset::findOrFail($asset_id);
        $this->assetService->toggle($asset);
        return redirect()->route('admin.themes.page.categories.asset', ['module' => $module, 'page_id' => $page_id, 'category_id' => $category_id])->with('mensaje', 'Categoria creada correctamente.');
    }

    public function sortAssets(Request $request, $module, $page_id, $category_id)
    {
        $category = PageAssetCategory::findOrFail($category_id);
        
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            PageAsset::where('id', $id)
                ->where('page_asset_category_id', $category->id)
                ->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyAsset($module, $page_id, $category_id, $asset_id)
    {
        $asset = PageAsset::findOrFail($asset_id);
        $this->assetService->destroy($asset);
        return redirect()->route('admin.themes.page.categories.asset', ['module' => $module, 'page_id' => $page_id, 'category_id' => $category_id])->with('mensaje', 'Archivo eliminado correctamente.');
    }
    /* #endregion */
    
    /* #endregion acciones */
}
