<?php

namespace App\Http\Controllers;

use App\Models\BloodGroup;
use App\Models\Campus;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Image;
use App\Models\Nationality;
use App\Models\Religion;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    private $validation_rules = [
        'id_number'          => 'required|string|max:255',
            'admitted_at'        => 'required|date',
            'salary'             => 'required|numeric',
            'name'               => 'required|string|max:255',
            'designation'        => 'required|string|max:255',
            'type'               => 'nullable|string',
            'status'             => 'required|boolean',
            'entry_date'         => 'required|date',
            'campus_id'          => 'required|uuid|exists:campuses,id',
            'father_name'        => 'required|string|max:255',
            'mother_name'        => 'required|string|max:255',
            'marital_status'     => 'required|in:married,divorced,un_married',
            'spouse_name'        => 'nullable|required_if:marital_status,married|string|max:255',
            'spouse_mobile'      => 'nullable|string|max:255',
            'no_of_child'        => 'nullable|integer|min:0',
            'dob'                => 'required|date',
            'gender'             => 'required|in:male,female,other',
            'religion_id'        => 'required|uuid|exists:religions,id',
            'blood_group_name'   => 'nullable|string|max:3',
            'nationality_id'     => 'required|uuid|exists:nationalities,id',
            'NID_no'             => 'nullable|string|max:255',
            'mobile'             => 'nullable|string|max:20',
            'email'              => 'nullable|email|max:255',
            'hobbies'            => 'nullable|string|max:1000',
            'experience'         => 'nullable|string|max:1000',
            'reference'          => 'nullable|string|max:1000',
            'computer_knowledge' => 'nullable|string|max:1000',
            'education'          => 'nullable|array',
            'education.*.degree' => 'nullable|string|max:255',   // example if education contains degrees
            'education.*.year'   => 'nullable|integer',
    ];


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::paginate();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $campuses        = Campus::pluck('name', 'id');
        $religions       = Religion::pluck('name', 'id');
        $bloodGroups     = BloodGroup::pluck('name');
        $nationalities   = Nationality::pluck('name', 'id');
        $designations   = Designation::pluck('name', 'id');

        return view('employees.create', compact( 'campuses', 'religions', 'bloodGroups', 'nationalities', 'designations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate($this->validation_rules);
        $employee = Employee::create($request->all());

        if ($request->hasFile('employee_image')) {
            $photoFile = $request->file('employee_image');
            Image::createX($photoFile, 512, $employee);
        }


        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee->load(['image']);
        // $employee->load(['father', 'mother']);

        $campuses        = Campus::pluck('name', 'id');
        $religions       = Religion::pluck('name', 'id');
        $bloodGroups     = BloodGroup::pluck('name');
        $nationalities   = Nationality::pluck('name', 'id');

        return view('employees.edit', compact( 'employee', 'campuses', 'religions', 'bloodGroups', 'nationalities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate($this->validation_rules);

        $employee->update($request->all());

        if ($request->hasFile('employee_image')) {
            $photoFile = $request->file('employee_image');

            if ($employee->image == null) {
                Image::createX($photoFile, 512, $employee);
            } else {
                $employee->image->updateX($photoFile, 512);
            }
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
