<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use App\Models\Inbox;
use App\Models\SocialMediaLink;
use App\Mail\InquiryReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $info = CompanyInfo::first();
        $social_links = SocialMediaLink::all()->keyBy('platform');
        
        return view('web.contact',compact('info','social_links'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'message' => 'required|string',
        ]);

        $inquiry = Inbox::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'subject' => 'Product inquiry from ' . $request->name,
            'is_read' => false,
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'subject' => 'Product inquiry from ' . $request->name,
        ];

        // send mail to your admin email
        Mail::to('example@gmail.com')->send(new InquiryReceived($data));

        return back()->with('success', 'Your inquiry has been submitted');
    }
    public function terms()
    {
        return view('web.terms-conditions');
    }
    public function privacy()
    {
        return view('web.privacy-policy');
    }
}
