<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_ids',
        'product_unique_identifier',
        'name',
        'description',
        'short_desc',
        'features_desc',
        'unit_price',
        'selling_price',
        'wholesale_price',
        'offer_price',
        'image',
        'stock_quantity',
        'in_stock',
        'status',
        'feature_tag',
    ];

    protected $casts = [
        'category_ids' => 'array',
        'in_stock' => 'boolean',
        'status' => 'boolean',
        'feature_tag' => 'boolean',
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function getCategoryIdsAttribute($value)
    {
        return json_decode($value, true);
    }
}
