<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index() {
        $classes = StudentClass::paginate();
        return view('classes.index', compact('classes'));
    }
    public function create()
    {
        $classes = StudentClass::paginate();
        return view('classes.create', compact('classes'));
    }
    public function store(Request $request)
    {
        $request->validate([
                'name' => 'required|string|max:255',
                'status' => 'required|integer|in:0,1',
        ]);

        StudentClass::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('classes.index')->with('success', 'Class added successfully!');
    }
}
