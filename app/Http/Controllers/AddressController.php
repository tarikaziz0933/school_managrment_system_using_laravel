<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'occupation_id' => 'required|integer|exists:occupations,id',
            'relation' => 'required|string|max:100',
            'student_id' => 'required|exists:students,id',
        ]);
        Address::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }
}
