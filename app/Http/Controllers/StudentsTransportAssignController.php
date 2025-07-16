<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\RootDivide;
use App\Models\StudentClass;
use App\Models\StudentsTransportAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentsTransportAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentsTransportAssigns = StudentsTransportAssign::paginate();
        return view('setups.transports_setups.students_transport_assign.index', compact('studentsTransportAssigns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request->all());
        // $campuses = Campus::all();
        $studentsTransportAssigns = StudentsTransportAssign::paginate();
        $rootDivides = RootDivide::get();
        // $studentClass = null;

        return view('setups.transports_setups.students_transport_assign.create', compact('studentsTransportAssigns', 'rootDivides'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'year' => 'required|integer',
            'student_id' => 'required|uuid|exists:students,id|unique:students_transport_assigns,student_id',
            'applicable_month' => 'required|integer|between:1,12',
            'root_divide_id' => 'required|uuid',
            // 'root_divide_ids.*' => 'exists:root_divides,id',
        ]);

        // foreach ($validated['root_divide_ids'] as $rootDivideId) {
            StudentsTransportAssign::create([
                'year' => $validated['year'],
                'student_id' => $validated['student_id'],
                'applicable_month' => $validated['applicable_month'],
                'root_divide_id' => $validated['root_divide_id'],
            ]);
        // }

        return redirect()->route('students-transport-assigns.index')->with('success', 'Transport assigned saved successfully.!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentsTransportAssign $studentsTransportAssign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd($id);
        $studentTransport = StudentsTransportAssign::with(['student', 'rootDivide'])->findOrFail($id);
        $rootDivides = RootDivide::get();

        return view('setups.transports_setups.students_transport_assign.edit', compact('studentTransport', 'rootDivides'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'year' => 'required|integer',
            'applicable_month' => 'required|integer|between:1,12',
            'root_divide_id' => 'required|uuid',
            // 'root_divide_ids.*' => 'exists:root_divides,id',
        ]);


        // Step 1: Find the existing transport assign record
        $studentTransport = StudentsTransportAssign::findOrFail($id);

        // dd($request->all());

        $studentTransport->update([
            'year' => $validated['year'],
            'applicable_month' => $validated['applicable_month'],
            'root_divide_id' => $validated['root_divide_id'],
        ]);

        //  $studentTransport->rootDivides()->sync($validated['root_divide_id']);
        return redirect()->route('students-transport-assigns.index')->with('success', 'Student Transport Assign Updated Successfully');

        // return redirect()->route('students-transport-assigns.index')->with('success', 'Transport assignment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentsTransportAssign $studentsTransportAssign)
    {
        //
    }
}
