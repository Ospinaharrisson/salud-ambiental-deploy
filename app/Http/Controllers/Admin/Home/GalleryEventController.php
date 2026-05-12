<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Home\GalleryEvent;
use App\Models\Shared\Home\GalleryImage;
use App\Services\Admin\Content\Home\GalleryEventService;
use App\Services\Admin\Content\Home\GalleryImageService;

class GalleryEventController extends Controller
{
    protected $GalleryEventManager;
    protected $GalleryImageManager;

    public function __construct(GalleryEventService $GalleryEventManager, GalleryImageService $GalleryImageManager)
    {
        $this->GalleryEventManager = $GalleryEventManager;
        $this->GalleryImageManager = $GalleryImageManager;
    }

    /* #region vistas */

    public function galleryHomeView()
    {
        return view('Admin.Dashboard.Home.gallery.gallery-home');
    }

    public function galleryImageView(int $event_id)
    {
        $event = GalleryEvent::findOrFail($event_id);
        return view('Admin.Dashboard.Home.gallery.Images.image-home', compact('event'));
    }

    public function galleryCreateView()
    {
        return view('Admin.Dashboard.Home.gallery.gallery-create');
    }

    public function galleryUpdateView($event_id)
    {
        $event = GalleryEvent::findOrFail($event_id);
        return view('Admin.Dashboard.Home.gallery.gallery-edit', compact('event'));
    }

    /* Imagenes */

    public function galleryImageCreateView(int $event_id)
    {
        $event = GalleryEvent::findOrFail($event_id);
        return view('Admin.Dashboard.Home.gallery.Images.image-create', compact('event'));
    }

    public function galleryImageUpdateView($event_id, $image_id)
    {
        $image = GalleryImage::findOrFail($image_id);
        return view('Admin.Dashboard.Home.gallery.Images.image-edit', compact('image'));
    }

    /* #endregion vistas */

     /* #region acciones */

    public function storeGallery(Request $request)
    {
        $this->GalleryEventManager->store($request);
        return redirect()->route('admin.home.gallery')->with('mensaje', 'Galería guardada exitosamente.');
    }

    public function updateGallery(Request $request, $id)
    {
        $gallery = GalleryEvent::findOrFail($id);
        $this->GalleryEventManager->update($request, $gallery);

        return redirect()->route('admin.home.gallery')->with('mensaje', 'Galería actualizada exitosamente.');
    }

    public function toggleGallery($id)
    {
        $gallery = GalleryEvent::findOrFail($id);
        $this->GalleryEventManager->toggle($gallery);

        return redirect()->route('admin.home.gallery', ['page' => 1])->with('mensaje', 'El estado de la Galería ha sido actualizado exitosamente.');
    }

    public function sortGallery(Request $request)
    {
        $items = $request->input('order');
        
        foreach ($items as $index => $id) {
            GalleryEvent::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyGallery($id)
    {
        $gallery = GalleryEvent::findOrFail($id);
        $this->GalleryEventManager->destroy($gallery);
        return redirect()->route('admin.home.gallery')->with('mensaje', 'Galería eliminada exitosamente.');
    }

    /* Imagenes */
    public function storeGalleryImage(Request $request, $event_id)
    {
        $this->GalleryImageManager->saveImage($request, $event_id);
        return redirect()->route('admin.home.gallery.images', ['event_id' => $event_id])->with('mensaje', 'Imagen añadida a la galería exitosamente.');
    }

    public function updateGalleryImage(Request $request, $event_id, $image_id)
    {
        $image = GalleryImage::findOrFail($image_id);
        $this->GalleryImageManager->update($request, $image);

        return redirect()->route('admin.home.gallery.images', ['event_id' => $event_id])->with('mensaje', 'imagen actualizada exitosamente.');
    }
    
    public function toggleGalleryImage($event_id, $image_id)
    {
        $image = GalleryImage::findOrFail($image_id);
        $this->GalleryImageManager->toggle($image);

        return redirect()->back()->with('mensaje', 'El estado de la Imagen ha sido actualizado exitosamente.');
    }

    public function sortGalleryImage(Request $request)
    {
        $items = $request->input('order');
        
        foreach ($items as $index => $id) {
            GalleryImage::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['mensaje' => 'Orden actualizado correctamente.']);
    }

    public function destroyGalleryImage($event_id, $image_id)
    {
        $image = GalleryImage::findOrFail($image_id);
        $this->GalleryImageManager->destroy($image);
        return redirect()->route('admin.home.gallery.images', ['event_id' => $event_id])->with('mensaje', 'Imagen eliminada exitosamente.');
    }
    /* #endregion acciones */
}
