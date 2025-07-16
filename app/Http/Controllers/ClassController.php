<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::orderBy('level')->paginate();

        return view('setups.classes.index', compact('classes'));
    }
    public function create()
    {
        $classes = SchoolClass::orderBy('level')->get();
        return view('setups.classes.create', compact('classes'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);

        SchoolClass::create([
            'name' => $request->name,
            'level' => $request->level,
            'status' => $request->status,
        ]);

        return redirect()->route('classes.index')->with('success', 'Class added successfully!');
    }

    public function show(SchoolClass $schoolClass)
    {
        //
    }
    public function edit(string $id)
    {
        $class = SchoolClass::findOrFail($id);
        return view('setups.classes.edit', compact('class'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);

        $class = SchoolClass::findOrFail($id);
        $class->update([
            'name' => $request->name,
            'level' => $request->level,
            'status' => $request->status,
        ]);

        return redirect()->route('classes.index')->with('success', 'Class updated successfully!');
    }
    public function destroy(SchoolClass $schoolClass)
    {
        $schoolClass->delete();
        return redirect()->route('classes.index')->with('success', 'Class deleted successfully!');
    }

    // public function softDelete($id)
    // {
    //     SchoolClass::findOrFail($id)->delete();
    //     return back()->with('success', 'Class Name deleted.');
    // }
}
