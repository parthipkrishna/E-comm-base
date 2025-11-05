<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'order_id',
        'note',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
