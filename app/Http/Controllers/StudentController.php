<?php
namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\BloodGroup;
use App\Models\Campus;
use App\Models\Characteristic;
use App\Models\District;
use App\Models\Group;
use App\Models\Guardian;
use App\Models\Image;
use App\Models\Mca;
use App\Models\Nationality;
use App\Models\Occupation;
use App\Models\RelationType;
use App\Models\Religion;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Mpdf\Mpdf;

class StudentController extends Controller
{
    private $except_fields = ['student_image', 'year', 'class_id', 'campus_id', 'group_id', 'section_id', 'roll', 'roll_postfix',
        'father_image', 'father_name', 'father_name_bn', 'father_occupation_id', 'father_mobile', 'father_dob', 'father_nid',
        'mother_image', 'mother_name', 'mother_name_bn', 'mother_occupation_id', 'mother_mobile', 'mother_dob', 'mother_nid',
        'guardian_image', 'guardian_name', 'guardian_name_bn', 'guardian_occupation_id', 'guardian_mobile', 'dob', 'nid',
        'present_address_line_1', 'present_area_name', 'present_police_station_id', 'present_district_id',
        'permanent_address_line_1', 'permanent_area_name', 'permanent_police_station_id', "permanent_district_id",
        'mother_dob', 'mother_nid', 'permanent_district', 'characteristics', 'guardian_relation_type_slug', 'is_primary_guardian'
    ];

    private function validationRules($request, $student = null)
    {
        return [
            'name'                        => 'required|string|max:255',
            'name_bn'                     => 'nullable|string|max:255',
            'version'                     => 'required|in:bangla,english',

            'admitted_at'                 => 'required|date',

            'id_number'                   => ['required', 'integer', Rule::unique('students')->ignore(optional($student)->id)],
            // 'govt_uid_number' => 'required|integer|unique:students,govt_uid_number',
            'govt_uid_number'             => ['required', Rule::unique('students', 'govt_uid_number')->ignore($student?->id)],

            'roll'                        => ['nullable', 'integer'],
            'roll_postfix'                => ['nullable', 'string'],

            'campus_id'                   => 'required|exists:campuses,id',
            'class_id'                    => 'required|exists:classes,id',
            'section_id'                  => 'required|exists:sections,id',

            'gender'                      => 'required|in:male,female,other',
            'mobile'                      => 'nullable|string|max:20',
            'sms_number'                  => 'required|string|max:20',
            'email'                       => 'nullable|email|max:255',
            'dob'                         => 'required|date',

            'religion_id'                 => 'nullable|exists:religions,id',
            'blood_group_name'            => 'nullable|string',
            'brn'                         => 'nullable|string|max:20',
            'nationality_id'              => 'required|string',

            'father_name'                 => 'required|string|max:255',
            'father_name_bn'              => 'nullable|string|max:255',
            'father_occupation_id'        => 'nullable|exists:occupations,id',
            'father_mobile'               => 'nullable|string|max:20',
            'father_dob'                  => 'nullable|string|max:20',
            'father_nid'                  => 'nullable|string|max:20',

            'mother_name'                 => 'required|string|max:255',
            'mother_name_bn'              => 'nullable|string|max:255',
            'mother_occupation_id'        => 'nullable|exists:occupations,id',
            'mother_mobile'               => 'nullable|string|max:20',
            'mother_dob'                  => 'nullable|string|max:20',
            'mother_nid'                  => 'nullable|string|max:20',

            'guardian_name'               => 'nullable|string|max:255',
            'guardian_name_bn'            => 'nullable|string|max:255',
            'guardian_occupation_id'      => 'nullable|exists:occupations,id',
            'guardian_mobile'             => 'nullable|string|max:20',
            'dob'                         => 'nullable|string|max:20',
            'nid'                         => 'nullable|string|max:20',

            'present_address_line_1'      => 'nullable|string|max:120',
            'present_area_name'           => 'nullable|string|max:60',
            'present_police_station_id'   => 'nullable|string',
            'present_district_id'         => 'nullable|exists:districts,id',

            'permanent_address_line_1'    => 'nullable|string|max:120',
            'permanent_area_name'         => 'nullable|string|max:60',
            'permanent_police_station_id' => 'nullable|string',
            'permanent_district_id'       => 'nullable|exists:districts,id',

            'characteristics'             => 'nullable|array',
            'prev_school'                 => 'nullable|string|max:255',
            'remarks'                     => 'nullable|string',
            'status'                      => 'required|integer|in:0,1',
            'marks'                       => 'nullable|integer|min:0',
        ];
    }

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

        $studentClasses = StudentClass::with('student') // optionally eager load currentClass
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->whereHas('student', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')->orWhere('id_number', $request->search);
                });
            })
            ->when($request->filled('area'), function ($query) use ($request) {
                $query->whereHas('student.presentAddress', function ($q) use ($request) {
                    $q->where('area_name', 'like', '%' . $request->area . '%');
                });
            })
            ->whereHas('student', function ($q) use ($request) {
                if ($request->status != null) {
                    $q->where('status', $request->status);
                }
            })
            ->when($request->filled('campus_id'), function ($query) use ($request) {
                $query->where('campus_id', $request->campus_id);
            })
            ->when($request->filled('class_id'), function ($query) use ($request) {
                $query->where('class_id', $request->class_id);
            })
            ->when($request->filled('group_id'), function ($query) use ($request) {
                $query->where('group_id', $request->group_id);
            })
            ->when($request->filled('section_id'), function ($query) use ($request) {
                $query->where('section_id', $request->section_id);
            })
            ->when($request->filled('year'), function ($query) use ($request) {
                $query->where('year', $request->year);
            })
        // ->join('students', 'student_classes.student_id', '=', 'students.id')
        // ->orderByDesc('students.id_number')
        // ->select('student_classes.*')
            ->paginate();
        // dd($request->all());
        $studentClasses->appends($request->all());

        return view('students.index', compact('studentClasses', 'classes', 'sections', 'groups', 'campuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $campuses = Campus::pluck('name', 'id');
        $classes  = SchoolClass::orderBy('level')
            ->where('status', 1)
            ->select(['name', 'level', 'id'])
            ->get();
        $groups = Group::where('status', 1)->pluck('name', 'id');
        $groups = Group::where('status', 1)->pluck('name', 'id');
        //$sections = Section::where('status', 1)->pluck('name', 'id');
        $religions       = Religion::pluck('name', 'id');
        $bloodGroups     = BloodGroup::pluck('name');
        $nationalities   = Nationality::pluck('name', 'id');
        $occupations     = Occupation::pluck('name', 'id');
        $districts       = District::pluck('name', 'id');
        $characteristics = Characteristic::pluck('name', 'id');

        $guardianRelations = RelationType::whereNotIn('slug', [RelationType::FATHER, RelationType::MOTHER])
            ->pluck('name', 'slug');

        // Generate the next student ID
        $nextStudentId = Student::generateStudentId();

        return view('students.create', compact('campuses', 'classes', 'groups', 'religions', 'bloodGroups', 'nationalities', 'occupations', 'districts', 'characteristics', 'nextStudentId', 'guardianRelations'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate($this->validationRules($request));

        DB::beginTransaction();

        try {
            // Create student
            $student = Student::create($request->except($this->except_fields));

            $student->characteristics()->sync($request->characteristics);

            Mca::make($student);

            StudentClass::create([
                'student_id'   => $student->id,
                'class_id'     => $request->class_id,
                'section_id'   => $request->section_id,
                'group_id'     => $request->group_id,
                'campus_id'    => $request->campus_id,
                'year'         => $request->year,
                'roll'         => $request->roll,
                'roll_postfix' => $request->roll_postfix,
            ]);

            // Student image
            if ($request->hasFile('student_image')) {
                $photoFile = $request->file('student_image');
                Image::createX($photoFile, 512, $student);
            }

            // Create father
            $father = Guardian::create([
                'name'               => $request->father_name,
                'name_bn'            => $request->father_name_bn,
                'occupation_id'      => $request->father_occupation_id,
                'mobile'             => $request->father_mobile,
                'dob'                => $request->father_dob,
                'nid'                => $request->father_nid,
                'guardianable_id'    => $student->id,
                'guardianable_type'  => get_class($student),
                'relation_type_slug' => RelationType::FATHER,
                'is_primary_guardian' => $request->is_primary_guardian == 'father' ? true : false,
            ]);

            if ($request->hasFile('father_image')) {
                $photoFile = $request->file('father_image');
                Image::createX($photoFile, 512, $father);
            }

            // Create mother
            $mother = Guardian::create([
                'name'               => $request->mother_name,
                'name_bn'            => $request->mother_name_bn,
                'occupation_id'      => $request->mother_occupation_id,
                'mobile'             => $request->mother_mobile,
                'dob'                => $request->mother_dob,
                'nid'                => $request->mother_nid,
                'guardianable_id'    => $student->id,
                'guardianable_type'  => get_class($student),
                'relation_type_slug' => RelationType::MOTHER,
                'is_primary_guardian' => $request->is_primary_guardian == 'mother' ? true : false,
            ]);

            if ($request->hasFile('mother_image')) {
                $photoFile = $request->file('mother_image');
                Image::createX($photoFile, 512, $mother);
            }

            if ($request->guardian_name) {

                // Create guardian
                $guardian = Guardian::create([
                    'name'               => $request->guardian_name,
                    'name_bn'            => $request->guardian_name_bn,
                    'occupation_id'      => $request->guardian_occupation_id,
                    'mobile'             => $request->guardian_mobile,
                    'dob'                => $request->dob,
                    'nid'                => $request->nid,
                    'guardianable_id'    => $student->id,
                    'guardianable_type'  => get_class($student),
                    'relation_type_slug' => $request->guardian_relation_type_slug,
                    'is_primary_guardian' => $request->is_primary_guardian == 'guardian' ? true : false,
                ]);

                if ($request->hasFile('guardian_image')) {
                    $photoFile = $request->file('guardian_image');
                    Image::createX($photoFile, 512, $guardian);
                }

            }

            // Present Address
            Address::create([
                'address_line_1'    => $request->present_address_line_1,
                'area_name'         => $request->present_area_name,
                'police_station_id' => $request->present_police_station_id,
                'district_id'       => $request->present_district_id,
                'addressable_id'    => $student->id,
                'addressable_type'  => get_class($student),
                'address_type_slug' => Address::ADDRESS_TYPE_PRESENT,
            ]);

            // Permanent Address
            Address::create([
                'address_line_1'    => $request->permanent_address_line_1,
                'area_name'         => $request->permanent_area_name,
                'police_station_id' => $request->permanent_police_station_id,
                'district_id'       => $request->permanent_district_id,
                'addressable_id'    => $student->id,
                'addressable_type'  => get_class($student),
                'address_type_slug' => Address::ADDRESS_TYPE_PERMANENT,
            ]);

            DB::commit();

            return redirect()
                ->route('students.index', ['search' => $student->id_number])
                ->with('success', 'Student added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to add student: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load([
            'currentClass',
            'studentClasses' => function ($query) {
                $query->orderBy('year', 'desc'); // or 'asc' depending on your needs
            },
        ]);

        // dd($student->currentClass);

        return view('students.show', compact('student'));
    }

    /**
     * Display the specified resource.
     */
    public function showPdf(Student $student)
    {
        $student->load(['image', 'father.image', 'father.occupation', 'father.relation', 'mother.image', 'mother.occupation', 'mother.relation']);

        // Render Blade view to HTML
        $html = View::make('students.reports.student_form', compact('student'))->render();

        // Create new mPDF instance
        $mpdf = new Mpdf();

        // Write HTML to PDF
        $mpdf->WriteHTML($html);

        // Output to browser (inline view)
        return response($mpdf->Output('student_admission.pdf', 'I'), 200)->header('Content-Type', 'application/pdf');
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

        $campuses = Campus::pluck('name', 'id');
        $classes  = SchoolClass::orderBy('level')
            ->where('status', 1)
            ->select(['name', 'level', 'id'])
            ->get();
        $groups = Group::where('status', 1)->pluck('name', 'id');
        // $sections = Section::where('status', 1)->pluck('name', 'id');
        $religions       = Religion::pluck('name', 'id');
        $bloodGroups     = BloodGroup::pluck('name');
        $nationalities   = Nationality::pluck('name', 'id');
        $occupations     = Occupation::pluck('name', 'id');
        $districts       = District::pluck('name', 'id');
        $characteristics = Characteristic::pluck('name', 'id');

        $guardianRelations = RelationType::whereNotIn('slug', [RelationType::FATHER, RelationType::MOTHER])
            ->pluck('name', 'slug');

        // dd($guardianRelations);

        return view('students.edit', compact('student', 'campuses', 'classes', 'groups', 'religions', 'bloodGroups', 'nationalities', 'occupations', 'districts', 'characteristics', 'guardianRelations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {

        $request->validate($this->validationRules($request, $student));

        $student->update($request->except($this->except_fields));

        Mca::modify($student);

        $student->characteristics()->sync($request->characteristics);

        if ($request->hasFile('student_image')) {
            $photoFile = $request->file('student_image');

            if ($student->image == null) {
                Image::createX($photoFile, 512, $student);
            } else {
                $student->image->updateX($photoFile, 512);
            }
        }

        $studentClass = $student->studentClasses()->first();
        if ($studentClass) {
            $studentClass->update([
                'class_id'     => $request->class_id,
                'section_id'   => $request->section_id,
                'group_id'     => $request->group_id,
                'campus_id'    => $request->campus_id,
                'year'         => $request->year,
                'roll'         => $request->roll,
                'roll_postfix' => $request->roll_postfix,
            ]);
        } else {
            $student->studentClasses()->create([
                'class_id'     => $request->class_id,
                'section_id'   => $request->section_id,
                'group_id'     => $request->group_id,
                'campus_id'    => $request->campus_id,
                'year'         => $request->year,
                'roll'         => $request->roll,
                'roll_postfix' => $request->roll_postfix,
            ]);
        }

        // Present Address
        $presentAddress = $student->presentAddress;

        if ($presentAddress == null) {
            $presentAddress = Address::create([
                'address_line_1'    => $request->present_address_line_1,
                'area_name'         => $request->present_area_name,
                'police_station_id' => $request->present_police_station_id,
                'district_id'       => $request->present_district_id,
                'addressable_id'    => $student->id,
                'addressable_type'  => get_class($student),
                'address_type_slug' => Address::ADDRESS_TYPE_PRESENT,
            ]);
        } else {
            $presentAddress->update([
                'address_line_1'    => $request->present_address_line_1,
                'area_name'         => $request->present_area_name,
                'police_station_id' => $request->present_police_station_id,
                'district_id'       => $request->present_district_id,
            ]);
        }

        // Permanent Address
        $permanentAddress = $student->permanentAddress;

        if ($permanentAddress == null) {
            $permanentAddress = Address::create([
                'address_line_1'    => $request->permanent_address_line_1,
                'area_name'         => $request->permanent_area_name,
                'police_station_id' => $request->permanent_police_station_id,
                'district_id'       => $request->permanent_district_id,
                'addressable_id'    => $student->id,
                'addressable_type'  => get_class($student),
                'address_type_slug' => Address::ADDRESS_TYPE_PERMANENT,
            ]);
        } else {
            $permanentAddress->update([
                'address_line_1'    => $request->permanent_address_line_1,
                'area_name'         => $request->permanent_area_name,
                'police_station_id' => $request->permanent_police_station_id,
                'district_id'       => $request->permanent_district_id,
            ]);
        }

        // Father's Information
        $father = $student->father;

        if ($father == null) {
            $father = Guardian::create([
                'name'               => $request->father_name,
                'name_bn'            => $request->father_name_bn,
                'occupation_id'      => $request->father_occupation_id,
                'mobile'             => $request->father_mobile,
                'dob'                => $request->father_dob,
                'nid'                => $request->father_nid,
                'guardianable_id'    => $student->id,
                'guardianable_type'  => get_class($student),
                'relation_type_slug' => RelationType::FATHER,
                'is_primary_guardian' => $request->is_primary_guardian == 'father' ? true : false,
            ]);
        } else {
            $father->update([
                'name'          => $request->father_name,
                'name_bn'       => $request->father_name_bn,
                'dob'           => $request->father_dob,
                'nid'           => $request->father_nid,
                'occupation_id' => $request->father_occupation_id,
                'mobile'        => $request->father_mobile,
                'is_primary_guardian' => $request->is_primary_guardian == 'father' ? true : false,
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

        // Mother's Information
        $mother = $student->mother;
        // dd($student);

        if ($mother == null) {
            $mother = Guardian::create([
                'name'               => $request->mother_name,
                'name_bn'            => $request->mother_name_bn,
                'occupation_id'      => $request->mother_occupation_id,
                'mobile'             => $request->mother_mobile,
                'dob'                => $request->mother_dob,
                'nid'                => $request->mother_nid,
                'guardianable_id'    => $student->id,
                'guardianable_type'  => get_class($student),
                'relation_type_slug' => RelationType::MOTHER,
                'is_primary_guardian' => $request->is_primary_guardian == 'mother' ? true : false,
            ]);
        } else {
            $mother->update([
                'name'          => $request->mother_name,
                'name_bn'       => $request->mother_name_bn,
                'dob'           => $request->mother_dob,
                'nid'           => $request->mother_nid,
                'occupation_id' => $request->mother_occupation_id,
                'mobile'        => $request->mother_mobile,
                'is_primary_guardian' => $request->is_primary_guardian == 'mother' ? true : false,
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

        if ($request->guardian_name) {

            // Guardian's Information
            $guardian = $student->guardian;
            if ($guardian == null) {
                $guardian = Guardian::create([
                    'name'               => $request->guardian_name,
                    'name_bn'            => $request->guardian_name_bn,
                    'occupation_id'      => $request->guardian_occupation_id,
                    'mobile'             => $request->guardian_mobile,
                    'dob'                => $request->dob,
                    'nid'                => $request->nid,
                    'guardianable_id'    => $student->id,
                    'guardianable_type'  => get_class($student),
                    'relation_type_slug' => $request->guardian_relation_type_slug,
                    'is_primary_guardian' => $request->is_primary_guardian == 'guardian' ? true : false,
                ]);
            } else {
                $guardian->update([
                    'name'               => $request->guardian_name,
                    'name_bn'            => $request->guardian_name_bn,
                    'dob'                => $request->dob,
                    'nid'                => $request->nid,
                    'occupation_id'      => $request->guardian_occupation_id,
                    'mobile'             => $request->guardian_mobile,
                    'relation_type_slug' => $request->guardian_relation_type_slug,
                    'is_primary_guardian' => $request->is_primary_guardian == 'guardian' ? true : false,
                ]);
            }
            if ($request->hasFile('guardian_image')) {
                $photoFile = $request->file('guardian_image');

                if ($guardian->image == null) {
                    Image::createX($photoFile, 512, $guardian);
                } else {
                    $guardian->image->updateX($photoFile, 512);
                }
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
