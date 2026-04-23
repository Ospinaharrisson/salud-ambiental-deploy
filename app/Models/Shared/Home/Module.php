<?php

namespace App\Models\Shared\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Shared\Content\EstablishmentAsset;
use App\Models\Shared\Themes\NavCollection;
use App\Models\Shared\Themes\ModuleBanner;
use App\Models\Shared\Themes\Page;
use App\Models\Shared\Themes\ModuleButton;
use App\Models\Shared\Themes\ModuleQuestion;

class Module extends Model
{
    use HasFactory;
    
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function navCollections()
    {
        return $this->hasMany(NavCollection::class);
    }

    public function banner()
    {
        return $this->hasOne(ModuleBanner::class);
    }

    public function buttons()
    {
        return $this->hasMany(ModuleButton::class);
    }

    public function questions()
    {
        return $this->hasMany(ModuleQuestion::class);
    }

    public function establishmentAssets()
    {
        return $this->hasMany(EstablishmentAsset::class);
    }
    
    public function accreditedEstablishments()
    {
        return $this->hasMany(EstablishmentAsset::class)
            ->where('category', 'accredited');
    }
    
    public function favorableEstablishments()
    {
        return $this->hasMany(EstablishmentAsset::class)
            ->where('category', 'favorable');
    }
}
