<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;

class AdminSocialMediaController extends Controller
{
    public function index()
    {
        $links = SocialMediaLink::all();
        return view('dashboard.socialmedia.index')->with(compact('links'));
    }
    public function create()
    {
        return view('dashboard.socialmedia.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required',
            'url' => 'required',
        ]);
       
        try {
            $link = new SocialMediaLink();
            $link->platform = $request->input('platform');
            $link->url = $request->input('url');
            $success = $link->save();
            if ($success) {
                $message ='SocialMedia link added successfully ';
                return redirect()->route('admin.socialmedia.show')->with('message', 'Successfully stored');
            }
            else {
                return redirect()->back()->withErrors(['error' => 'Failed to save branch.'])->withInput($request->input());
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()])->withInput($request->input());
        }

    }
    public function update(Request $request, string $id)
    {
        $info = SocialMediaLink::findOrFail($id);
        $updated = $info->update([
            'platform' => $request->input('platform')?: $info->platform,
            'url' => $request->input('url')?: $info->url,
        ]);
        if($updated){
            return redirect()->back()->with(['message' => 'Successfully updated']);
        }
    }
    public function delete(string $id)
    {
        $success = SocialMediaLink::where('id',$id)->delete();
        if($success){
            return redirect()->back()->with(['message'=>'delete success']);
        }
    }
}

