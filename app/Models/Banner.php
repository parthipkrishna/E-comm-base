<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'home_banner';

    protected $fillable = [
        'image',
        'title',
        'sub_title',
        'type',
        'cta_text',
        'cta_url',
    ];
}
