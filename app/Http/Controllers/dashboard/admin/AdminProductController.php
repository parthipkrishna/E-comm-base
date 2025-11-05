<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%$search%");
        }

        $products = $query->latest()->get();
        $categories = Category::whereNull('parent_id')->get();

        return view('dashboard.products.index', compact('products','categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.product.show')->with('success', 'Product deleted successfully.');
    }

    public function toggleStatus(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();

        return response()->json(['message' => 'Product status updated successfully.']);
    }
    public function create()
    { 
        $categories = Category::whereNull('parent_id')->get();
        return view('dashboard.products.add',compact('categories'));
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categoryIds = is_string($product->category_ids) ? json_decode($product->category_ids, true) : $product->category_ids;
        $selectedCategories = Category::whereIn('id', $categoryIds)->get();
        $categories = Category::whereNull('parent_id')->get();
        return view('dashboard.products.edit',compact('categories','product','selectedCategories'));

    }
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_ids' => 'required|array',
            'unit_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'wholesale_price' => 'nullable|numeric|min:0',
            'offer_price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'short_desc' => 'nullable|string|max:255',
            'features_desc' => 'nullable|string',
            'stock_quantity' => 'required|integer|min:0',
            'status' => 'nullable|boolean',
            'in_stock' => 'nullable|boolean',
            'feature_tag' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name' => $validated['name'],
            'category_ids' => $validated['category_ids'],
            'product_unique_identifier' => 'PD' . substr(str_replace('-', '', Str::uuid()), 0, 4),
            'unit_price' => $validated['unit_price'],
            'selling_price' => $validated['selling_price'],
            'wholesale_price' => $validated['wholesale_price'] ?? 0,
            'offer_price' => $validated['offer_price'] ?? 0,
            'description' => $validated['description'],
            'short_desc' => $validated['short_desc'],
            'features_desc' => $validated['features_desc'],
            'stock_quantity' => $validated['stock_quantity'],
            'status' => $validated['status'] ?? true,
            'in_stock' => $validated['in_stock'] ?? true,
            'feature_tag' => $validated['feature_tag'] ?? false,
            'image' => $imagePath,
        ]);

        // Return a success response or redirect
        return redirect()->route('admin.product.show')->with('success', 'Product created successfully!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category_ids' => 'required|array',
            'short_desc' => 'nullable|string',
            'unit_price' => 'nullable|numeric',
            'selling_price' => 'nullable|numeric',
            'wholesale_price' => 'nullable|numeric',
            'features_desc' => 'nullable|string',
            'stock_quantity' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->short_desc = $request->short_desc;
        $product->category_ids = $request->category_ids;
        $product->unit_price = $request->unit_price;
        $product->selling_price = $request->selling_price;
        $product->wholesale_price = $request->wholesale_price;
        $product->features_desc = $request->features_desc;
        $product->stock_quantity = $request->stock_quantity;
        $product->in_stock = $request->in_stock;
        $product->status = $request->status;
        $product->feature_tag = $request->feature_tag;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('admin.product.show')->with('success', 'Product updated successfully.');
    }
    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        return back()->with('success', 'Products imported successfully.');
    }

}
