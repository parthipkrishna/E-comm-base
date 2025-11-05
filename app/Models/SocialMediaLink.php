<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMediaLink extends Model
{
    protected $fillable = [
        'platform',
        'url',
    ];
    public static function getPlatformOptions()
    {
        return ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube'];
    }
}
