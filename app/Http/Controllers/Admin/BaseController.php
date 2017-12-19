<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Feedback;
use App\Models\Instructor;
use App\Models\Semester;
use App\Models\Student;
use App\Models\User;
use App\Models\Option;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home()
    {
        return view('admin.home');
    }
    public function courses()
    {
        // get query parameters
        $sortby = Input::get('sortby','category');
        $order = Input::get('order','desc');

        // validate query paramaters
        $valid_sortby_columns = ['name', 'code', 'units', 'default_min_capacity_fall', 'default_min_capacity_spring', 'category'];
        if(!in_array($sortby, $valid_sortby_columns))
            $sortby = 'category';

        // retrieve courses based on it
        if($order == 'asc'){
            $courses = Course::all()->sortBy($sortby);
        }else{
            $courses = Course::all()->sortByDesc($sortby);
        }

        // return view with courses
        return view('admin.courses', compact('courses'));
    }
    public function instructors()
    {
        $instructors = Instructor::all()->sortBy('name');
        return view('admin.instructors', compact('instructors'));
    }
    public function semesters()
    {
        $semesters = Semester::all()->where('semester', '!=','x')->sortByDesc('year');
        return view('admin.semesters', compact('semesters'));
    }
    public function students()
    {
        // get query parameters
        $sortby = Input::get('sortby','entry_year');
        $order = Input::get('order','desc');

        // validate query paramaters
        $valid_sortby_columns = ['first_name', 'last_name', 'student_id', 'entry_year', 'email'];
        if(!in_array($sortby, $valid_sortby_columns))
            $sortby = 'entry_year';

        // retrieve students based on it
        $students = DB::table('users')
                        ->join('students', 'users.id', '=', 'students.user_id')
                        ->orderBy($sortby, $order)
                        ->get();

        return view('admin.students', compact('students'));
    }
    public function reports()
    {
        $queries = DB::table('sql_queries')
                        ->select('id','name','description')
                        ->get();

        return view('admin.reports', compact('queries'));
    }
    public function scheduling()
    {
        $semester = Semester::find(Option::find(1)->value);
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
        $instructors = Instructor::all();

        $schedules = DB::table('course_schedule')
                            ->where('semester_id','=',$semester->id)
                            ->join('courses','course_schedule.course_id','=','courses.id')
                            ->join('instructors','course_schedule.instructor_id','=','instructors.id')
                            ->select('course_schedule.*', 'courses.name as course_name', 'instructors.name as instructor_name')
                            ->get();

        $schedulingStage = Option::find(6)->value;

        $evaluation_sessions = DB::table('evaluation_sessions')
                                    ->where('semester_id','=',$semester->id)
                                    ->get();

        $prereg_time = false;
        $eval_time = false;
        $final_time = false;

        $process_stage = Option::find(5)->value;
        $process_stage_state = Option::find(12)->value;
        if($process_stage_state == 'enable'){
            if($process_stage == '1st'){
                $prereg_time = true;
            }elseif ($process_stage == '2nd'){
                $eval_time = true;
            }elseif ($process_stage == '3rd'){
                $final_time = true;
            }
        }

        $any_eval_session = false;
        $active_eval_session = Option::find(13)->value;
        if(DB::table('evaluation_sessions')->where('semester_id','=',$semester->id)->count()>0 && $active_eval_session != '0'){
            $any_eval_session = true;
        }

        $active_eval_session_id = DB::table('evaluation_sessions')
                                        ->where('semester_id','=',$semester->id)
                                        ->where('session_number','=',$active_eval_session)
                                        ->first()->id;

        $courses_by_eval_count = DB::table('courses')
                                        ->join('course_schedule','courses.id','=','course_schedule.course_id')
                                        ->where('course_schedule.semester_id','=',$semester->id)
                                        ->join('schedule_evaluation','course_schedule.id','=','schedule_evaluation.schedule_id')
                                        ->where('session_id','=',$active_eval_session_id)
                                        ->groupBy('courses.id')
                                        ->select(DB::raw('courses.id, count(*) as evaluation_count'))
                                        ->orderBy('evaluation_count','desc')
                                        ->get();

        $courses_by_eval_count = $courses_by_eval_count->merge($courses->whereNotIn('id', $courses_by_eval_count->pluck('id')));

        return view('admin.scheduling', compact('courses','instructors', 'semester', 'schedules','schedulingStage', 'evaluation_sessions', 'active_eval_session', 'prereg_time', 'eval_time', 'final_time', 'any_eval_session', 'courses_by_eval_count'));
    }
    public function messages()
    {
        $messages = Feedback::all()->where('state', '=', 'inbox')->where('message','!=','')->sortByDesc('id');
        return view('admin.messages', compact('messages'));
    }
    public function settings()
    {
        $semesters = Semester::all()->where('semester','!=','x')->sortByDesc('year');
        $options = Option::all();
        return view('admin.settings', compact('semesters', 'options'));
    }
}
