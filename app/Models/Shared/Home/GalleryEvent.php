<?php

namespace App\Models\Shared\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryEvent extends Model
{
    use HasFactory;
    
    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }
    
    public function firstImage() 
    {
        return $this->hasOne(GalleryImage::class)->where('is_active', true)->latest();
    }
}
