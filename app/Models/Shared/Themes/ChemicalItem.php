<?php

namespace App\Models\Shared\Themes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shared\Themes\ChemicalItemStamp;
use App\Models\Shared\Themes\ChemicalItemDetail;

class ChemicalItem extends Model
{
    use HasFactory;
    
    public function stamps()
    {
        return $this->belongsToMany(
            ChemicalStamp::class,
            'chemical_item_stamps',
            'chemical_item_id',
            'chemical_stamp_id'
        )->withPivot('order');      
    }

    public function details()
    {
        return $this->hasMany(ChemicalItemDetail::class);
    }
}
