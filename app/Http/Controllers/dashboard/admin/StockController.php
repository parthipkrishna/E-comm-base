<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Imports\StockImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockExport;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('status', 1);
        if ($request->has('stock_filter')) {
            if ($request->stock_filter === 'in_stock') {
                $query->where('stock_quantity', '>', 0);
            } elseif ($request->stock_filter === 'out_of_stock') {
                $query->where('stock_quantity', '=', 0);
            }
        }
        $products = $query->get();

        return view('dashboard.stock_report.index', compact('products'));
    }

    public function importStock(Request $request)
    {
        $request->validate([
            'stock_file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new StockImport, $request->file('stock_file'));

        return redirect()->back()->with('success', 'Stock updated successfully!');
    }
    public function export()
    {
        return Excel::download(new StockExport, 'product-stock.xlsx');
    }
    public function toggleInStock(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->in_stock = $request->in_stock;
        $product->save();

        return response()->json(['message' => 'Product stock status updated successfully.']);
    }
}
