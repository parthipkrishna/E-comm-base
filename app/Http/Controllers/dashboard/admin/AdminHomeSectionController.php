<?php

namespace App\Http\Controllers\dashboard\admin;
use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use Illuminate\Http\Request;
use Storage;

class AdminHomeSectionController extends Controller
{
    public function index()
    {
        $home_sections = HomeSection::all();
        return view('dashboard.homesection.index',compact('home_sections'));
    }

    public function create()
    {
        return view('dashboard.homesection.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:approach,intro',
            'bg_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'mockup_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'short_desc' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        $homeSection = new HomeSection();
        if ($request->hasFile('bg_image')) {
            $bgImagePath = $request->file('bg_image')->store('homesections/bg_images', 'public');
            $homeSection->bg_image = $bgImagePath;
        }

        if ($request->hasFile('mockup_image')) {
            $mockup = $request->file('mockup_image')->store('homesections/mockup', 'public');
            $homeSection->mockup_image = $mockup;
        }

        $homeSection->title = $request->input('title');
        $homeSection->short_desc = $request->input('short_desc');
        $homeSection->status = $request->has('status') ? 1 : 0;
        $homeSection->type = $request->input('type');

        $homeSection->save();

        return redirect()->route('admin.homesection.show')->with('success', 'Home section created successfully.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'bg_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mockup_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'short_desc' => 'nullable|string|max:255',
            'type' => 'required|in:approach,intro',
        ]);
        $homeSection = HomeSection::findOrFail($id);
        if ($request->hasFile('bg_image')) {
            if ($homeSection->bg_image && Storage::disk('public')->exists($homeSection->bg_image)) {
                Storage::disk('public')->delete($homeSection->bg_image);
            }

            $homeSection->bg_image = $request->file('bg_image')->store('homesections/bg_images', 'public');
        }

        if ($request->hasFile('mockup_image')) {
            if ($homeSection->mockup_image && Storage::disk('public')->exists($homeSection->mockup_image)) {
                Storage::disk('public')->delete($homeSection->mockup_image);
            }

            $homeSection->mockup_image = $request->file('mockup_image')->store('homesections/mockup_images', 'public');
        }

        $homeSection->title = $request->input('title');
        $homeSection->short_desc = $request->input('short_desc');
        $homeSection->status = $request->input('status') ? 1 : 0;
        $homeSection->type = $request->input('type');
        $homeSection->save();

        return redirect()->route('admin.homesection.show')->with('success', 'Home section updated successfully.');
    }
    public function delete($id)
    {
        $homeSection = HomeSection::findOrFail($id);
        if ($homeSection->bg_image && Storage::disk('public')->exists($homeSection->bg_image)) {
            Storage::disk('public')->delete($homeSection->bg_image);
        }
        if ($homeSection->mockup_image && Storage::disk('public')->exists($homeSection->mockup_image)) {
            Storage::disk('public')->delete($homeSection->mockup_image);
        }
        $homeSection->delete();

        return redirect()->back()->with('success', 'Home section deleted successfully.');
    }
    public function toggleStatus(Request $request)
    {

        $section = HomeSection::find($request->section_id);
        $section->status = $request->status;
        $section->save();

        return response()->json(['message' => 'Section status updated successfully.']);
    }
}