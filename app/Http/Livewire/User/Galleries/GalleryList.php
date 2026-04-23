<?php

namespace App\Http\Livewire\User\Galleries;

use Livewire\Component;

use App\Models\Shared\Home\GalleryEvent;

class GalleryList extends Component
{
    public function render()
    {
        return view('User.Content.Galleries.Includes.gallery-list', [
            'galleries' => GalleryEvent::whereHas('images', function($q) {
                $q->where('is_active', true);
            })
            ->where('is_active', true)
            ->orderBy('order')
            ->latest()->paginate(7)
        ]);
    }
}
