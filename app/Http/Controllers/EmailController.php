<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'message' => 'required|string',
    ]);

    $formData = [
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->message,
    ];

    Mail::to(' support@iplakshadweep.com')->send(new ContactMail($formData));

    return redirect()->back()->with('success', 'Your message has been sent successfully!');
}

}
