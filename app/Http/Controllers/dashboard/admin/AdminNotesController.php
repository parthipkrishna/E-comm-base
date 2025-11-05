<?php

namespace App\Http\Controllers\dashboard\admin;
use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class AdminNotesController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'note' => 'required|string|max:1000',
        ]);
        $note = new Note();
        $note->order_id = $validated['order_id'];
        $note->note = $validated['note'] ?? null;
        $note->save();

        return redirect()->back()->with('success', 'Note added successfully.');
    }
    public function delete($id)
    {
        $note = Note::find($id);
        $note->delete();

        return redirect()->back()->with('success', 'Note deleted successfully.');
    }



}
