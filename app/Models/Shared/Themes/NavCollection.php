<?php

namespace App\Models\Shared\Themes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shared\Content\NavEntry;

class navCollection extends Model
{
    use HasFactory;
    
    public function entries()
    {
        return $this->hasMany(NavEntry::class);
    }
}
