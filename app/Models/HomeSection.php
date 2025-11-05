<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $table = 'home_sections';

    protected $fillable = [
        'bg_image',
        'mockup_image',
        'title',
        'short_desc',
        'status',
        'type'
    ];
    protected $casts = [
        'type' => 'string',
        'status' => 'boolean',
    ];
}
