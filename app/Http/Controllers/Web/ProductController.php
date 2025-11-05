<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $categories = Category::where('status', 1)->get();
    $products = Product::where('status', 1);
    if ($request->filled('category')) {
        $categoryIds = (array) $request->input('category');
        $products->where(function ($query) use ($categoryIds) {
            foreach ($categoryIds as $categoryId) {
                $query->orWhereJsonContains('category_ids', $categoryId);
            }
        });
    }
    $products = $products->paginate(9);

    return view('web.products', compact('products', 'categories'));
}
}