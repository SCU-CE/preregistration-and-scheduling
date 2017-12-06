<?php

namespace App\Http\Controllers\Admin;

use App\Models\Semester;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show($id)
    {
        $student = Student::find($id);
        $has_course = false;
        $has_passed_course = false;
        $has_only_passed_courses = false;

        if(DB::table('course_student')->where('student_id', '=', $student->id)->count() > 0)
            $has_course = true;
        if(DB::table('course_student')->where('student_id', '=' ,$student->id)->where('semester_id', '=' ,'1')->count() > 0)
            $has_passed_course = true;
        if(DB::table('course_student')->where('student_id', '=' ,$student->id)->where('semester_id', '!=' ,'1')->count() == 0)
            $has_only_passed_courses = true;

        $semesters = DB::table('course_student')
                            ->where('student_id', '=' ,$student->id)
                            ->where('semester_id', '!=' ,'1')
                            ->join('semesters', 'course_student.semester_id', '=', 'semesters.id')
                            ->select('semesters.id','semesters.semester','semesters.year')
                            ->orderBy('semesters.year', 'desc')
                            ->orderBy('semesters.semester', 'desc')
                            ->distinct()
                            ->get();

        return view('admin.student-courses', compact('student','has_course', 'has_passed_course', 'has_only_passed_courses', 'semesters'));
    }
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();

        Session::flash('message', '"' . $student->first_name . ' ' . $student->last_name . '" با موفقیت از سامانه حذف شد.');
        Session::flash('message_color', 'orange');

        return redirect('admin/students');
    }
}
