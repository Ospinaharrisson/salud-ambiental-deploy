<?php

namespace App\Models\Shared\Themes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shared\Themes\ChemicalItem;
use App\Models\Shared\Themes\ChemicalStamp;

class ChemicalItemStamp extends Model
{
    use HasFactory;
    
    protected $table = 'chemical_item_stamps';

    protected $fillable = ['chemical_item_id', 'chemical_stamp_id', 'order'];
}
