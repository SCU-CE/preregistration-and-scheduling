<?php

namespace App\Http\Controllers\Admin;

use App\Models\Semester;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SemesterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show($id)
    {
        $semester = Semester::find($id);
        $courses = Course::all()->sortByDesc('category');
        $color = null;
        if($semester->semester == 'بهار'){
            $color = 'green';
        }else{
            $color = 'orange';
        }
        return view('admin.semester-courses',compact('semester', 'color', 'courses'));
    }
    public function store(Request $request)
    {
        $semesters = ['بهار', 'پاییز'];
        $validator = Validator::make($request->all(), [
            'semester' => 'required|in:' . implode(',', $semesters),
            'year' => 'required|numeric|digits:4',
        ]);
        if ($validator->fails()) {
            return redirect('admin/semesters')
                ->withErrors($validator, 'store')
                ->withInput();
        }

        $semester = Semester::create([
            'semester' => $request->input('semester'),
            'year' => $request->input('year'),
        ]);

        $this->offer_all_courses($semester->id);

        Session::flash('message', 'ترم "' . $semester->semester . ' ' . $semester->year . '" با موفقیت در سامانه ثبت شد.');
        Session::flash('message_color', 'green');

        return redirect('admin/semesters');
    }
    public function update(Request $request, $id)
    {
        $semester = Semester::find($id);

        $semesters = ['بهار', 'پاییز'];
        $validator = Validator::make($request->all(), [
            'semester' => 'required|in:' . implode(',', $semesters),
            'year' => 'required|numeric|digits:4',
        ]);

        if ($validator->fails()) {
            return redirect('admin/semesters')
                ->withErrors($validator, 'update')
                ->withInput()
                ->with('semester_id', $semester->id);
        }

        $old_semester = $semester->semester;
        $old_year = $semester->year;

        $semester->semester = $request->input('semester');
        $semester->year = $request->input('year');

        $semester->save();

        Session::flash('message', 'ترم "' . $old_semester . ' ' . $old_year . '" با موفقیت به روز رسانی شد.');
        Session::flash('message_color', 'teal');

        return redirect('admin/semesters');
    }
    public function destroy($id)
    {
        $semester = Semester::find($id);
        $semester->delete();

        Session::flash('message', 'ترم "' . $semester->semester . ' ' . $semester->year . '" با موفقیت از سامانه حذف شد.');
        Session::flash('message_color', 'orange');

        return redirect('admin/semesters');
    }
    public function update_courses(Request $request, $semester_id){
        // TODO validation logic
        $semester = Semester::find($semester_id);
        $syncData = array();
        foreach ($request->all() as $course){
            if($course['checked']){
                $syncData = array_add($syncData, $course['id'], ['min_capacity' => $course['min_capacity']]);
            }
        }
        $semester->courses()->sync($syncData);
    }
    public function offer_all_courses($semester_id)
    {
        $semester = Semester::find($semester_id);
        $course_ids = Course::all()->pluck('id')->toArray();
        $syncData = array();

        if($semester->semester == 'بهار'){
            for ($i = 0; $i < count($course_ids); $i++){
                if(!DB::table('course_semester')->where('semester_id','=',$semester_id)->where('course_id','=',$course_ids[$i])->exists()){
                    $syncData = array_add($syncData, $course_ids[$i], ['min_capacity' => Course::find($course_ids[$i])->default_min_capacity_spring]);
                }
            }
        }else{
            for ($i = 0; $i < count($course_ids); $i++){
                if(!DB::table('course_semester')->where('semester_id','=',$semester_id)->where('course_id','=',$course_ids[$i])->exists()) {
                    $syncData = array_add($syncData, $course_ids[$i], ['min_capacity' => Course::find($course_ids[$i])->default_min_capacity_fall]);
                }
            }
        }
        $semester->courses()->syncWithoutDetaching($syncData);
    }
}
