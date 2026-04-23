<?php

namespace App\Models\Shared\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'location',
        'topic',
        'comments',
        'created_at',
    ];

    use HasFactory;
}
