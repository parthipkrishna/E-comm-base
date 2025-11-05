<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'total_amount',
        'unit_amount',
        'discount',
        'total_quantity',
        'billing_address',
        'delivery_address',
        'total_before_tax',
        'tax_amount',
        'payment_type',
        'order_status'
    ];

    protected $casts = [
        'billing_address' => 'array',
        'delivery_address' => 'array',
    ];

    // Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderitems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
