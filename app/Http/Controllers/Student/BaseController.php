<?php

namespace App\Http\Controllers\Student;

use App\Models\Instructor;
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
        $currentStep = Option::find(5)->value;
        if(in_array($currentStep,['1st','2nd','3rd'])){
            $stepState = Option::find(12)->value;
            $options = Option::all();

            $semester = Semester::find(Option::find(1)->value);
            $any_eval_session = false;
            $active_eval_session = Option::find(13)->value;
            if(DB::table('evaluation_sessions')->where('semester_id','=',$semester->id)->count()>0 && $active_eval_session != '0'){
                $any_eval_session = true;
            }
            $active_eval_session_record = null;
            if($any_eval_session){
                $active_eval_session_record = DB::table('evaluation_sessions')
                    ->where('semester_id','=',$semester->id)
                    ->where('session_number','=',Option::find(13)->value)
                    ->first();
            }

            $courses = DB::table('course_student')
                ->where('course_student.semester_id','=',$semester->id)
                ->join('courses', 'course_student.course_id', '=', 'courses.id')
                ->join('course_semester', function ($join) use ($semester){
                    $join->on('course_student.course_id', '=', 'course_semester.course_id')
                        ->where('course_semester.semester_id', '=', $semester->id);
                })
                ->groupby('courses.id', 'courses.code', 'courses.name', 'courses.units', 'courses.category', 'courses.planned_semester', 'course_semester.min_capacity')
                ->select(DB::raw('courses.id, courses.name, courses.code, courses.units, courses.category, courses.planned_semester, course_semester.min_capacity, count(*) as count'))
                ->orderby('count','desc')
                ->get();

            return view('student.home', compact('currentStep', 'stepState','options', 'any_eval_session', 'courses', 'semester', 'active_eval_session_record'));
        }else{
            return view('student.home', compact('currentStep'));
        }
    }
    public function passed_courses ()
    {
        $currentStep = Option::find(5)->value;
        $stepState = Option::find(12)->value;
        if($currentStep == '1st' && $stepState == 'enable'){
            $has_category = [];
            $courses_by_category = [];
            $student = Auth::user()->student;

            $categories = ['درس پایه', 'درس اصلی', 'درس اختیاری', 'آزمایشگاه'];
            for($i = 0; $i<count($categories); $i++){
                $has_category[$i] = DB::table('courses')->where('category', $categories[$i])->count() > 0;
                $courses_by_category[$i] = DB::table('courses')->where('category', $categories[$i])->get();
            }
            return view('student.passed-courses', compact('currentStep', 'has_category', 'courses_by_category', 'student'));
        }else{
            return redirect('student/home');
        }
    }
    public function semester_courses ()
    {
        $currentStep = Option::find(5)->value;
        $stepState = Option::find(12)->value;
        if($currentStep == '1st' && $stepState == 'enable'){
            $student = Auth::user()->student;
            $current_semester = Semester::find(Option::find(1)->value);
            $passed_all_courses = $current_semester->courses()
                    ->join('course_student', 'courses.id', '=', 'course_student.course_id')
                    ->select('courses.id', 'course_student.student_id', 'course_student.semester_id')
                    ->where('course_student.student_id', $student->id)
                    ->where('course_student.semester_id', 1)->count() == $current_semester->courses()->count();

            $units_by_category = [];
            $sum_of_units = 0;
            $max_units = Option::find(4)->value;
            $category_has_courses = [];
            $courses_by_category = [];
            $categories = ['درس پایه', 'درس اصلی', 'درس اختیاری', 'آزمایشگاه'];
            for ($i = 0; $i < count($categories); $i++) {
                $units_by_category[$i] = DB::table('course_student')->where('student_id', $student->id)
                    ->where('semester_id', $current_semester->id)
                    ->join('courses', 'course_student.course_id', '=', 'courses.id')
                    ->select('courses.units', 'courses.category')
                    ->where('category', '=', $categories[$i])
                    ->sum('courses.units');
                $sum_of_units += $units_by_category[$i];
                $category_has_courses[$i] = $current_semester->courses()->where('category', '=', $categories[$i])
                        ->join('course_student', 'courses.id', '=', 'course_student.course_id')
                        ->select('courses.id', 'course_student.student_id', 'course_student.semester_id')
                        ->where('course_student.student_id', $student->id)
                        ->where('course_student.semester_id', 1)
                        ->count() != $current_semester->courses()->where('category', '=', $categories[$i])->count();
                $courses_by_category[$i] = $current_semester->courses()->where('category', '=', $categories[$i])->get();
            }

            return view('student.semester-courses', compact('currentStep', 'current_semester', 'student', 'passed_all_courses', 'units_by_category', 'sum_of_units', 'max_units', 'category_has_courses', 'courses_by_category'));
        }else{
            return redirect('student/home');
        }
    }
    public function instructor_suggestion ()
    {
        $currentStep = Option::find(5)->value;
        $stepState = Option::find(12)->value;
        if($currentStep == '1st' && $stepState == 'enable'){
            $student = Auth::user()->student;
            $semester = Semester::find(Option::find(1)->value);
            $student_courses = DB::table('course_student')
                ->where('student_id','=',$student->id)
                ->where('semester_id','=',$semester->id)
                ->join('courses','course_student.course_id','=','courses.id')
                ->where('courses.category','!=','درس پایه')
                ->orderBy('courses.category','desc')
                ->get();
            $semester_courses = DB::table('course_semester')
                ->where('semester_id','=',$semester->id)
                ->whereNotIn('course_id',$student_courses->pluck('course_id'))
                ->join('courses','course_semester.course_id','=','courses.id')
                ->where('courses.category','!=','درس پایه')
                ->orderBy('courses.category','desc')
                ->get();
            $instructors = Instructor::all();
            return view('student.instructor-suggestion', compact('currentStep','student', 'semester','student_courses','semester_courses','instructors'));
        }else{
            return redirect('student/home');
        }
    }
    public function evaluate ()
    {
        $currentStep = Option::find(5)->value;
        $stepState = Option::find(12)->value;

        $semester_id = Option::find(1)->value;
        $any_eval_session = false;
        $active_eval_session = Option::find(13)->value;
        if(DB::table('evaluation_sessions')->where('semester_id','=',$semester_id)->count()>0 && $active_eval_session != '0'){
            $any_eval_session = true;
        }

        if($currentStep == '2nd' && $stepState == 'enable' && $any_eval_session){
            $semester = Semester::find(Option::find(1)->value);
            $schedules = DB::table('course_schedule')
                                ->where('semester_id','=',$semester->id)
                                ->join('courses','course_schedule.course_id','=','courses.id')
                                ->join('instructors','course_schedule.instructor_id','=','instructors.id')
                                ->select('course_schedule.*', 'courses.name as course_name', 'instructors.name as instructor_name')
                                ->get();
            $active_eval_session = DB::table('evaluation_sessions')
                                        ->where('semester_id','=',$semester->id)
                                        ->where('session_number','=',Option::find(13)->value)
                                        ->first();

            return view('student.evaluate', compact('currentStep','schedules', 'active_eval_session'));
        }else{
            return redirect('student/home');
        }

    }
    public function final_schedule ()
    {
        $currentStep = Option::find(5)->value;
        $stepState = Option::find(12)->value;
        if($currentStep == '3rd' && $stepState == 'enable'){
            $semester = Semester::find(Option::find(1)->value);
            $schedules = DB::table('course_schedule')
                ->where('semester_id','=',$semester->id)
                ->join('courses','course_schedule.course_id','=','courses.id')
                ->join('instructors','course_schedule.instructor_id','=','instructors.id')
                ->select('course_schedule.*', 'courses.name as course_name', 'instructors.name as instructor_name')
                ->get();
            return view('student.final-schedule', compact('currentStep','schedules'));
        }else{
            return redirect('student/home');
        }
    }
}
