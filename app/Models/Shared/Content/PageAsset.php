<?php

namespace App\Models\Shared\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Shared\Themes\PageAssetCategory;

class PageAsset extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(PageAssetCategory::class, 'page_asset_category_id');
    }
}
