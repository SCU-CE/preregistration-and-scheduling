<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Option;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SchedulingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function course_information($course_id){
        $semester_id = Option::find(1)->value;
        $schedule_info = DB::table('course_schedule')
                            ->where('semester_id','=',$semester_id)
                            ->where('course_id','=',$course_id)
                            ->join('courses','course_schedule.course_id','=','courses.id')
                            ->select('course_schedule.*', 'courses.name as course_name')
                            ->get();

        $instructors_info = DB::table('course_instructor')
                                ->where('semester_id','=',$semester_id)
                                ->where('course_id','=',$course_id)
                                ->join('instructors','course_instructor.instructor_id','=','instructors.id')
                                ->groupBy('instructors.id','instructors.name','instructors.photo','instructors.sex')
                                ->select(DB::raw('instructors.id, instructors.name, instructors.photo, instructors.sex, count(*) as votes'))
                                ->orderBy('votes','desc')
                                ->get();

        $selected_course_students = Course::find($course_id)->students($semester_id)->orderBy('entry_year','desc')->get();

        $course_conflicts = [];
        $course_interCount = [];
        $other_courses = Semester::find($semester_id)->courses()->where('course_id','!=',$course_id)->get();
        foreach ($other_courses as $course){
            $course_students = $course->students($semester_id)->get();
            $interCount = count(array_intersect(
                array_column($selected_course_students->toArray(),'student_id'),
                array_column($course_students->toArray(),'student_id')
            ));
            if($interCount>0) {
                $course_conflicts[] = [
                    'code' => $course->code,
                    'name' => $course->name,
                    'count' => $interCount
                ];
                $course_interCount[] = $interCount;
            }
        }
        array_multisort($course_interCount,SORT_DESC,$course_conflicts);

        $course_information = [
            'schedule_info' => $schedule_info,
            'instructors_info' => $instructors_info,
            'course_conflicts' => $course_conflicts,
            'course_students' => $selected_course_students
        ];
        return $course_information;
    }
    public function store_schedule(Request $request)
    {
        // TODO validation logic
        $semester_id = Option::find(1)->value;
        $number_of_groups = DB::table('course_schedule')
                                ->where('semester_id','=',$semester_id)
                                ->where('course_id','=',$request->all()[0]['course_id'])
                                ->count();
        $group_number = 1;
        foreach ($request->all() as $schedule){
            $schedule_exist = DB::table('course_schedule')
                                    ->where('semester_id','=',$semester_id)
                                    ->where('course_id','=',$schedule['course_id'])
                                    ->where('group_number','=',$schedule['group_number'])
                                    ->count() > 0;
            if($schedule_exist){
                DB::table('course_schedule')
                    ->where('semester_id','=',$semester_id)
                    ->where('course_id','=',$schedule['course_id'])
                    ->where('group_number','=',$schedule['group_number'])
                    ->update([
                        'instructor_id' => $schedule['instructor_id'],
                        'course_color' => $schedule['course_color'],
                        'weekday_1' => $schedule['weekday_1'],
                        'classroom_1' => $schedule['classroom_1'],
                        'start_time_1' => $schedule['start_time_1'],
                        'end_time_1' => $schedule['end_time_1'],
                        'weekday_2' => $schedule['weekday_2'],
                        'classroom_2' => $schedule['classroom_2'],
                        'start_time_2' => $schedule['start_time_2'],
                        'end_time_2' => $schedule['end_time_2'],
                        'exam_date' => $schedule['exam_date'],
                        'exam_date_unix' => $schedule['exam_date_unix'],
                        'exam_time' => $schedule['exam_time'],
                        'updated_at' => Carbon::now()
                    ]);;
            } else {
                DB::table('course_schedule')->insert([
                    'semester_id' => $semester_id,
                    'course_id' => $schedule['course_id'],
                    'group_number' => $schedule['group_number'],
                    'instructor_id' => $schedule['instructor_id'],
                    'course_color' => $schedule['course_color'],
                    'weekday_1' => $schedule['weekday_1'],
                    'classroom_1' => $schedule['classroom_1'],
                    'start_time_1' => $schedule['start_time_1'],
                    'end_time_1' => $schedule['end_time_1'],
                    'weekday_2' => $schedule['weekday_2'],
                    'classroom_2' => $schedule['classroom_2'],
                    'start_time_2' => $schedule['start_time_2'],
                    'end_time_2' => $schedule['end_time_2'],
                    'exam_date' => $schedule['exam_date'],
                    'exam_date_unix' => $schedule['exam_date_unix'],
                    'exam_time' => $schedule['exam_time'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
            $number_of_groups--;
            $group_number++;
        }
        for($number_of_groups; $number_of_groups>0; $number_of_groups--){
            DB::table('course_schedule')
                ->where('semester_id','=',$semester_id)
                ->where('course_id','=',$request->all()[0]['course_id'])
                ->where('group_number','=',$group_number)
                ->delete();
            $group_number++;
        }
    }
    public function remove_schedule($course_id)
    {
        $semester_id = Option::find(1)->value;
        return DB::table('course_schedule')
                ->where('semester_id','=',$semester_id)
                ->where('course_id','=',$course_id)
                ->delete();
    }
}
