<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use Illuminate\Http\Request;

class AdminInboxController extends Controller
{
    public function index(Request $request)
    {
        $inboxes = Inbox::when($request->search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                         ->orWhere('email', 'like', "%$search%")
                         ->orWhere('phone', 'like', "%$search%");
        })->latest()->get();

        return view('dashboard.inbox.index', compact('inboxes'));
    }

    public function show(Inbox $inbox)
    {
        return view('admin.inbox.show', compact('inbox'));
    }


    public function markAsRead($id)
    {
        $message = Inbox::findOrFail($id);
        $message->is_read = true;
        $message->save();

        return response()->json(['success' => true]);
    }

}
