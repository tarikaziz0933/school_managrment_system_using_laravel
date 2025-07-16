<?php

namespace App\Http\Controllers;

use App\Models\BloodGroup;
use Illuminate\Http\Request;

class BloodGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bloodGroups = BloodGroup::all();
        return view('setups.bloodGroups.index', compact('bloodGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setups.bloodGroups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        BloodGroup::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('blood_groups.index')->with('success', 'Blood Group added successfully!');
    }

    // public function softDelete($id)
    // {
    //     BloodGroup::findOrFail($id)->delete();
    //     return back()->with('success', 'Group Name deleted.');
    // }

    /**
     * Display the specified resource.
     */
    public function show(BloodGroup $bloodGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BloodGroup $bloodGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BloodGroup $bloodGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BloodGroup $bloodGroup)
    {
        //
    }
}
