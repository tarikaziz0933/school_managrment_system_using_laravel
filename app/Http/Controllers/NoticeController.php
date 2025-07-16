<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notices = Notice::paginate();
        return view('setups.notices.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notices = Notice::paginate();
        return view('setups.notices.create', compact('notices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',

            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'target_url' => 'nullable|url',
            'status' => 'required|integer|in:0,1',
        ]);

        Notice::create([
            'title' => $request->title,
            'description' => $request->description,

            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'target_url' => $request->target_url,
            'status' => $request->status,
        ]);

        return redirect()->route('notices.index')->with('success', 'Notice added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice)
    {
        return view('setups.notices.show', compact('notice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notice $notice)
    {
        return view('setups.notices.edit', compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notice $notice)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',

            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'target_url' => 'nullable|url',
            'status' => 'required|integer|in:0,1',
        ]);

        $notice->update([
            'title' => $request->title,
            'description' => $request->description,

            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'target_url' => $request->target_url,
            'status' => $request->status,
        ]);

        return redirect()->route('notices.index')->with('success', 'Notice updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice)
    {
        //
    }
}
