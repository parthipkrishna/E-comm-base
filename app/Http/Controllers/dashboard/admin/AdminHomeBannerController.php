<?php

namespace App\Http\Controllers\dashboard\admin;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Storage;

class AdminHomeBannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('dashboard.homebanner.index')->with(compact('banners'));
    }
    public function create()
    {
        return view('dashboard.homebanner.add');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);
        $banner = Banner::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($banner->image && Storage::exists($banner->image)) {
                Storage::delete($banner->image);
            }
            $imagePath = $request->file('image')->store('home_banner', 'public');
            $banner->image = $imagePath;
        }
        $banner->title = $request->input('title');
        $banner->sub_title = $request->input('sub_title');
        $banner->cta_text = $request->input('cta_text');
        $banner->cta_url = $request->input('cta_url');
        $banner->save();

        return redirect()->route('admin.homebanner.show', $banner->id)->with('success', 'Home banner updated successfully.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'cta_text' => 'nullable|string|max:100',
            'cta_url' => 'nullable|url|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('home_banner', 'public');

        $banner = new Banner();
        $banner->image = $imagePath;
        $banner->title = $request->input('title');
        $banner->sub_title = $request->input('sub_title');
        $banner->cta_text = $request->input('cta_text');
        $banner->cta_url = $request->input('cta_url');
        $banner->save();

        return redirect()->route('admin.homebanner.show')->with('success', 'Home banner created successfully.');
    }
    public function delete($id)
    {
        $faq = Banner::findOrFail($id);
        $faq->delete();
        return redirect()->route('admin.homebanner.show')->with('success', 'Banner deleted.');
    }
}