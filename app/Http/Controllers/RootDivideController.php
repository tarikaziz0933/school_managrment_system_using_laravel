<?php

namespace App\Http\Controllers;

use App\Models\RootDivide;
use Illuminate\Http\Request;

class RootDivideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $root_divides = RootDivide::paginate();
        return view('setups.transports_setups.root_divides.index', compact('root_divides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $root_divides = RootDivide::all();

        return view('setups.transports_setups.root_divides.create', compact('root_divides'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'assign_date' => 'required|date',
            'root_code' => 'required|string|max:255',
            'vehicle_no' => 'nullable|string|max:255|unique:root_divides,vehicle_no',
            'vehicle_name' => 'nullable|string|max:255',
            'from' => 'nullable|string|max:255',
            'to' => 'nullable|string|max:255',
            'fees_amount' => 'nullable|numeric',
            'driver_name' => 'nullable|string|max:255',
            'contact_no' => 'nullable|string|max:255',
            'remarks' => 'nullable|string|max:1000',
        ]);

        RootDivide::create($request->all());

        return redirect()->route('root-divides.index')->with('success', __('Root Divide created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(RootDivide $rootDivide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $root_divide = RootDivide::findOrFail($id);
        return view('setups.transports_setups.root_divides.edit', compact('root_divide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'year' => 'required',
            'assign_date' => 'required|date',
            'root_code' => 'required|string|max:255',
            'vehicle_no' => 'nullable|string|max:255',
            'vehicle_name' => 'nullable|string|max:255',
            'from' => 'nullable|string|max:255',
            'to' => 'nullable|string|max:255',
            'fees_amount' => 'nullable|numeric',
            'driver_name' => 'nullable|string|max:255',
            'contact_no' => 'nullable|string|max:255',
            'remarks' => 'nullable|string|max:1000',
        ]);

        $rootDivide = RootDivide::findOrFail($id);
        $rootDivide->update($request->all());

        return redirect()->route('root-divides.index')->with('success', 'Root Divide updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RootDivide $rootDivide)
    {
        //
    }
}
