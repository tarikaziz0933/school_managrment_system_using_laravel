<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentInfoController extends Controller
{
    public function getStudentByIdNumber($id_number)
    {
        $studentClass = StudentClass::with('student')
            ->whereHas('student', function ($q) use ($id_number) {
                $q->where('status', 1)->where('id_number', $id_number);
            })
            ->orderBy('roll')
            ->first();

        if (!$studentClass) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json([
            'name' => $studentClass->student->name ?? null,
            'campus_id' => $studentClass->campus_id ?? null,
            'year' => $studentClass->year ?? null,
            'class_id' => $studentClass->class_id ?? null,
            'section_id' => $studentClass->section_id ?? null,
        ]);
    }
}
