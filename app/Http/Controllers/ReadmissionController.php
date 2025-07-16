<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Group;
use App\Models\Section;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;

class ReadmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $campuses = Campus::pluck('name', 'id');
        $classes = SchoolClass::orderBy('level')
            ->where('status', 1)
            ->select(['name', 'level', 'id'])
            ->get();
        $groups = Group::where('status', 1)->pluck('name', 'id');
        $sections = Section::pluck('name', 'id');
        // $latestYear = StudentClass::max('year');


        $studentClases = StudentClass::with('student')
            // ->where('year', $latestYear)
            ->whereHas('student', function ($q) {
                $q->where('status', '1');
            })
            ->when($request->filled('year'), function ($q) use ($request) {
                $q->where('year', $request->year);
            })
            ->when($request->filled('class_id'), function ($q) use ($request) {
                $q->where('class_id', $request->class_id);
            })
            ->when($request->filled('campus_id'), function ($q) use ($request) {
                $q->where('campus_id', $request->campus_id);
            })
            ->when($request->filled('group_id'), function ($q) use ($request) {
                $q->where('group_id', $request->group_id);
            })
            ->when($request->filled('section_id'), function ($q) use ($request) {
                $q->where('section_id', $request->section_id);
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->whereHas('student', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')->orWhere('id_number', $request->search);
                });
            })
            ->orderBy('roll')
            ->get();

            return view('re_admission.index', compact('studentClases', 'classes', 'groups', 'sections', 'campuses'));
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
        // dd($request->all());
        $errors = new MessageBag();

        // Validate if no student is selected
        if (empty($request->student_ids) || count($request->student_ids) == 0) {
            $errors->add('student_new_year', "No student selected.");
        }

        if ($request->student_ids) {
            // Get student IDs and rolls
            $studentIds = $request->input('student_ids', []);
            $rolls = $request->input('rolls', []);

            foreach ($studentIds as $student_id) {
                $student = Student::with('currentClass')->find($student_id);
                $currentClass = $student->currentClass;

                // Check if new year is greater than current year
                if ($currentClass && $request->student_new_year <= $currentClass->year) {
                    $errors->add('student_new_year', "Cannot re-admit student to year {$request->student_new_year} because it's not greater than their current year ({$currentClass->year}).");
                    continue;
                }

                // Check if new class level is greater than current class level
                $promotedClass = SchoolClass::find($request->student_new_class_id);
                if ($currentClass && $promotedClass->level <= $currentClass->schoolClass->level) {
                    $errors->add('student_new_year', "Cannot re-admit student to class {$promotedClass->name} because it's not greater than their current class ({$currentClass->schoolClass->name}).");
                    continue;
                }

                // Update StudentClass
                StudentClass::create([
                    'student_id' => $student_id,
                    'class_id' => $request->student_new_class_id,
                    'section_id' => $request->student_new_section_id ?? $currentClass->section_id,
                    'group_id' => $request->student_new_group_id ?? $currentClass->group_id,
                    'campus_id' => $request->student_new_campus_id ?? $currentClass->campus_id,
                    'year' => $request->student_new_year,
                    'roll' => $currentClass->roll,  // Default roll number
                    // 'admitted_at' => now(),
                ]);

                // Check if roll number exists in the input and update if necessary
                $newRoll = $rolls[$student_id] ?? null; // Get the roll number from input
                if ($newRoll !== null) {
                    // Update the roll number if it was provided
                    $studentClass = StudentClass::where('student_id', $student_id)
                        ->where('year', $request->student_new_year)
                        ->first();

                    if ($studentClass) {
                        $studentClass->roll = $newRoll;
                        $studentClass->save();  // Save the updated roll number
                    }
                }
            }
        }

        if ($errors->any()) {
            return redirect()->back()
                ->withErrors($errors)
                ->withInput();
        }

        return redirect()->route('re-admissions.index')->with('success', 'Student re-admitted successfully!');
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
