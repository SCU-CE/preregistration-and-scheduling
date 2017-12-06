<?php

namespace App\Http\Controllers\Student;

use App\Models\Option;
use App\Models\Semester;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SemesterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function pass_course($course_id)
    {
        $this->untake_course($course_id);
        $student = Auth::user()->student;
        $student->courses()->wherePivot('semester_id', 1)->syncWithoutDetaching([$course_id => ['semester_id' => 1]]);
    }
    public function unpass_course($course_id)
    {
        $student = Auth::user()->student;
        $student->courses()->wherePivot('semester_id', 1)->detach($course_id);
    }
    public function take_course($course_id)
    {
        $student = Auth::user()->student;
        $course = Course::find($course_id);
        $current_semester = Option::find(1)->value;
        $max_units = Option::find(4)->value;

        $taken_units = DB::table('course_student')->where('student_id', $student->id)
                                                ->where('semester_id', $current_semester)
                                                ->join('courses', 'course_student.course_id', '=', 'courses.id')
                                                ->select('courses.units')
                                                ->sum('courses.units');
        if( ($taken_units+$course->units) > $max_units ){
            return 'UNITS_RANGE_ERROR';
        }

        $student->courses()->wherePivot('semester_id', $current_semester)->syncWithoutDetaching([$course_id => ['semester_id' => $current_semester]]);
    }
    public function untake_course($course_id)
    {
        $student = Auth::user()->student;
        $current_semester = Option::find(1)->value;
        $student->courses()->wherePivot('semester_id', $current_semester)->detach($course_id);
    }
}
