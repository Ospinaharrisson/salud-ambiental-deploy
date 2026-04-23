<?php

namespace App\Models\Shared\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;
    
    public function event()
    {
        return $this->belongsTo(GalleryEvent::class);
    }
}
