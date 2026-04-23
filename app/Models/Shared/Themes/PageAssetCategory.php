<?php

namespace App\Models\Shared\Themes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Shared\Themes\Page;
use App\Models\Shared\Content\PageAsset;

class PageAssetCategory extends Model
{
    use HasFactory;

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function assets()
    {
        return $this->hasMany(PageAsset::class);
    }
}
