<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Shared\Home\GalleryEvent;

class GalleryRenderController extends Controller
{
    public function index() {
        return view('User.Content.Galleries.gallery-home');
    }

    public function show($id)
    {
        $gallery = GalleryEvent::with(['images' => function($q) { $q->where('is_active', true)->orderBy('order'); }])->findOrFail($id);
        return view('User.Content.Galleries.gallery-template', compact('gallery'));
    }
}
