<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designations = Designation::paginate();
        return view('setups.designations.index', compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $designations = Designation::paginate();
        return view('setups.designations.create', compact('designations'));
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

        Designation::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('designations.index')->with('success', 'Class added successfully!');
    }

    // public function toggleStatus($id)
    // {
    //     $designation = Designation::findOrFail($id);
    //     $designation->status = !$designation->status;
    //     $designation->save();

    //     return redirect()->back();
    // }

    // public function softDelete($id)
    // {
    //     Designation::findOrFail($id)->delete();
    //     return back()->with('success', 'Designation deleted.');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designation $designation)
    {
        $designations = Designation::paginate();
        return view('setups.designations.edit', compact('designation', 'designations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Designation $designation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);

        $designation->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('designations.index')->with('success', 'Designation updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        //
    }
}
