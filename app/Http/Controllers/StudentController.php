<?php

namespace App\Http\Controllers;

use App\Models\BirthPlace;
use App\Models\BloodGroup;
use App\Models\Campus;
use App\Models\Group;
use App\Models\Nationality;
use App\Models\Occupation;
use App\Models\Religion;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentClass;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::paginate();

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        $campuses = Campus::all();
        $classes = StudentClass::all();
        $groups = Group::all();
        $sections = Section::all();
        $religions = Religion::all();
        $bloodGroups = BloodGroup::all();
        $nationalities = Nationality::all();
        $occupations = Occupation::all();
        $birthPlaces = BirthPlace::all();

        return view('students.create', compact('students', 'campuses', 'classes', 'groups', 'sections', 'religions','bloodGroups', 'nationalities', 'occupations', 'birthPlaces'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());

        // print_r($request);
        // print_r($request->campus_id);
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'admitted_at' => 'required|date',
            'form_number' => 'nullable|integer',
            'academic_year' => 'nullable|string|max:20',
        
            'campus_id' => 'nullable|exists:campuses,id',
            'class_id' => 'nullable|exists:classes,id',
            'group_id' => 'nullable|exists:groups,id',
            'section_id' => 'nullable|exists:sections,id',
        
            'roll' => 'nullable|integer',
            'gender' => 'required|in:male,female,other',
            'serial_no' => 'nullable|integer|unique:students,serial_no',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'dob' => 'nullable|date',
        
            'religion_id' => 'nullable|exists:religions,id',
            'prev_school' => 'nullable|string|max:255',
            'present_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'characteristics' => 'nullable|array',
            // 'characteristics.*' => 'string|max:255', // Each item in characteristics array
        
            'remarks' => 'nullable|string',
            'status' => 'required|integer|in:0,1',
            'marks' => 'nullable|integer|min:0',
        ]);

        // dd($request->all());
        $dob = \Carbon\Carbon::parse($request->dob);
        $age = now()->diff($dob);

        // Handle file upload if there's an image
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        // Create the student record
        // Student::create([
        //     'name' => $request->name,
        //     // 'image' => $request->image,
        //     'admitted_at' => $request->admitted_at,
        //     'form_number' => $request->form_number,
        //     'year' => $request->year,
        //     'campus_id' => $request->campus_id,
        //     'class_id' => $request->class_id,
        //     'group_id' => $request->group_id,
        //     'section_id' => $request->section_id,
        //     'roll' => $request->roll,
        //     'gender' => $request->gender,
        //     'serial_no' => $request->serial_no,
        //     'mobile' => $request->mobile,
        //     'email' => $request->email,
        //     'fathers_image' => $request->fathers_image,
        //     'fathers_name' => $request->fathers_name,
        //     'fathers_occupation' => $request->fathers_occupation,
        //     'fathers_contact' => $request->fathers_contact,
        //     'mothers_image' => $request->mothers_image,
        //     'mothers_name' => $request->mothers_name,
        //     'mothers_occupation' => $request->mothers_occupation,
        //     'mothers_contact' => $request->mothers_contact,
        //     'dob' => $dob,
        //     'ageYears' => $age->y,
        //     'ageMonths' => $age->m,
        //     'ageDays' => $age->d,
        //     'religion' => $request->religion,
        //     'blood_group' => $request->blood_group,
        //     'nationality' => $request->nationality,
        //     'birthplace' => $request->birthplace,
        //     'prev_school' => $request->prev_school,
        //     'present_address' => $request->present_address,
        //     'permanent_address' => $request->permanent_address,
        //     'characteristics' => $request->characteristics,
        //     'remarks' => $request->remarks,
        //     'status' => $request->status,
        //     'marks' => $request->marks,
        // ]);


        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $student = Student::with(['campus_id', 'class_id', 'group_id', 'section_id', 'religion_id'])->findOrFail($id);
        $student = Student::all()->findOrFail($id);

        $pdf = Pdf::loadView('reports.student_admission', compact('student'));
        return $pdf->stream('student_admission.pdf'); // or ->download()
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($student->all());
        
        $student = Student::all()->findOrFail($id);
        $campuses = Campus::all();
        $classes = StudentClass::all();
        $groups = Group::all();
        $sections = Section::all();
        $religions = Religion::all();
        $bloodGroups = BloodGroup::all();
        $nationalities = Nationality::all();
        $occupations = Occupation::all();
        $birthPlaces = BirthPlace::all();
       
        return view('students.edit', compact('student', 'campuses', 'classes', 'groups', 'sections', 'religions','bloodGroups', 'nationalities', 'occupations', 'birthPlaces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $student->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
