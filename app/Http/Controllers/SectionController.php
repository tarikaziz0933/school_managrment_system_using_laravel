<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\Section;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        $sections = Section::with(['Campus', 'SchoolClass'])
        ->when($request->filled('class_id'), function ($q) use ($request) {
            $q->where('class_id', $request->class_id);
        })
        ->when($request->filled('campus_id'), function ($q) use ($request) {
            $q->where('campus_id', $request->campus_id);
        })
        ->paginate();

        $campuses = Campus::pluck('name', 'id');
        $classes = SchoolClass::orderBy('level')->pluck('name', 'id');

        return view('setups.sections.index', compact('sections', 'campuses', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $campuses = Campus::pluck('name', 'id');
        $classes = SchoolClass::orderBy('level')->get();
        return view('setups.sections.create', compact('campuses', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|string',
            'gender' => 'nullable|string|in:boys,girls,null',
            'campus_id' => 'required|string',
            'total_boys' => 'nullable|integer',
            'total_girls' => 'nullable|integer',
            'status' => 'required|integer|in:0,1',
        ]);

        Section::create([
            'name' => $request->name,
            'class_id' => $request->class_id,
            'gender' => $request->gender,
            'campus_id' => $request->campus_id,
            'total_boys' => $request->total_boys,
            'total_girls' => $request->total_girls,
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
        $section = Section::findOrFail($id);
        $campuses = Campus::pluck('name', 'id');
        $classes  = SchoolClass::orderBy('level')->where('status', 1)->select(['name', 'level', 'id'])->get();
        return view('setups.sections.edit', compact('section', 'campuses', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            // 'class_id' => 'required|integer',
            'gender' => 'required|string|in:boys,girls,combined',
            // 'campus_id' => 'required|integer',

            'status' => 'required|integer|in:0,1',
        ]);
        $section = Section::findOrFail($id);
        $section->update([
            'name' => $request->name,
            'class_id' => $request->class_id,
            'gender' => $request->gender,
            'campus_id' => $request->campus_id,
            'total_seat' => $request->total_seat,
            'status' => $request->status,
        ]);
        return redirect()->route('sections.index')->with('success', 'Section updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
