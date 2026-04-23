<?php

namespace App\Models\Shared\Themes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shared\Home\Module;
use App\Models\Shared\Themes\ChemicalItem;

class RecordsPage extends Model
{
    use HasFactory;

    public function records()
    {
        return $this->hasMany(Record::class, 'records_page_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
