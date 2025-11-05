<?php

namespace App\Exports;
use App\Models\Category;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
{
    return Product::select([
        'id',
        'category_ids',
        'name',
        'description',
        'short_desc',
        'unit_price',
        'selling_price',
        'wholesale_price',
        'offer_price',
        'features_desc',
        'image',
        'stock_quantity',
        'in_stock',
        'status',
        'feature_tag',
    ])->get()->map(function ($product) {
        $categoryIds = is_array($product->category_ids)
            ? $product->category_ids
            : json_decode($product->category_ids, true);
        $categoryNames = Category::whereIn('id', $categoryIds)->pluck('name')->toArray();
        $product->category_ids = implode(', ', $categoryNames);

        return $product;
    });
}

    public function headings(): array
    {
        return [
            'ID',
            'Category Name',
            'Name',
            'Description',
            'Short Description',
            'Unit Price',
            'Selling Price',
            'Wholesale Price',
            'Offer Price',
            'Features Desc',
            'Image',
            'Stock Quantity',
            'In Stock',
            'Status',
            'Feature Tag',
        ];
    }
}
