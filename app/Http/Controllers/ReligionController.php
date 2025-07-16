<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Religion;
use Illuminate\Http\Request;

class ReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $religions = Religion::all();
        return view('setups.religions.index', compact('religions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setups.religions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer|in:0,1',

        ]);
        Religion::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return redirect()->route('religions.index')->with('success', 'Religion added successfully!');
    }

    public function toggleStatus($id)
    {
        $religion = Religion::findOrFail($id);
        $religion->status = !$religion->status;
        $religion->save();

        return redirect()->back();
    }

    // public function softDelete($id)
    // {
    //     Religion::findOrFail($id)->delete();
    //     return back()->with('success', 'Group Name deleted.');
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $religion = Religion::findOrFail($id);
        return view('setups.religions.edit', compact('religion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
        $religion = Religion::findOrFail($id);
        $religion->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return redirect()->route('religions.index')->with('success', 'Religion updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
