<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
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
        $courses = Course::all();
        return view('partials.courseTable', ['courses', $courses]);
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

    ////////////////////////////////////////

    public function coursesTable(Request $request)
    {
        $sortBy = $request->input('sortBy');
        $sortType = $request->input('sortType');

        $sortBys = ['name', 'code', 'units', 'category'];
        $sortTypes = ['asc', 'desc'];

        if(in_array($sortBy, $sortBys) && in_array($sortType, $sortTypes))
        {
            if($sortType == 'asc'){
                $courses = Course::all()->sortBy($sortBy);
            }else{
                $courses = Course::all()->sortByDesc($sortBy);
            }
            return view('partials.courseTable', ['courses' => $courses]);
        }

        $courses = Course::all()->sortByDesc('category');
        if($courses->count() > 0){
            return view('partials.courseTable', ['courses' => $courses]);
        }else{
            return '';
        }

    }

    ////////////////////////////////////////

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categories = ['درس پایه', 'درس اصلی', 'درس اختیاری', 'آزمایشگاه'];

        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|numeric',
            'units' => 'required|numeric|digits:1',
            'default_min_capacity_fall' => 'required|numeric',
            'default_min_capacity_spring' => 'required|numeric',
            'category' => 'required|in:' . implode(',', $categories)
        ]);
/*
        $code = str_replace(
            array('0','1','2','3','4','5','6','7','8','9'),
            array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'),
            $request->input('code')
        );
*/
        $course = Course::create([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'units' => $request->input('units'),
            'default_min_capacity_fall' => $request->input('default_min_capacity_fall'),
            'default_min_capacity_spring' => $request->input('default_min_capacity_spring'),
            'category' => $request->input('category')
        ]);

        return redirect()->action('Admin\CourseController@show', ['id' => $course->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        return view('partials.courseTableRow', ['course' => $course]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        return view('partials.editCourseRow', ['course' => $course]);
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
        $categories = ['درس پایه', 'درس اصلی', 'درس اختیاری', 'آزمایشگاه'];

        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|numeric',
            'units' => 'required|numeric|digits:1',
            'default_min_capacity_fall' => 'required|numeric',
            'default_min_capacity_spring' => 'required|numeric',
            'category' => 'required|in:' . implode(',', $categories)
        ]);
/*
        $code = str_replace(
            array('0','1','2','3','4','5','6','7','8','9'),
            array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'),
            $request->input('code')
        );
*/
        $course = Course::find($id);

        $course->name = $request->input('name');
        $course->code = $request->input('code');
        $course->units = $request->input('units');
        $course->default_min_capacity_fall = $request->input('default_min_capacity_fall');
        $course->default_min_capacity_spring = $request->input('default_min_capacity_spring');
        $course->category = $request->input('category');

        $course->save();

        // why it doesn't work and cause a lot of patch request with 302 error (?)
        // return redirect()->action('Admin\CourseController@show', ['id' => $course->id]);

        return view('partials.courseTableRow', ['course' => $course]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
    }

    ////////////////////////////////////////////////////////////////////////////

    public function updateMinCapacity(Request $request, $semester_id, $course_id)
    {
        $this->validate($request, [
            'min_capacity' => 'required|numeric'
        ]);

        $semester = Semester::find($semester_id);
        $course = Course::find($course_id);

        DB::table('course_semester')->where('semester_id', $semester->id)->where('course_id', $course->id)->update(['min_capacity' => $request->input('min_capacity')]);
    }
}
