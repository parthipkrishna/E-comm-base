<?php

namespace App\Http\Controllers\dashboard\admin;
use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;
use Storage;

class AdminCompanyinfoController extends Controller
{
    public function index()
    {
        $companyinfo = CompanyInfo::first();
        return view('dashboard.companyinfo.index')->with(compact('companyinfo'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'company_intro'      => 'nullable|string',
            'intro_image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'vision'             => 'nullable|string',
            'mission'            => 'nullable|string',
            'phone'              => 'nullable|string|max:40',
            'address'            => 'nullable|string',
            'email'              => 'nullable|email|max:255',
            'about_short_desc'   => 'nullable|string',
            'about_desc'         => 'nullable|string',
        ]);

        $companyinfo = CompanyInfo::findOrFail($id);

        // Update basic fields
        $companyinfo->company_intro = $request->input('company_intro');
        $companyinfo->vision = $request->input('vision');
        $companyinfo->mission = $request->input('mission');
        $companyinfo->phone = $request->input('phone');
        $companyinfo->address = $request->input('address');
        $companyinfo->email = $request->input('email');
        $companyinfo->about_short_desc = $request->input('about_short_desc');
        $companyinfo->about_desc = $request->input('about_desc');

        // Handle image upload
        if ($request->hasFile('intro_image')) {
            // Delete old image if exists
            if ($companyinfo->intro_image && Storage::disk('public')->exists($companyinfo->intro_image)) {
                Storage::disk('public')->delete($companyinfo->intro_image);
            }

            $imagePath = $request->file('intro_image')->store('company_images', 'public');
            $companyinfo->intro_image = $imagePath;
        }

        $companyinfo->save();

        return redirect()->back()->with('success', 'Company info updated successfully.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'company_intro'      => 'nullable|string',
            'intro_image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'vision'             => 'nullable|string',
            'mission'            => 'nullable|string',
            'phone'              => 'nullable|string|max:20',
            'address'            => 'nullable|string',
            'email'              => 'nullable|email|max:255',
            'about_short_desc'   => 'nullable|string',
            'about_desc'         => 'nullable|string',
        ]);
        $companyinfo = new CompanyInfo();
        $companyinfo->company_intro = $request->input('company_intro');
        $companyinfo->vision = $request->input('vision');
        $companyinfo->mission = $request->input('mission');
        $companyinfo->phone = $request->input('phone');
        $companyinfo->address = $request->input('address');
        $companyinfo->email = $request->input('email');
        $companyinfo->about_short_desc = $request->input('about_short_desc');
        $companyinfo->about_desc = $request->input('about_desc');
        if ($request->hasFile('intro_image')) {
            $imagePath = $request->file('intro_image')->store('company_images', 'public');
            $companyinfo->intro_image = $imagePath;
        }
        $companyinfo->save();

        return redirect()->back()->with('success', 'Company info created successfully.');
    }

}