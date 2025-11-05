<?php

namespace App\Http\Controllers\dashboard\admin;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    public function index(Request $request)
    {
        $faqs = Faq::when($request->search, function ($query, $search) {
                return $query->where('question', 'like', "%$search%");})->latest()->get();

        return view('dashboard.faqs.index', compact('faqs'));
    }
    public function create()
    {
        return view('dashboard.faqs.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
            'status'   => 'required|boolean',
        ]);

        Faq::create($validated);

        return redirect()->route('admin.faq.show')->with('success', 'FAQ created successfully.');
    }

    public function show(Faq $faq)
    {
        return view('admin.faqs.show', compact('faq'));
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
            'status'   => 'required|boolean',
        ]);
        
        $faq = Faq::findOrFail($id);
        $faq->update($validated);        

        return redirect()->route('admin.faq.show')->with('success', 'FAQ updated successfully.');
    }

    public function delete($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->route('admin.faq.show')->with('success', 'FAQ deleted.');
    }
}