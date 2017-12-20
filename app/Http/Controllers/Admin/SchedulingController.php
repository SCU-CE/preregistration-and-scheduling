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

        $course_evaluations = [];

        $any_eval_session = false;
        $active_eval_session_number = Option::find(13)->value;
        if(DB::table('evaluation_sessions')->where('semester_id','=',$semester_id)->count()>0 && $active_eval_session_number != '0'){
            $any_eval_session = true;
        }
        $schedulingStage = Option::find(6)->value;

        if($any_eval_session && $schedulingStage == '2nd'){
            $course_schedule = DB::table('course_schedule')
                ->where('semester_id','=',$semester_id)
                ->where('course_id','=',$course_id)
                ->get();
            $active_eval_session = DB::table('evaluation_sessions')
                ->where('semester_id','=',$semester_id)
                ->where('session_number','=',Option::find(13)->value)
                ->first();
            if(count($course_schedule)>0){
            $course_evaluations = DB::table('schedule_evaluation')
                ->where('schedule_id','=',$course_schedule[0]->id)
                ->where('session_id','=',$active_eval_session->id)
                ->join('course_schedule','schedule_evaluation.schedule_id','=','course_schedule.id')
                ->select('schedule_evaluation.*','course_schedule.weekday_1','course_schedule.start_time_1','course_schedule.end_time_1','course_schedule.weekday_2','course_schedule.start_time_2','course_schedule.end_time_2','course_schedule.exam_date','course_schedule.exam_time')
                ->orderBy('privacy','desc')
                ->get();

            foreach ($course_evaluations as $course_evaluation){
                if($course_evaluation->privacy == 'public'){
                    $upvotes = DB::table('evaluation_votes')
                        ->where('evaluation_id','=',$course_evaluation->id)
                        ->where('vote','=',1)
                        ->count();

                    $downvotes = DB::table('evaluation_votes')
                        ->where('evaluation_id','=',$course_evaluation->id)
                        ->where('vote','=',-1)
                        ->count();

                    $course_evaluation->upvotes = $upvotes;
                    $course_evaluation->downvotes = -$downvotes;
                }
            }
        }
        }
        $course_information = [
            'schedule_info' => $schedule_info,
            'instructors_info' => $instructors_info,
            'course_conflicts' => $course_conflicts,
            'course_students' => $selected_course_students,
            'course_evaluation' => $course_evaluations
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
    public function change_scheduling_stage(Request $request){
        $schedulingStage = Option::find(6);
        $schedulingStage->value = $request->input('scheduling_stage');
        $schedulingStage->save();
        return redirect('admin/scheduling');
    }
    public function store_evaluation_sessions(Request $request){
        $semester_id = Option::find(1)->value;
        $number_of_existed_sessions = DB::table('evaluation_sessions')
                                            ->where('semester_id','=',$semester_id)
                                            ->count();
        $number_of_submited_sessions = $request->input('number_of_sessions');
        if((int)$number_of_submited_sessions > (int)$number_of_existed_sessions){
            for ($i = 1; $i<=(int)$number_of_existed_sessions; $i++){
                // update
                DB::table('evaluation_sessions')
                    ->where('semester_id','=',$semester_id)
                    ->where('session_number','=',$i)
                    ->update([
                        'start_date' => $request->input('start_date_'.$i),
                        'end_date' => $request->input('end_date_'.$i),
                        'updated_at' => Carbon::now()
                    ]);
            }
            for ($i=(int)$number_of_existed_sessions+1; $i<=(int)$number_of_submited_sessions; $i++){
                // insert
                DB::table('evaluation_sessions')
                    ->insert([
                        'semester_id' => $semester_id,
                        'session_number' => $i,
                        'start_date' => $request->input('start_date_'.$i),
                        'end_date' => $request->input('end_date_'.$i),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
            }
        }else{
            for ($i = 1; $i<=(int)$number_of_submited_sessions; $i++){
                // update
                DB::table('evaluation_sessions')
                    ->where('semester_id','=',$semester_id)
                    ->where('session_number','=',$i)
                    ->update([
                        'start_date' => $request->input('start_date_'.$i),
                        'end_date' => $request->input('end_date_'.$i),
                        'updated_at' => Carbon::now()
                    ]);
            }
            for ($i=(int)$number_of_submited_sessions+1; $i<=(int)$number_of_existed_sessions; $i++){
                // delete
                DB::table('evaluation_sessions')
                    ->where('semester_id','=',$semester_id)
                    ->where('session_number','=',$i)
                    ->delete();
            }
        }

        $active_eval_session = Option::find(13);
        $active_eval_session->value = $request->input('session_enable');
        $active_eval_session->save();

        return redirect('admin/scheduling');
    }
}
