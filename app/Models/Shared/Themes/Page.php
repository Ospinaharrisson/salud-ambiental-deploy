<?php

namespace App\Models\Shared\Themes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Shared\Themes\PageAssetCategory;
use App\Models\Shared\Home\Module;

class Page extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->hasMany(PageAssetCategory::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
