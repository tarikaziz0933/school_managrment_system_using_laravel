<?php

namespace App\Http\Controllers;

use App\Models\BirthPlace;
use Illuminate\Http\Request;

class BirthPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $birthPlaces = BirthPlace::paginate();
        return view('birthPlace.index', compact('birthPlaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('birthPlace.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        BirthPlace::create([
            'name' => $request->name,
        ]);

        return redirect()->route('birth_place.index')->with('success', 'Occupation added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(BirthPlace $birthPlace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BirthPlace $birthPlace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BirthPlace $birthPlace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BirthPlace $birthPlace)
    {
        //
    }
}
