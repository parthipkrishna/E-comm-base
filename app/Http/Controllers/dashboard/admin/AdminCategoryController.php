<?php

namespace App\Http\Controllers\dashboard\admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Storage;

class AdminCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%$search%");
        }

        $categories = $query->with('parent')->latest()->get();
        return view('dashboard.categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::with('parent')->findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $parentCategories = Category::where('id', '!=', $id)->pluck('name', 'id');
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }
    public function create()
    { 
        $categories = Category::whereNull('parent_id')->has('children')->get();
        return view('dashboard.categories.add',compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('categories', 'public')
            : null;

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'image' => $imagePath,
            'status' => $request->status ?? 0,
        ]);

        return redirect()->route('category.show')->with('success', 'Category created successfully.');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        return redirect()->route('category.show')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.show')->with('success', 'Category deleted.');
    }

    public function toggleStatus(Request $request)
    {
        $category = Category::find($request->category_id);
        $category->status = $request->status;
        $category->save();

        return response()->json(['message' => 'Category status updated successfully.']);
    }
}