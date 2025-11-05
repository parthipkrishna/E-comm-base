<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $table = 'inbox';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'subject',
        'message',
        'is_read',
    ];
}
