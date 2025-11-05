<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $table = 'company_info';

    protected $fillable = [
        'company_intro',
        'intro_image',
        'vision',
        'mission',
        'phone',
        'address',
        'email',
        'about_short_desc',
        'about_desc'

    ];
}
