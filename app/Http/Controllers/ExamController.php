<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::paginate();
        return view('setups.exam_names.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exams = Exam::paginate();
        return view('setups.exam_names.create', compact('exams'));
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

        Exam::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('exams.index')->with('success', 'Exam name added successfully!');
    }


    // public function softDelete($id)
    // {
    //     Exam::findOrFail($id)->delete();
    //     return back()->with('success', 'Exam Name deleted.');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $exam = Exam::findOrFail($id);
        return view('setups.exam_names.edit', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);

        $exam->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('exams.index')->with('success', 'Exam name updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
