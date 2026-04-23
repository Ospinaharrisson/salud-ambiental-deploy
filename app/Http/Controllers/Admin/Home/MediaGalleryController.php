<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Content\MediaGallery;
use App\Services\Admin\Content\Home\MediaGalleryService;

class MediaGalleryController extends Controller
{
    protected $mediaManager;

    public function __construct(MediaGalleryService $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }

    /* #region vistas */

    public function mediaHomeView()
    {
        return view('Admin.Dashboard.Home.Media.media-home');
    }

    public function mediaCreateView()
    {
        return view('Admin.Dashboard.Home.Media.media-create');
    }

    public function mediaUpdateView($id)
    {
        $banner = MediaGallery::findOrFail($id);
        return view('Admin.Dashboard.Home.Media.media-edit', compact('banner'));
    }

    /* #endregion vistas */

    /* #region acciones */

    public function storeMedia(Request $request)
    {
        $this->mediaManager->store($request);
        return redirect()->route('admin.home.media')->with('mensaje', 'Imagen guardada exitosamente.');
    }

    public function updateMedia(Request $request, $id)
    {
        $banner = MediaGallery::findOrFail($id);
        $this->mediaManager->update($request, $banner);

        return redirect()->route('admin.home.media')->with('mensaje', 'Imagen actualizada exitosamente.');
    }

    public function toggleMedia($id)
    {
        $banner = MediaGallery::findOrFail($id);
        $this->mediaManager->toggle($banner);

        return redirect()->back()->with('mensaje', 'El estado de la imagen ha sido actualizado exitosamente.');
    }

    public function sortMedia(Request $request)
    {
        $items = $request->input('order');
        foreach ($items as $index => $id) {
            MediaGallery::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyMedia($id)
    {
        $banner = MediaGallery::findOrFail($id);
        $this->mediaManager->destroy($banner);
        return redirect()->route('admin.home.media')->with('mensaje', 'Imagen eliminada exitosamente.');
    }
    /* #endregion acciones */
}
