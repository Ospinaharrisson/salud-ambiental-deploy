<?php

namespace App\Models\Shared\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class navEntry extends Model
{
    use HasFactory;

    public function collection()
    {
        return $this->belongsTo(NavCollection::class);
    }

    public function parent()
    {
        return $this->belongsTo(NavCollection::class, 'nav_collection_id');
    }
}
