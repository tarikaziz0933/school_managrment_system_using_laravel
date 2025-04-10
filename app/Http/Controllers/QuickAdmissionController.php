<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Group;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class QuickAdmissionController extends Controller
{
    public function create()
    {
        $students = Student::all();
        $campuses = Campus::all();
        $classes = StudentClass::all();
        $groups = Group::all();
        $sections = Section::all();

        return view('quick_admission.create', compact('students', 'campuses', 'classes', 'groups', 'sections'));

    }

    public function store(Request $request){
        
        $request->validate([
            'admitted_at' => 'required|date',
            'form_number' => 'nullable|integer',
            'campus_id' => 'required|exists:campuses,id',
            'class_id' => 'required|exists:classes,id',
            'group_id' => 'required|exists:groups,id',
            'section_id' => 'required|exists:sections,id',
            'academic_year' => 'nullable|string|max:20',
            'serial_no' => 'required|integer|unique:students,serial_no',
            'name' => 'required|string|max:255',
            'roll' => 'required|integer|between:0,50',
            'gender' => 'required|in:male,female,other',
            'status' => 'required|in:0,1', // 0 for inactive, 1 for active
            'mobile' => 'nullable|string|max:20',
        ]);
        // dd($request->all());

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }
}
