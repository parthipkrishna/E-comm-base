<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StockImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $product = Product::where('product_unique_identifier', $row['product_id'])->first();

        if (is_numeric($row['stock_quantity']) && is_numeric($row['unit_price'])) {
            $product->stock_quantity = $row['stock_quantity'];
            $product->unit_price = $row['unit_price'];
            $product->save();
        }
        
        return null;
    }
}

