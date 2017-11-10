<?php

namespace App\Http\Controllers\Admin;

use App\Models\Semester;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semester = Semester::all()->where('semester', '!=', 'x');
        return view('partials.courseTable', ['courses', $semester]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'semester' => 'required|max:255|in:1,2',
            'year' => 'required|numeric|digits:4',
        ]);
/*
        $year = str_replace(
            array('0','1','2','3','4','5','6','7','8','9'),
            array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'),
            $request->input('year')
        );
*/
        $semester = Semester::create([
            'semester' => $request->input('semester'),
            'year' => $request->input('year'),
        ]);

        /*
        $courses = Course::all();
        foreach ($courses as $course){
            $semester->courses()->attach($course->id);
        }
        */

        $this->offerAllCourses($semester->id);

        return redirect()->action('Admin\SemesterController@show', ['id' => $semester->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $semester = Semester::find($id);
        return view('partials.semesterTableRow', ['semester' => $semester]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $semester = Semester::find($id);
        return view('partials.editSemesterRow', ['semester' => $semester]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'semester' => 'required|max:255|in:1,2',
            'year' => 'required|numeric|digits:4',
        ]);
/*
        $year = str_replace(
            array('0','1','2','3','4','5','6','7','8','9'),
            array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'),
            $request->input('year')
        );
*/
        $semester = Semester::find($id);

        $semester->semester = $request->input('semester');
        $semester->year = $request->input('year');

        $semester->save();

        return view('partials.semesterTableRow', ['semester' => $semester]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $semester = Semester::find($id);
        $semester->delete();
    }

    /////////////////////////////////////////////////////////

    public function courses($id){
        $courses = Course::all()->sortByDesc('category');
        if (count($courses) < 1){
            return false;
        }
        $semester = Semester::find($id);
        return view('partials.semesterCoursesTable', ['courses' => $courses, 'semester' => $semester]);
    }

    public function offerCourse($semester_id, $course_id)
    {
        $semester = Semester::find($semester_id);
        $course = Course::find($course_id);

        $semester->semester == '1' ? $min_capacity = $course->default_min_capacity_spring : $min_capacity = $course->default_min_capacity_fall;

        $semester->courses()->attach($course_id, ['min_capacity' => $min_capacity]);
    }

    public function withdrawCourse($semester_id, $course_id)
    {
        // untake student courses
        DB::table('course_student')->where('semester_id', '=', $semester_id)->where('course_id', '=', $course_id)->delete();
        
        $semester = Semester::find($semester_id);
        $semester->courses()->detach($course_id);
    }

    public function offerAllCourses($semester_id)
    {
        $semester = Semester::find($semester_id);
        $course_ids = Course::all()->pluck('id')->toArray();
        $syncData = array();

        if($semester->semester == '1'){
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
        //return $syncData;
    }

    public function withdrawAllCourses($semester_id)
    {
        // untake student courses
        DB::table('course_student')->where('semester_id', '=', $semester_id)->delete();

        $semester = Semester::find($semester_id);
        $semester->courses()->sync([]);
    }
}
