<?php

namespace App\Http\Controllers;

use App\Models\Occupation;
use Illuminate\Http\Request;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $occupations = Occupation::paginate();
        return view('setups.occupations.index', compact('occupations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setups.occupations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:occupations,name',
            'status' => 'required|integer|in:0,1',
        ]);
        Occupation::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('occupations.index')->with('success', 'Occupation added successfully!');
    }

    // public function softDelete($id)
    // {
    //     Occupation::findOrFail($id)->delete();
    //     return back()->with('success', 'Group Name deleted.');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Occupation $occupation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $occupation = Occupation::findOrFail($id);
        return view('setups.occupations.edit', compact('occupation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:occupations,name',
            'status' => 'required|integer|in:0,1',
        ]);

        $occupation = Occupation::findOrFail($id);

        $occupation->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('occupations.index')->with('success', 'Occupation updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Occupation $occupation)
    {
        //
    }
}
