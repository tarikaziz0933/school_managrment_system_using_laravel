<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\BloodGroup;
use App\Models\Campus;
use App\Models\Designation;
use App\Models\District;
use App\Models\Education;
use App\Models\EducationBoard;
use App\Models\Employee;
use App\Models\EmploymentType;
use App\Models\Exam;
use App\Models\Group;
use App\Models\Image;
use App\Models\Nationality;
use App\Models\Religion;
use Carbon\Carbon;
// use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class EmployeeController extends Controller
{
    // private $except_fields = ['present_address_line_1', 'present_area_name', 'present_police_station_id', 'present_district_id', 'permanent_address_line_1', 'permanent_area_name', 'permanent_police_station_id', 'permanent_district_id'];

    private function validationRules($request, $employee = null)
    {
        return [
            'id_number' => ['required', 'integer', Rule::unique('employees')->ignore(optional($employee)->id)],
            'joined_at' => 'required|date',
            'salary' => 'required|numeric',
            'name' => 'required|string|max:255',
            'designation_id' => 'required|uuid|exists:designations,id',
            'employment_type_id' => 'required|uuid|exists:employment_types,id',
            'type' => 'nullable|string',
            'entry_date' => 'required|date',
            'last_working_day' => 'required|date',
            'campus_id' => 'required|uuid|exists:campuses,id',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'reference' => 'nullable|string|max:1000',
            'present_job_status' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'marital_status' => 'required|in:married,divorced,un_married',
            'spouse_name' => 'nullable|required_if:marital_status,married|string|max:255',
            'spouse_mobile' => 'nullable|string|max:255',
            'emergency_mobile' => 'nullable|string|max:255',
            'no_of_child' => 'nullable|integer|min:0',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'religion_id' => 'required|uuid|exists:religions,id',
            'nationality_id' => 'required|uuid|exists:nationalities,id',
            'NID_no' => 'nullable|string|max:255',
            'blood_group_name' => 'nullable|string|max:3',
            'NTRCA_reg_number' => 'nullable|string|max:1000',
            'NTRCA_subject' => 'nullable|string|max:100',
            'experience' => 'nullable|string|max:1000',
            'computer_knowledge' => 'nullable|string|max:1000',
            'status' => 'required|boolean',
            'tin_number' => 'nullable|digits_between:3,15',
            'bank_name' => 'nullable|string|max:100',
            'bank_branch_name' => 'nullable|string|max:100',
            'bank_account_number' => 'nullable|string|max:30',
            'bank_routing_number' => 'nullable|string|max:20',
            'mobile_banking_number' => 'nullable|string|max:20',

            'present_address_line_1' => 'nullable|string|max:120',
            'present_area_name' => 'nullable|string|max:60',
            'present_police_station_id' => 'nullable|string',
            'present_district_id' => 'nullable|exists:districts,id',

            'permanent_address_line_1' => 'nullable|string|max:120',
            'permanent_area_name' => 'nullable|string|max:60',
            'permanent_police_station_id' => 'nullable|string',
            'permanent_district_id' => 'nullable|exists:districts,id',
            'remarks' => 'nullable|string|max:1000',

            // Education array validation
            'educations' => 'nullable|array',
            'educations.*.education_id' => 'nullable|uuid|exists:educations,id',
            'educations.*.exam_id' => [
                'nullable',
                'uuid',
                'exists:exams,id',
                'distinct', // Prevent duplicate exam_id
            ],
            'educations.*.group_id' => 'nullable|uuid|exists:groups,id',
            'educations.*.education_board_id' => 'nullable|uuid|exists:education_boards,id',
            'educations.*.passing_year' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'educations.*.result' => 'nullable|string|max:100',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $employees = Employee::paginate(); this is working

        $campuses = Campus::pluck('name', 'id');

        $designations = Designation::where('status', 1)->pluck('name', 'id');

        $employment_types = EmploymentType::where('status', 1)->pluck('name', 'id');

        $districts = District::pluck('name', 'id');

        $employees = Employee::when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')->orWhere('email', $request->search);
        })
            ->when($request->filled('area'), function ($query) use ($request) {
                $query->whereHas('presentAddress', function ($q) use ($request) {
                    $q->where('area_name', 'like', '%' . $request->area . '%');
                });
            })
            ->when($request->filled('campus_id'), function ($query) use ($request) {
                $query->where('campus_id', $request->campus_id);
            })
            ->when($request->filled('designation_id'), function ($query) use ($request) {
                $query->where('designation_id', $request->designation_id);
            })
            ->when($request->filled('type'), function ($query) use ($request) {
                $query->where('type', $request->type);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                if ($request->status != null) {
                    $query->where('status', $request->status);
                }
            })
            ->orderBy('status', 'desc')
            ->paginate();

        $employees->appends($request->all());

        return view('employees.index', compact('employees', 'campuses', 'designations', 'districts', 'employment_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $campuses = Campus::pluck('name', 'id');
        $religions = Religion::pluck('name', 'id');
        $bloodGroups = BloodGroup::pluck('name');
        $nationalities = Nationality::pluck('name', 'id');
        $designations = Designation::where('status', 1)->pluck('name', 'id');
        $employment_types = EmploymentType::where('status', 1)->pluck('name', 'id');
        $exams = Exam::where('status', 1)->pluck('name', 'id');
        $groups = Group::where('status', 1)->pluck('name', 'id');
        $educationBoards = EducationBoard::where('status', 1)->pluck('name', 'id');
        $districts = District::pluck('name', 'id');

        $next_id_number = Employee::generateEmployeeId(Carbon::now());

        return view('employees.create', compact('campuses', 'religions', 'bloodGroups', 'nationalities', 'designations', 'exams', 'groups', 'educationBoards', 'next_id_number', 'districts', 'employment_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->education);
        // dd($request->all());
        $request->validate($this->validationRules($request));
        $employee = Employee::create($request->all());

        if ($request->hasFile('employee_image')) {
            $photoFile = $request->file('employee_image');
            Image::createX($photoFile, 512, $employee);
        }

        // Present Address
        Address::create([
            'address_line_1' => $request->present_address_line_1,
            'area_name' => $request->present_area_name,
            'police_station_id' => $request->present_police_station_id,
            'district_id' => $request->present_district_id,
            'addressable_id' => $employee->id,
            'addressable_type' => get_class($employee),
            'address_type_slug' => Address::ADDRESS_TYPE_PRESENT,
        ]);

        // Permanent Address
        Address::create([
            'address_line_1' => $request->permanent_address_line_1,
            'area_name' => $request->permanent_area_name,
            'police_station_id' => $request->permanent_police_station_id,
            'district_id' => $request->permanent_district_id,
            'addressable_id' => $employee->id,
            'addressable_type' => get_class($employee),
            'address_type_slug' => Address::ADDRESS_TYPE_PERMANENT,
        ]);

        // dd($request->education);

        //Education
        foreach ($request->educations as $educationItem) {
            // dd($edu['education_board_id']);

            Education::create([
                'exam_id' => $educationItem['exam_id'],
                'group_id' => $educationItem['group_id'],
                'education_board_id' => $educationItem['education_board_id'],
                'passing_year' => $educationItem['passing_year'],
                'result' => $educationItem['result'],
                'educationable_id' => $employee->id,
                'educationable_type' => get_class($employee),
            ]);
        }

        return redirect()->route('employees.show', $employee->id)->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        // dd($employee->presentAddress);

        $employee->load([
            'educations' => function ($query) {
                $query->orderBy('passing_year', 'desc'); // or 'asc' for ascending
            },
        ]);

        return view('employees.show', compact('employee'));
    }

    public function showPdf(Employee $employee)
    {
        // Load all necessary relationships used in the view
        $employee->load(['image']); // Add any other relationships used in the Blade view

        // Render Blade view to HTML
        // $html = View::make('students.reports.student_form', compact('employee'))->render();
        $html = view('employees.reports.employee_form', compact('employee'))->render();

        // Create new mPDF instance
        $mpdf = new Mpdf();

        // Write HTML to PDF
        $mpdf->WriteHTML($html);

        // Output to browser (inline view)
        return response($mpdf->Output('employee_admission.pdf', 'I'), 200)->header('Content-Type', 'application/pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee->load(['image']);
        // $employee->load(['father', 'mother']);

        $employee->load([
            'educations' => function ($query) {
                $query->orderBy('passing_year', 'desc'); // or 'asc' for ascending
            },
        ]);

        $campuses = Campus::pluck('name', 'id');
        $religions = Religion::pluck('name', 'id');
        $bloodGroups = BloodGroup::pluck('name');
        $nationalities = Nationality::pluck('name', 'id');
        $designations = Designation::where('status', 1)->pluck('name', 'id');
        $employment_types = EmploymentType::where('status', 1)->pluck('name', 'id');
        $exams = Exam::where('status', 1)->pluck('name', 'id');
        $groups = Group::where('status', 1)->pluck('name', 'id');
        $educationBoards = EducationBoard::where('status', 1)->pluck('name', 'id');
        $districts = District::pluck('name', 'id');

        // dd($employee);

        return view('employees.edit', compact('employee', 'campuses', 'religions', 'bloodGroups', 'nationalities', 'designations', 'exams', 'groups', 'educationBoards', 'districts', 'employment_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate($this->validationRules($request, $employee));
        $employee->update($request->all());

        $presentAddress = $employee->presentAddress;

        if ($presentAddress == null) {
            $presentAddress = Address::create([
                'address_line_1' => $request->present_address_line_1,
                'area_name' => $request->present_area_name,
                'police_station_id' => $request->present_police_station_id,
                'district_id' => $request->present_district_id,
                'addressable_id' => $employee->id,
                'addressable_type' => get_class($employee),
                'address_type_slug' => Address::ADDRESS_TYPE_PRESENT,
            ]);
        } else {
            $presentAddress->update([
                'address_line_1' => $request->present_address_line_1,
                'area_name' => $request->present_area_name,
                'police_station_id' => $request->present_police_station_id,
                'district_id' => $request->present_district_id,
            ]);
        }

        $permanentAddress = $employee->permanentAddress;

        if ($permanentAddress == null) {
            $permanentAddress = Address::create([
                'address_line_1' => $request->permanent_address_line_1,
                'area_name' => $request->permanent_area_name,
                'police_station_id' => $request->permanent_police_station_id,
                'district_id' => $request->permanent_district_id,
                'addressable_id' => $employee->id,
                'addressable_type' => get_class($employee),
                'address_type_slug' => Address::ADDRESS_TYPE_PERMANENT,
            ]);
        } else {
            $permanentAddress->update([
                'address_line_1' => $request->permanent_address_line_1,
                'area_name' => $request->permanent_area_name,
                'police_station_id' => $request->permanent_police_station_id,
                'district_id' => $request->permanent_district_id,
            ]);
        }

        if ($request->hasFile('employee_image')) {
            $photoFile = $request->file('employee_image');

            if ($employee->image == null) {
                Image::createX($photoFile, 512, $employee);
            } else {
                $employee->image->updateX($photoFile, 512);
            }
        }

        //Education
        foreach ($request->educations as $educationItem) {
            $employee->educations()->updateOrCreate(
                [
                    'id' => $educationItem['education_id'],
                ],
                [
                    'group_id' => $educationItem['group_id'],
                    'education_board_id' => $educationItem['education_board_id'],
                    'passing_year' => $educationItem['passing_year'],
                    'result' => $educationItem['result'],
                    'educationable_id' => $employee->id,
                    'educationable_type' => get_class($employee),
                    'exam_id' => $educationItem['exam_id'],
                ],
            );
        }

        return redirect()->route('employees.show', $employee->id)->with('success', 'Employee Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
