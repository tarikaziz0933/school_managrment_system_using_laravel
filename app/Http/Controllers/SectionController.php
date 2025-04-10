<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\Section;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::with(['Campus','studentClass'])->paginate();

        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $campuses = Campus::all();
        $classes = StudentClass::all();
        return view('sections.create', compact('campuses', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|integer',
            'gender' => 'required|string|in:boys,girls,all',
            'campus_id' => 'required|integer',
            
            'status' => 'required|integer|in:0,1',
        ]);

        Section::create([
            'name' => $request->name,
            'class_id' => $request->class_id,
            'gender' => $request->gender,
            'campus_id' => $request->campus_id,
            'status' => $request->status,
        ]);

    return redirect()->route('sections.index')->with('success', 'Section added successfully!');
    }

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
