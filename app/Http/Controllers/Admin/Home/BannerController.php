<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Content\Banner;
use App\Services\Admin\Content\Home\BannerService;

class BannerController extends Controller
{
    protected $bannerManager;

    public function __construct(BannerService $bannerManager)
    {
        $this->bannerManager = $bannerManager;
    }

    /* #region vistas */

    public function bannerHomeView()
    {
        return view('Admin.Dashboard.Home.Banners.Home.banner-home');
    }

    public function bannerCreateView()
    {
        return view('Admin.Dashboard.Home.Banners.Home.banner-create');
    }

    public function bannerUpdateView($id)
    {
        $banner = Banner::findOrFail($id);
        return view('Admin.Dashboard.Home.Banners.Home.banner-edit', compact('banner'));
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeBanner(Request $request)
    {
        $this->bannerManager->store($request);
        return redirect()->route('admin.home.banner')->with('mensaje', 'Banner guardado exitosamente.');
    }

    public function updateBanner(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $this->bannerManager->update($request, $banner);

        return redirect()->route('admin.home.banner')->with('mensaje', 'Banner actualizado exitosamente.');
    }

    public function toggleBanner($id)
    {
        $banner = Banner::findOrFail($id);
        $this->bannerManager->toggle($banner);

        return redirect()->back()->with('mensaje', 'El estado del banner ha sido actualizado exitosamente.');
    }

    public function sortBanner(Request $request)
    {
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            Banner::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }
    public function destroyBanner($id)
    {
        $banner = Banner::findOrFail($id);
        $this->bannerManager->destroy($banner);
        return redirect()->route('admin.home.banner')->with('mensaje', 'Banner eliminado correctamente.');
    }
    /* #endregion acciones */
}
