<?php
namespace App\Http\Controllers;

use App\Models\BloodGroup;
use App\Models\Campus;
use App\Models\Characteristic;
use App\Models\District;
use App\Models\Group;
use App\Models\Guardian;
use App\Models\Image;
use App\Models\Nationality;
use App\Models\Occupation;
use App\Models\Relation;
use App\Models\Religion;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentClass;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Mpdf\Mpdf;

class StudentController extends Controller
{

    private $except_fields = [
        'student_image',
        'father_image',
        'father_name',
        'father_occupation_id',
        'father_mobile',
        'mother_image',
        'mother_name',
        'mother_occupation_id',
        'mother_mobile',
    ];

    private $validation_rules = [
        'name'                => 'required|string|max:255',
        'admitted_at'         => 'required|date',
        'registration_number' => 'required|integer',
        'academic_year'       => 'required|string|max:20',

        'campus_id'           => 'required|exists:campuses,id',
        'class_id'            => 'required|exists:classes,id',
        'group_id'            => 'required|exists:groups,id',
        'section_id'          => 'required|exists:sections,id',

        'roll'                => 'required|integer',
        'gender'              => 'required|in:male,female,other',
        'id_number'           => 'required|integer|unique:students,id_number',
        'mobile'              => 'required|string|max:20',
        'email'               => 'required|email|max:255',
        'dob'                 => 'required|date',

        'religion_id'         => 'required|exists:religions,id',
        'prev_school'         => 'required|string|max:255',
        'present_address'     => 'required|string',
        'permanent_address'   => 'required|string',
        'characteristics'     => 'nullable|array',

        'father_name'     => 'required|string|max:255',
        'father_occupation_id' => 'required|exists:occupations,id',
        'father_mobile'   => 'required|string|max:20',


        'mother_name'     => 'required|string|max:255',
        'mother_occupation_id' => 'required|exists:occupations,id',
        'mother_mobile'   => 'required|string|max:20',

        'remarks'             => 'nullable|string',
        'status'              => 'required|integer|in:0,1',
        'marks'               => 'required|integer|min:0',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $classes  = StudentClass::pluck('name', 'id');

        $sections  = Section::pluck('name', 'id');

        $students = Student::paginate();

        return view('students.index', compact('students','classes','sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $campuses        = Campus::pluck('name', 'id');
        $classes         = StudentClass::pluck('name', 'id');
        $groups          = Group::pluck('name', 'id');
        $sections        = Section::pluck('name', 'id');
        $religions       = Religion::pluck('name', 'id');
        $bloodGroups     = BloodGroup::pluck('name');
        $nationalities   = Nationality::pluck('name', 'id');
        $occupations     = Occupation::pluck('name', 'id');
        $districts       = District::pluck('name', 'id');
        $characteristics = Characteristic::pluck('name', 'id');

        $nextRegistrationNumber = Student::max('registration_number') + 1;

        return view('students.create', compact('nextRegistrationNumber', 'campuses', 'classes', 'groups', 'sections', 'religions', 'bloodGroups', 'nationalities', 'occupations', 'districts', 'characteristics'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate($this->validation_rules);


        $student = Student::create($request->except($this->except_fields));

        $student->characteristics()->sync($request->characteristics);

        // Student image
        if ($request->hasFile('student_image')) {
            $photoFile = $request->file('student_image');
            Image::createX($photoFile, 512, $student);
        }

        // Create father
        $father = Guardian::create([
            'name'          => $request->father_name,
            'occupation_id' => $request->father_occupation_id,
            'mobile'        => $request->father_mobile,
            'student_id'    => $student->id,
            'relation_slug' => Relation::FATHER,
        ]);

        if ($request->hasFile('father_image')) {
            $photoFile = $request->file('father_image');
            Image::createX($photoFile, 512, $father);
        }

        // Create mother
        $mother = Guardian::create([
            'name'          => $request->mother_name,
            'occupation_id' => $request->mother_occupation_id,
            'mobile'        => $request->mother_mobile,
            'student_id'    => $student->id,
            'relation_slug' => Relation::MOTHER,
        ]);

        if ($request->hasFile('mother_image')) {
            $photoFile = $request->file('mother_image');
            Image::createX($photoFile, 512, $mother);
        }

        return redirect()->route('students.show', $student->id)->with('success', 'Student added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Display the specified resource.
     */
    public function showPdf(Student $student)
    {

        $student->load([
            'image',
            'campus',
            'studentClass',
            'group',
            'section',
            'father.image',
            'father.occupation',
            'father.relation',
            'mother.image',
            'mother.occupation',
            'mother.relation',
        ]);


         // Render Blade view to HTML
         $html = View::make('students.reports.student_form', compact('student'))->render();

         // Create new mPDF instance
         $mpdf = new Mpdf();

         // Write HTML to PDF
         $mpdf->WriteHTML($html);

         // Output to browser (inline view)
         return response($mpdf->Output('student_admission.pdf', 'I'), 200)
                 ->header('Content-Type', 'application/pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $student->load(['image']);
        $student->load(['father', 'mother']);
        $student->load(['father.image', 'mother.image']);
        $student->load(['father.occupation', 'mother.occupation']);
        $student->load(['father.relation', 'mother.relation']);

        $campuses        = Campus::pluck('name', 'id');
        $classes         = StudentClass::pluck('name', 'id');
        $groups          = Group::pluck('name', 'id');
        $sections        = Section::pluck('name', 'id');
        $religions       = Religion::pluck('name', 'id');
        $bloodGroups     = BloodGroup::pluck('name');
        $nationalities   = Nationality::pluck('name', 'id');
        $occupations     = Occupation::pluck('name', 'id');
        $districts       = District::pluck('name', 'id');
        $characteristics = Characteristic::pluck('name', 'id');

        return view('students.edit', compact('student', 'campuses', 'classes', 'groups', 'sections', 'religions', 'bloodGroups', 'nationalities', 'occupations', 'districts', 'characteristics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {


        $this->validation_rules['id_number'] = [
            'required',
            Rule::unique('students')->where(function ($query) use ( $student, $request) {
                return $query
                    ->where('id_number', $request->id_number)
                    ->where('id_number', '!=', $student->id_number);
            }),
        ];

        $this->validation_rules['registration_number'] = [
            'required',
            Rule::unique('students')->where(function ($query) use ( $student, $request) {
                return $query
                    ->where('registration_number', $request->registration_number)
                    ->where('registration_number', '!=', $student->registration_number);
            }),
        ];

        $request->validate($this->validation_rules);

        $student->update($request->except($this->except_fields));

        $student->characteristics()->sync($request->characteristics);

        if ($request->hasFile('student_image')) {
            $photoFile = $request->file('student_image');

            if ($student->image == null) {
                Image::createX($photoFile, 512, $student);
            } else {
                $student->image->updateX($photoFile, 512);
            }
        }

        $father = $student->father;

        if ($father == null) {

            $father = Guardian::create([
                'name'          => $request->father_name,
                'occupation_id' => $request->father_occupation_id,
                'mobile'        => $request->father_mobile,
                'student_id'    => $student->id,
                'relation_slug' => Relation::FATHER,
            ]);

        } else {
            $father->update([
                'name'          => $request->father_name,
                'occupation_id' => $request->father_occupation_id,
                'mobile'        => $request->father_mobile,
            ]);
        }

        if ($request->hasFile('father_image')) {
            $photoFile = $request->file('father_image');

            if ($father->image == null) {
                Image::createX($photoFile, 512, $father);
            } else {
                $father->image->updateX($photoFile, 512);
            }
        }

        $mother = $student->mother;

        if ($mother == null) {

            $mother = Guardian::create([
                'name'          => $request->mother_name,
                'occupation_id' => $request->mother_occupation_id,
                'mobile'        => $request->mother_mobile,
                'student_id'    => $student->id,
                'relation_slug' => Relation::MOTHER,
            ]);

        } else {
            $father->update([
                'name'          => $request->mother_name,
                'occupation_id' => $request->mother_occupation_id,
                'mobile'        => $request->mother_mobile,
            ]);
        }

        if ($request->hasFile('mother_image')) {
            $photoFile = $request->file('mother_image');

            if ($mother->image == null) {
                Image::createX($photoFile, 512, $mother);
            } else {
                $mother->image->updateX($photoFile, 512);
            }
        }

        return redirect()->route('students.show', $student->id)->with('success', 'Student added successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
