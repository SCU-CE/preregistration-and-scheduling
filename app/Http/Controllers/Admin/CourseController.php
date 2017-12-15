<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        $categories = ['درس پایه', 'درس اصلی', 'درس اختیاری', 'آزمایشگاه'];

        $validator = Validator::make($request->all(), [
            'course_name' => 'required|enfa_num|max:50',
            'course_code' => 'required|digits_between:1,20|unique:courses,code',
            'units' => 'required|digits:1',
            'default_min_capacity_fall' => 'required|digits_between:1,2',
            'default_min_capacity_spring' => 'required|digits_between:1,2',
            'category' => 'required|in:' . implode(',', $categories),
            'planned_semester' => 'required|numeric|max:8'
        ]);

        if ($validator->fails()) {
            return redirect('admin/courses')
                ->withErrors($validator, 'store')
                ->withInput();
        }

        $course = Course::create([
            'name' => $request->input('course_name'),
            'code' => $request->input('course_code'),
            'units' => $request->input('units'),
            'default_min_capacity_fall' => $request->input('default_min_capacity_fall'),
            'default_min_capacity_spring' => $request->input('default_min_capacity_spring'),
            'category' => $request->input('category'),
            'planned_semester' => $request->input('planned_semester')
        ]);

        Session::flash('message', 'درس "' . $course->name . '" با موفقیت در سامانه ثبت شد.');
        Session::flash('message_color', 'green');

        return redirect('admin/courses');
    }
    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        $categories = ['درس پایه', 'درس اصلی', 'درس اختیاری', 'آزمایشگاه'];
        $validator = Validator::make($request->all(), [
            'course_name' => 'required|enfa_num|max:50',
            'course_code' => 'required|digits_between:1,20|unique:courses,code,'.$course->id,
            'units' => 'required|digits:1',
            'default_min_capacity_fall' => 'required|digits_between:1,2',
            'default_min_capacity_spring' => 'required|digits_between:1,2',
            'category' => 'required|in:' . implode(',', $categories),
            'planned_semester' => 'required|numeric|max:8'
        ]);

        if ($validator->fails()) {
            return redirect('admin/courses')
                ->withErrors($validator, 'update')
                ->withInput()
                ->with('course_id', $course->id);
        }

        $old_name = $course->name;

        $course->name = $request->input('course_name');
        $course->code = $request->input('course_code');
        $course->units = $request->input('units');
        $course->default_min_capacity_fall = $request->input('default_min_capacity_fall');
        $course->default_min_capacity_spring = $request->input('default_min_capacity_spring');
        $course->category = $request->input('category');
        $course->planned_semester = $request->input('planned_semester');

        $course->save();

        Session::flash('message', 'درس "' . $old_name . '" با موفقیت به روز رسانی شد.');
        Session::flash('message_color', 'teal');

        return redirect('admin/courses');
    }
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();

        Session::flash('message', 'درس "' . $course->name . '" با موفقیت از سامانه حذف شد.');
        Session::flash('message_color', 'orange');

        return redirect('admin/courses');
    }
}
