<?php

namespace App\Http\Controllers\Admin\Home;


use App\Services\Admin\Content\Home\HomeVideoService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shared\Home\HomeVideo;

class HomeVideoController extends Controller
{
    
    protected $videoService;

    public function __construct(HomeVideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    public function videoHomeView()
    {
        $video = HomeVideo::first();
        return view('Admin.Dashboard.Home.video.embed-home', compact('video'));
    }

    public function storeVideo(Request $request)
    {
        $video = $this->videoService->store($request);

        if (!$video) {
            return back()->with('mensajeError', 'La URL proporcionada no corresponde a un video de YouTube válido.');
        }

        return back()->with('mensaje', 'Video insertado correctamente');
    }

    public function updateVideo(Request $request, $id)
    {
        $video = $this->videoService->updateVideo($request, $id);

        if (!$video) {
            return back()->with('mensajeError', 'La URL proporcionada no corresponde a un video de YouTube válido.');
        }

        return back()->with('mensaje', 'Video actualizado correctamente');
    }
}
