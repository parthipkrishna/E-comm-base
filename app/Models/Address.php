<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';

    protected $fillable = [
        'user_id',
        'name',
        'phone_number',
        'street',
        'city',
        'state',
        'country',
        'zip_code',
        'pin_code',
        'is_active',
        'address_type',
    ];
}
