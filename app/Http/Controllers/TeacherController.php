<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Employee;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $campuses = Campus::pluck('name', 'id');

        $employees = Employee::whereHas('designation', function ($query) {
            $query->where('name', 'Teacher')->orWhere('name', 'Assistant Teacher');
        })
            ->where('status', 1)
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', $request->search)->orWhere('email', $request->search);
            })
            ->when($request->filled('campus_id'), function ($query) use ($request) {
                $query->where('campus_id', $request->campus_id);
            })
            ->when($request->filled('type'), function ($query) use ($request) {
                $query->where('type', $request->type);
            })
            ->paginate();

        return view('teachers.index', compact('employees', 'campuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
