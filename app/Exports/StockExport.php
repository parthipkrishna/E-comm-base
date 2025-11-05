<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::select(
            'product_unique_identifier',
            'name',
            'unit_price',
            'selling_price',
            'wholesale_price',
            'stock_quantity',
        )->get();
    }

    public function headings(): array
    {
        return [
            'Product ID',
            'Name',
            'Unit Price',
            'Selling Price',
            'WholeSale price',
            'Stock Quantity',
        ];
    }
}

