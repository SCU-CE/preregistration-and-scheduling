<?php

namespace App\Http\Controllers\Student;

use App\Models\Option;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home()
    {
        $currentStep = '1st';
        return view('student.home', compact('currentStep'));
    }
    public function passed_courses ()
    {
        $currentStep = '1st';
        $has_category = [];
        $courses_by_category = [];
        $student = Auth::user()->student;

        $categories = ['درس پایه', 'درس اصلی', 'درس اختیاری', 'آزمایشگاه'];
        for($i = 0; $i<count($categories); $i++){
            $has_category[$i] = DB::table('courses')->where('category', $categories[$i])->count() > 0;
            $courses_by_category[$i] = DB::table('courses')->where('category', $categories[$i])->get();
        }
        return view('student.passed-courses', compact('currentStep', 'has_category', 'courses_by_category', 'student'));
    }
    public function semester_courses ()
    {
        $currentStep = '1st';
        $student = Auth::user()->student;
        $current_semester = Semester::find(Option::find(1)->value);
        $passed_all_courses = $current_semester->courses()
                                    ->join('course_student', 'courses.id', '=', 'course_student.course_id')
                                    ->select('courses.id','course_student.student_id','course_student.semester_id')
                                    ->where('course_student.student_id', $student->id)
                                    ->where('course_student.semester_id', 1)->count() == $current_semester->courses()->count();

        $units_by_category = [];
        $sum_of_units = 0;
        $max_units = Option::find(4)->value;
        $category_has_courses = [];
        $courses_by_category = [];
        $categories = ['درس پایه', 'درس اصلی', 'درس اختیاری', 'آزمایشگاه'];
        for($i = 0; $i<count($categories); $i++){
            $units_by_category[$i] = DB::table('course_student')->where('student_id', $student->id)
                                                                ->where('semester_id', $current_semester->id)
                                                                ->join('courses', 'course_student.course_id', '=', 'courses.id')
                                                                ->select('courses.units', 'courses.category')
                                                                ->where('category', '=', $categories[$i])
                                                                ->sum('courses.units');
            $sum_of_units += $units_by_category[$i];
            $category_has_courses[$i] = $current_semester->courses()->where('category', '=', $categories[$i])
                                                                    ->join('course_student', 'courses.id', '=', 'course_student.course_id')
                                                                    ->select('courses.id','course_student.student_id','course_student.semester_id')
                                                                    ->where('course_student.student_id', $student->id)
                                                                    ->where('course_student.semester_id', 1)
                                                                    ->count() != $current_semester->courses()->where('category', '=', $categories[$i])->count();
            $courses_by_category[$i] = $current_semester->courses()->where('category', '=', $categories[$i])->get();
        }

        return view('student.semester-courses', compact('currentStep', 'current_semester', 'student', 'passed_all_courses', 'units_by_category', 'sum_of_units', 'max_units', 'category_has_courses', 'courses_by_category'));
    }
    public function instructor_suggestion ()
    {
        $currentStep = '1st';
        return view('student.instructor-suggestion', compact('currentStep'));
    }
    public function evaluate ()
    {
        $currentStep = '1st';
        return view('student.evaluate', compact('currentStep'));
    }
    public function final_schedule ()
    {
        $currentStep = '1st';
        return view('student.final-schedule', compact('currentStep'));
    }
}
