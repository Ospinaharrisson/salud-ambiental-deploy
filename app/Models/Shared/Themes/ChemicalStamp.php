<?php

namespace App\Models\Shared\Themes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shared\Themes\ChemicalItemStamp;

class ChemicalStamp extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->belongsToMany(
            ChemicalItem::class,
            'chemical_item_stamps',
            'chemical_stamp_id',
            'chemical_item_id'
        )->withPivot('order');
    }
}
