<?php

namespace App\Http\Controllers;

use App\Models\EducationBoard;
use Illuminate\Http\Request;

class EducationBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educationBoards = EducationBoard::paginate();
        return view('setups.education_boards.index', compact('educationBoards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $educationBoards = EducationBoard::paginate();
        return view('setups.education_boards.create', compact('educationBoards'));
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

        EducationBoard::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('education_boards.index')->with('success', 'Education Board name added successfully!');
    }



    // public function softDelete($id)
    // {
    //     EducationBoard::findOrFail($id)->delete();
    //     return back()->with('success', 'Education Board deleted.');
    // }

    /**
     * Display the specified resource.
     */
    public function show(EducationBoard $educationBoard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EducationBoard $educationBoard)
    {
        $educationBoards = EducationBoard::paginate();
        return view('setups.education_boards.edit', compact('educationBoard', 'educationBoards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EducationBoard $educationBoard)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);

        $educationBoard->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('education_boards.index')->with('success', 'Education Board name updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationBoard $educationBoard)
    {
        //
    }
}
