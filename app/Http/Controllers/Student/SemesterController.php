<?php

namespace App\Http\Controllers\Student;

use App\Models\Option;
use App\Models\Semester;
use App\Models\Course;
use Carbon\Carbon;
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
    public function voted_instructors($course_id)
    {
        $student_id = Auth::user()->student->id;
        $semester_id = Option::find(1)->value;
        return DB::table('course_instructor')
                    ->where('semester_id','=',$semester_id)
                    ->where('student_id','=',$student_id)
                    ->where('course_id','=',$course_id)
                    ->select('instructor_id')
                    ->get()->pluck('instructor_id');
    }
    public function submit_vote(Request $request, $course_id)
    {
        // TODO validation logic
        $student_id = Auth::user()->student->id;
        $semester_id = Option::find(1)->value;
        foreach ($request->all() as $vote){
            $vote_exist = DB::table('course_instructor')
                                ->where('semester_id','=',$semester_id)
                                ->where('student_id','=',$student_id)
                                ->where('course_id','=',$course_id)
                                ->where('instructor_id','=',$vote['id'])
                                ->count() > 0;
            if($vote_exist){
                if($vote['state'] == 'selected'){
                    DB::table('course_instructor')
                        ->where('semester_id','=',$semester_id)
                        ->where('student_id','=',$student_id)
                        ->where('course_id','=',$course_id)
                        ->where('instructor_id','=',$vote['id'])
                        ->update(['semester_id' => $semester_id, 'student_id' => $student_id, 'course_id' => $course_id,
                            'instructor_id' => $vote['id'], 'created_at' => Carbon::now()]);
                }else{
                    DB::table('course_instructor')
                        ->where('semester_id','=',$semester_id)
                        ->where('student_id','=',$student_id)
                        ->where('course_id','=',$course_id)
                        ->where('instructor_id','=',$vote['id'])
                        ->delete();
                }
            }else{
                if($vote['state'] == 'selected'){
                    DB::table('course_instructor')
                        ->insert(['semester_id' => $semester_id, 'student_id' => $student_id, 'course_id' => $course_id,
                            'instructor_id' => $vote['id'], 'created_at' => Carbon::now()]);
                }
            }
        }
    }
}
