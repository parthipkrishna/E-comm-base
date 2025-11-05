<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Str;

class ProductsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Split and trim category names
            $categoryNames = array_map('trim', explode(',', $row['categories']));

            // Get IDs from names
            $categoryIds = Category::whereIn('name', $categoryNames)->pluck('id')->toArray();

             $uniqueIdentifier = 'PD' . substr(str_replace('-', '', Str::uuid()), 0, 4);
            // Create product
            Product::create([
                 'product_unique_identifier' => $uniqueIdentifier,
                'name' => $row['name'],
                'description' => $row['description'],
                'short_desc' => $row['short_desc'],
                'unit_price' => $row['unit_price'],
                'selling_price' => $row['selling_price'],
                'wholesale_price' => $row['wholesale_price'],
                'offer_price' => $row['offer_price'],
                'features_desc' => $row['features_desc'],
                'image' => $row['image'],
                'stock_quantity' => $row['stock_quantity'],
                'in_stock' => $row['in_stock'],
                'status' => $row['status'],
                'feature_tag' => $row['feature_tag'],
                'category_ids' => json_encode($categoryIds),
            ]);
        }
    }
}

