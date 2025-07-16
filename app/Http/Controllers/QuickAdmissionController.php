<?php
namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Group;
use App\Models\Guardian;
use App\Models\Mca;
use App\Models\RelationType;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class QuickAdmissionController extends Controller
{
    private $except_fields = ['father_name', 'year', 'class_id', 'campus_id', 'group_id', 'section_id', 'roll', 'present_address', 'permanent_address', 'characteristics', 'roll_postfix'];
    public function create()
    {
        $students = Student::all();
        $campuses = Campus::all();
        $classes = SchoolClass::orderBy('level')
            ->where('status', 1)
            ->select(['name', 'level', 'id'])
            ->get();
        $groups = Group::where('status', 1)->pluck('name', 'id');

        $nextStudentId = Student::generateStudentId(); // Get the next student ID

        return view('quick_admission.create', compact('nextStudentId', 'students', 'campuses', 'classes', 'groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'campus_id' => 'required|exists:campuses,id',
            'class_id' => 'required|exists:classes,id',
            // 'group_id' => 'required|exists:groups,id',
            'section_id' => 'required|exists:sections,id',
            // 'year' => 'required|string|max:20',
            'id_number' => 'required|integer|unique:students,id_number',
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'roll' => [
                'nullable',
                'integer',
                Rule::unique('student_classes')->where(function ($query) use ($request) {
                    return $query->where('year', $request->year)->where('class_id', $request->class_id);
                }),
            ],
            'gender' => 'required|in:male,female,other',
            'version' => 'required|in:bangla,english',
            'status' => 'required|in:0,1', // 0 for inactive, 1 for active
            'mobile' => 'required|string|max:20',
            'sms_number' => 'required|string|max:20',
            'dob' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            $student = Student::create($request->except($this->except_fields));

            StudentClass::create([
                'student_id' => $student->id,
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'group_id' => $request->group_id,
                'campus_id' => $request->campus_id,
                'year' => $request->year,
                'roll' => $request->roll,
                'roll_postfix' => $request->roll_postfix,
            ]);

            Guardian::create([
                'name' => $request->father_name,
                'guardianable_id' => $student->id,
                'guardianable_type' => get_class($student),
                'relation_type_slug' => RelationType::FATHER,
            ]);

            Mca::make($student);

            DB::commit();

            return redirect()
                ->route('students.index', ['search' => $student->id_number])
                ->with('success', 'Student added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to add student: ' . $e->getMessage()]);
        }
    }
}
