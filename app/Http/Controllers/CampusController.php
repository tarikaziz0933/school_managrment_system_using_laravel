<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campuses = Campus::paginate();
        return view('setups.campuses.index', compact('campuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $campuses = Campus::paginate();
        return view('setups.campuses.create', compact('campuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);
        Campus::create([
            'name' => $request->name,
            'status' => $request->status ? 1 : 0,
        ]);

        return redirect()->route('campuses.index')->with('success', 'Campus added successfully!');
    }

    // public function toggleStatus($id)
    // {
    //     $campus = Campus::findOrFail($id);
    //     $campus->status = !$campus->status;
    //     $campus->save();

    //     return redirect()->back();
    // }

    // public function softDelete($id)
    // {
    //     Campus::findOrFail($id)->delete();
    //     return back()->with('success', 'Group Name deleted.');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Campus $campus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $campus = Campus::findOrFail($id);
        return view('setups.campuses.edit', compact('campus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);
        $campuses = Campus::findOrFail($id);
        $campuses->update([
            'name' => $request->name,
            'status' => $request->status ? 1 : 0,
        ]);

        return redirect()->route('campuses.index')->with('success', 'Campus added successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campus $campus)
    {
        //
    }
}
