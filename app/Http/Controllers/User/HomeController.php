<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\Home\HomeRenderService;

class HomeController extends Controller
{
    protected HomeRenderService $homeRenderService;

    public function __construct(HomeRenderService $homeRenderService)
    {
        $this->homeRenderService = $homeRenderService;
    }

    public function home()
    {
        $data = $this->homeRenderService->getHomeData();
        return view("User.Components.Index.home", $data);
    }

    public function createMessage(Request $request)
    {
        $this->homeRenderService->createMessage($request);
        return back()->with('mensaje', 'Mensaje enviado correctamente.');
    }
}
