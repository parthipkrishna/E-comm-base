<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\CompanyInfo;
use App\Models\Faq;
use App\Models\HomeSection;
use App\Models\Product;
use App\Models\SocialMediaLink;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $data = [
            'banners' => Banner::latest()->get(),
            'categories' => Category::where('status', 1)->get(),
            'products' => Product::where('feature_tag', 1)->where('status', 1)->get(),
            'faqs' => Faq::where('status', 1)->get(),
            'homesections' => HomeSection::where('status', 1)->get(),
            'companyinfo' => CompanyInfo::first(),
            'socialLinks' => SocialMediaLink::all()->keyBy('platform')
        ];
    
        return view('web.index', compact('data'));
    } 
    public function layout()
    {
        $data = [
            'companyinfo' => CompanyInfo::first(),
            'socialLinks' => SocialMediaLink::all()->keyBy('platform'),
        ];
        return view('web.layouts.layout',compact('data'));
    }   
}
