<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Content\FeaturedImage;
use App\Services\Admin\Content\Home\FeaturedImageService;

class FeaturedImageController extends Controller
{
    protected $imageManager;

    public function __construct(FeaturedImageService $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    /* #region vistas */

    public function featuredHomeView()
    {
        $count = FeaturedImage::count();
        return view('Admin.Dashboard.Home.featured-image.image-home', compact('count'));
    }

    public function featuredCreateView()
    {
        return view('Admin.Dashboard.Home.featured-image.image-create');
    }

    public function featuredUpdateView($id)
    {
        $image = FeaturedImage::findOrFail($id);
        return view('Admin.Dashboard.Home.featured-image.image-edit', compact('image'));
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeFeatured(Request $request)
    {
        $this->imageManager->store($request);
        return redirect()->route('admin.home.featured')->with('mensaje', 'Imagen destacada guardada exitosamente.');
    }

    public function updateFeatured(Request $request, $id)
    {
        $image = FeaturedImage::findOrFail($id);
        $this->imageManager->update($request, $image);

        return redirect()->route('admin.home.featured')->with('mensaje', 'Imagen destacada actualizada exitosamente.');
    }

    public function toggleFeatured($id)
    {
        $image = FeaturedImage::findOrFail($id);
        $this->imageManager->toggle($image);

        return redirect()->back()->with('mensaje', 'El estado de la imagen destacada ha sido actualizado exitosamente.');
    }

    public function sortFeatured(Request $request)
    {
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            FeaturedImage::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyFeatured($id)
    {
        $image = FeaturedImage::findOrFail($id);
        $this->imageManager->destroy($image);
        return redirect()->route('admin.home.featured')->with('mensaje', 'Imagen destacada eliminada exitosamente.');
    }
    /* #endregion acciones */
}
