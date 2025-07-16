<?php

namespace App\Http\Controllers;

use App\Models\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nationalities = Nationality::paginate();
        return view('setups.nationalities.index', compact('nationalities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setups.nationalities.create');
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
        Nationality::create([
            // dd($request->status),
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('nationalities.index')->with('success', 'Nationality added successfully!');
    }

    // public function softDelete($id)
    // {
    //     Nationality::findOrFail($id)->delete();
    //     return back()->with('success', 'Nationality deleted.');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Nationality $nationality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nationality = Nationality::findOrFail($id);
        return view('setups.nationalities.edit', compact('nationality'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nationality $nationality)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);

        $nationality->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('nationalities.index')->with('success', 'Nationality updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nationality $nationality)
    {
        //
    }
}
