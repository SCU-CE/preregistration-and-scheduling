<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Feedback;
use App\Models\Semester;
use App\Models\Student;
use App\Models\User;
use App\Models\Option;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return 'Admin Home Page!';

        $students_entryYear_count = DB::table('students')->orderBy('entryYear')->select('entryYear', DB::raw('count(*) as total'))->groupBy('entryYear')->get();
        $recent_users = User::where('role','=','student')->orderBy('lastVisitedTime','desc')->take(16)->get();

        //$semesters = Semester::all()->where('semester', '!=', 'x')->sortByDesc(function($semester){return $semester['year'] . $semester['semester'];});
        //$semesters_registered = DB::table('semesters')->where('semester', '!=', 'x')->orderBy('year','desc')->orderBy('semester','desc')->join('course_student','course_student.semester_id','=','semesters.id')->select('course_student.semester_id','course_student.student_id')->distinct();
        //$semesters_registered_count = $semesters_registered->count();

        $students_count = DB::table('students')->count();

        $current_semester_id = Option::find(1)->value;
        $current_semester = Semester::find($current_semester_id);
        $current_semester_courses = DB::table('course_semester')->where('semester_id','=',$current_semester_id)->join('courses','course_semester.course_id','=','courses.id')->orderBy('courses.category','desc')->select('courses.id','courses.name','courses.code','courses.units','course_semester.min_capacity')->get();

        return view('admin.home', ['recent_users' => $recent_users, 'students_entryYear_count' => $students_entryYear_count, 'students_count' => $students_count, 'current_semester_courses' => $current_semester_courses, 'current_semester_id' => $current_semester_id, 'current_semester' => $current_semester]);
    }

    public function courses(Request $request)
    {
        /*
        // sort by user preference if sortBy value is set in query parameters
        $sortTypes = ['name', 'code', 'units', 'category'];
        if(in_array($request->input('sortBy'), $sortTypes)){
            $sortType = $request->input('sortType');
            $sortBy = $request->input('sortBy');
            if($sortType == 'asc'){
                $courses = Course::all()->sortBy($sortBy);
            }else{
                $courses = Course::all()->sortByDesc($sortBy);
            }

            return view('admin.courses', ['courses' => $courses]);
        }
        // else return sorted by category (default)
        $courses = Course::all()->sortByDesc('category');
        return view('admin.courses', ['courses' => $courses]);
        */
        return view('admin.courses');
    }

    public function semesters()
    {
        $semesters = Semester::all()->where('semester', '!=', 'x')->sortByDesc(function($semester){
            return $semester['year'] . $semester['semester'];
        });
        return view('admin.semesters', ['semesters' => $semesters]);
    }

    public function students()
    {
        //$users = User::all()->sortByDesc('student.entryYear');
        //$users = DB::select('SELECT users.id, users.email, students.firstName, students.lastName, students.studentId, students.entryYear, students.id as sid FROM users JOIN students ON users.id = students.user_id WHERE role = \'student\'');
        return view('admin.students');
    }

    public function options()
    {
        $options = Option::all();
        $semesters = Semester::all()->where('semester', '!=', 'x')->sortByDesc(function($semester){
            return $semester['year'] . $semester['semester'];
        });
        return view('admin.options', ['options' => $options, 'semesters' => $semesters]);
    }

    public function feedback()
    {
        return view('admin.feedback');
    }
}
