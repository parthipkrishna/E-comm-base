<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
        'image',
        'description',
        'status'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Subcategories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
