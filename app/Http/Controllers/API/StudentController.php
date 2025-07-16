<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentDetailsResource;
use App\Http\Resources\StudentSelect2Resource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function select2(Request $request)
    {
        $sections = Student::query()
            ->when($request->filled('id_number'), function ($query) use ($request) {
                $query->where('id_number', $request->id_number);
            })
            ->get();

        return response()->json([
            'data' => StudentSelect2Resource::collection($sections),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $student = null;

        if (Str::isUuid($id)) {
            $student = Student::find($id);
        } elseif (is_numeric($id)) {
            $student = Student::where("id_number", $id)->first();
        } else {
            return response_failed("Invalid id");
        }

        if (!$student) {
            return response_not_found("Student not found");
        }

        return response_ok(new StudentDetailsResource($student));
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
