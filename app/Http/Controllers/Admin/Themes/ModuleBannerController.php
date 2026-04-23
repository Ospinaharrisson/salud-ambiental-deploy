<?php

namespace App\Http\Controllers\Admin\Themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Admin\CurrentModule;
use App\Models\Shared\Themes\ModuleBanner;

use App\Services\Admin\Content\Themes\BannerService;

class ModuleBannerController extends Controller
{
    protected $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function bannerHomeView()
    {
        $banner = ModuleBanner::where('module_id', CurrentModule::get()->id)->first();
        return view('Admin.Dashboard.Themes.banner.banner-home', compact('banner'));
    }

    public function storeBanner(Request $request, $module)
    {
        $this->bannerService->store($request);
        return redirect()->route('admin.themes.banner', ['module' => $module])->with('mensaje', 'Banner añadido correctamente.');
    }

    public function updateBanner(Request $request, $module, $banner_id)
    {
        $banner = ModuleBanner::findOrFail($banner_id);
        $this->bannerService->update($request, $banner);
        return redirect()->route('admin.themes.banner', ['module' => $module])->with('mensaje', 'Banner actualizado correctamente.');
    }
}
