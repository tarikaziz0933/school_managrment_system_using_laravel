<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Student;
use Illuminate\Http\Request;

class BirthdayController extends Controller
{
    public function studentBirthdays()
    {
        $today = now()->format('m-d');
        $today_student_birthdays = Student::whereRaw("DATE_FORMAT(dob, '%m-%d') = ?", [$today])->get();

        return view('birthdays.student_full_list', compact('today_student_birthdays'));
    }

    public function teacherBirthdays()
    {
        $today = now()->format('m-d');
        $today_teacher_birthdays = Employee::whereRaw("DATE_FORMAT(dob, '%m-%d') = ?", [$today])->get();

        return view('birthdays.teacher_full_list', compact('today_teacher_birthdays'));
    }
}
