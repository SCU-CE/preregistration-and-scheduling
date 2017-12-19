<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Option;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EvaluationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function evaluate_lecture_modal($schedule_id){
        $active_eval_session = Option::find(13)->value;
        $semester_id = Option::find(1)->value;;
        $session_id = DB::table('evaluation_sessions')
                            ->where('semester_id','=',$semester_id)
                            ->where('session_number','=',$active_eval_session)
                            ->first()->id;

        $student = Auth::user()->student;

        $schedule_evaluation = DB::table('schedule_evaluation')
                                    ->where('session_id','=',$session_id)
                                    ->where('schedule_id','=',$schedule_id)
                                    ->where('student_id','=',$student->id)
                                    ->get();

        $public_evaluations = DB::table('schedule_evaluation')
                                    ->where('session_id','=',$session_id)
                                    ->where('schedule_id','=',$schedule_id)
                                    ->where('privacy','=','public')
                                    ->join('evaluation_votes','schedule_evaluation.id','=','evaluation_votes.evaluation_id')
                                    ->groupBy('schedule_evaluation.id', 'schedule_evaluation.session_id', 'schedule_evaluation.schedule_id','schedule_evaluation.privacy','schedule_evaluation.suggested_weekday_1','schedule_evaluation.suggested_start_time_1','schedule_evaluation.suggested_end_time_1','schedule_evaluation.suggestion_reason_1','schedule_evaluation.suggested_weekday_2','schedule_evaluation.suggested_start_time_2','schedule_evaluation.suggested_end_time_2','schedule_evaluation.suggestion_reason_2','schedule_evaluation.suggested_exam_date','schedule_evaluation.suggested_exam_time','schedule_evaluation.exam_suggestion_reason')
                                    ->select(DB::raw('schedule_evaluation.id, schedule_evaluation.session_id, schedule_evaluation.schedule_id, schedule_evaluation.privacy, schedule_evaluation.suggested_weekday_1, schedule_evaluation.suggested_start_time_1, schedule_evaluation.suggested_end_time_1, schedule_evaluation.suggestion_reason_1, schedule_evaluation.suggested_weekday_2, schedule_evaluation.suggested_start_time_2, schedule_evaluation.suggested_end_time_2, schedule_evaluation.suggestion_reason_2, schedule_evaluation.suggested_exam_date, schedule_evaluation.suggested_exam_time, schedule_evaluation.exam_suggestion_reason, count(*) as votes'))
                                    ->orderBy('votes','desc')
                                    ->get();

        $public_evaluations_notvoted = DB::table('schedule_evaluation')
                                            ->where('session_id','=',$session_id)
                                            ->where('schedule_id','=',$schedule_id)
                                            ->where('privacy','=','public')
                                            ->whereNotIn('id', $public_evaluations->pluck('id'))
                                            ->get();

        $public_evaluations = $public_evaluations->merge($public_evaluations_notvoted);

        $schedule = DB::table('course_schedule')->find($schedule_id);
        $course = Course::find($schedule->course_id);
        $instructor = Instructor::find($schedule->instructor_id);

        return view('components.evaluate-lecture-modal', compact('schedule_evaluation', 'schedule', 'course', 'instructor', 'public_evaluations', 'public_evaluations_notvoted', 'student'));
    }
    public function evaluation_upvote($evaluation_id, $value)
    {
        $student = Auth::user()->student;

        $record_exist = DB::table('evaluation_votes')
                            ->where('evaluation_id','=',$evaluation_id)
                            ->where('student_id','=',$student->id)
                            ->count() > 0;
        if($record_exist){
            if($value == '0'){
                DB::table('evaluation_votes')
                    ->where('evaluation_id','=',$evaluation_id)
                    ->where('student_id','=',$student->id)
                    ->delete();
            }
            DB::table('evaluation_votes')
                ->where('evaluation_id','=',$evaluation_id)
                ->where('student_id','=',$student->id)
                ->update([
                    'vote' => 1,
                    'updated_at' => Carbon::now()
                ]);
        }else{
            DB::table('evaluation_votes')
                ->insert([
                    'evaluation_id' => $evaluation_id,
                    'student_id' => $student->id,
                    'vote' => 1,
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now()
                ]);
        }

        $upvotes = DB::table('evaluation_votes')
            ->where('evaluation_id','=',$evaluation_id)
            ->where('vote','=',1)
            ->count();

        $downvotes = DB::table('evaluation_votes')
            ->where('evaluation_id','=',$evaluation_id)
            ->where('vote','=',-1)
            ->count();

        return [$upvotes, -$downvotes];
    }
    public function evaluation_downvote($evaluation_id, $value)
    {
        $student = Auth::user()->student;

        $record_exist = DB::table('evaluation_votes')
                            ->where('evaluation_id','=',$evaluation_id)
                            ->where('student_id','=',$student->id)
                            ->count() > 0;

        if($record_exist){
            if($value == '0'){
                DB::table('evaluation_votes')
                    ->where('evaluation_id','=',$evaluation_id)
                    ->where('student_id','=',$student->id)
                    ->delete();
            }
            DB::table('evaluation_votes')
                ->where('evaluation_id','=',$evaluation_id)
                ->where('student_id','=',$student->id)
                ->update([
                    'vote' => -1,
                    'updated_at' => Carbon::now()
                ]);
        }else{
            DB::table('evaluation_votes')
                ->insert([
                    'evaluation_id' => $evaluation_id,
                    'student_id' => $student->id,
                    'vote' => -1,
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now()
                ]);
        }

        $upvotes = DB::table('evaluation_votes')
            ->where('evaluation_id','=',$evaluation_id)
            ->where('vote','=',1)
            ->count();

        $downvotes = DB::table('evaluation_votes')
            ->where('evaluation_id','=',$evaluation_id)
            ->where('vote','=',-1)
            ->count();

        return [$upvotes, -$downvotes];
    }
    public function store(Request $request)
    {
        // TODO validation
        $active_eval_session = Option::find(13)->value;
        $semester_id = Option::find(1)->value;;
        $session_id = DB::table('evaluation_sessions')
            ->where('semester_id','=',$semester_id)
            ->where('session_number','=',$active_eval_session)
            ->first()->id;

        $student = Auth::user()->student;

        DB::table('schedule_evaluation')
            ->insert([
                'session_id' => $session_id,
                'schedule_id' => $request->input('schedule_id'),
                'student_id' => $student->id,
                'privacy' => $request->input('privacy'),
                'suggested_weekday_1' => $request->input('suggested_weekday_1'),
                'suggested_start_time_1' => $request->input('suggested_start_time_1'),
                'suggested_end_time_1' => $request->input('suggested_end_time_1'),
                'suggestion_reason_1' => $request->input('suggestion_reason_1'),
                'suggested_weekday_2' => $request->input('suggested_weekday_2'),
                'suggested_start_time_2' => $request->input('suggested_start_time_2'),
                'suggested_end_time_2' => $request->input('suggested_end_time_2'),
                'suggestion_reason_2' => $request->input('suggestion_reason_2'),
                'suggested_exam_date' => $request->input('suggested_exam_date'),
                'suggested_exam_date_unix' => $request->input('suggested_exam_date_unix'),
                'suggested_exam_time' => $request->input('suggested_exam_time'),
                'exam_suggestion_reason' => $request->input('exam_suggestion_reason'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

        $schedule = DB::table('course_schedule')->find($request->input('schedule_id'));
        $course = Course::find($schedule->course_id);

        Session::flash('message', 'درخواست شما برای درس "' . $course->name . '" با موفقیت در سامانه ثبت شد.');
        Session::flash('message_color', 'green');

        return redirect('student/evaluate-schedule');

    }
    public function update(Request $request, $id)
    {
        // TODO validation
        $active_eval_session = Option::find(13)->value;
        $semester_id = Option::find(1)->value;;
        $session_id = DB::table('evaluation_sessions')
            ->where('semester_id','=',$semester_id)
            ->where('session_number','=',$active_eval_session)
            ->first()->id;

        $student = Auth::user()->student;

        DB::table('schedule_evaluation')
            ->where('id', $id)
            ->update([
                'session_id' => $session_id,
                'schedule_id' => $request->input('schedule_id'),
                'student_id' => $student->id,
                'privacy' => $request->input('privacy'),
                'suggested_weekday_1' => $request->input('suggested_weekday_1'),
                'suggested_start_time_1' => $request->input('suggested_start_time_1'),
                'suggested_end_time_1' => $request->input('suggested_end_time_1'),
                'suggestion_reason_1' => $request->input('suggestion_reason_1'),
                'suggested_weekday_2' => $request->input('suggested_weekday_2'),
                'suggested_start_time_2' => $request->input('suggested_start_time_2'),
                'suggested_end_time_2' => $request->input('suggested_end_time_2'),
                'suggestion_reason_2' => $request->input('suggestion_reason_2'),
                'suggested_exam_date' => $request->input('suggested_exam_date'),
                'suggested_exam_date_unix' => $request->input('suggested_exam_date_unix'),
                'suggested_exam_time' => $request->input('suggested_exam_time'),
                'exam_suggestion_reason' => $request->input('exam_suggestion_reason'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

        DB::table('evaluation_votes')
            ->where('evaluation_id',$id)
            ->delete();

        $schedule = DB::table('course_schedule')->find($request->input('schedule_id'));
        $course = Course::find($schedule->course_id);

        Session::flash('message', 'درخواست شما برای درس "' . $course->name . '" با موفقیت به روز رسانی شد.');
        Session::flash('message_color', 'teal');

        return redirect('student/evaluate-schedule');
    }
    public function destroy($id)
    {
        $schedule_evaluation = DB::table('schedule_evaluation')->find($id);
        $schedule = DB::table('course_schedule')->find($schedule_evaluation->schedule_id);
        $course = Course::find($schedule->course_id);

        DB::table('schedule_evaluation')->where('id', $id)->delete();

        Session::flash('message', 'درخواست شما برای درس "' . $course->name . '" با موفقیت از سامانه حذف شد.');
        Session::flash('message_color', 'orange');

        return redirect('student/evaluate-schedule');
    }
}
