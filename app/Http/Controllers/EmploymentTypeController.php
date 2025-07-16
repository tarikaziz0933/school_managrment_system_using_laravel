<?php

namespace App\Http\Controllers;

use App\Models\EmploymentType;
use Illuminate\Http\Request;

class EmploymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employment_types = EmploymentType::paginate();
        return view('setups.employment_types.index', compact('employment_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employment_types = EmploymentType::paginate();
        return view('setups.employment_types.create', compact('employment_types'));
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

        EmploymentType::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('employment-type.index')->with('success', 'Employment Type added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmploymentType $employmentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmploymentType $employmentType)
    {
        $employment_types = EmploymentType::paginate();
        return view('setups.employment_types.edit', compact('employmentType', 'employment_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmploymentType $employmentType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);

        $employmentType->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('employment-type.index')->with('success', 'Employment Type updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmploymentType $employmentType)
    {
        //
    }
}
