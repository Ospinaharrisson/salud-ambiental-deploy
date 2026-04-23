<?php

namespace App\Models\Shared\Themes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shared\Themes\ChemicalItem;

class ChemicalItemDetail extends Model
{
    use HasFactory;

    protected $fillable = ['chemical_item_id', 'value', 'type', 'order'];

    public function item()
    {
        return $this->belongsTo(ChemicalItem::class);
    }
}
