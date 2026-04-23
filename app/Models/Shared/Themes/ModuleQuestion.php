<?php

namespace App\Models\Shared\Themes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Shared\Home\Module;

class ModuleQuestion extends Model
{
    use HasFactory;

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
