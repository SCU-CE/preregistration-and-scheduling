<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Feedback;
use App\Models\Instructor;
use App\Models\Semester;
use App\Models\Student;
use App\Models\User;
use App\Models\Option;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class BaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('admin.home');
    }

    public function courses()
    {
        // get query parameters
        $sortby = Input::get('sortby','category');
        $order = Input::get('order','desc');

        // validate query paramaters
        $valid_sortby_columns = ['name', 'code', 'units', 'default_min_capacity_fall', 'default_min_capacity_spring', 'category'];
        if(!in_array($sortby, $valid_sortby_columns))
            $sortby = 'category';

        // retrieve courses based on it
        if($order == 'asc'){
            $courses = Course::all()->sortBy($sortby);
        }else{
            $courses = Course::all()->sortByDesc($sortby);
        }

        // return view with courses
        return view('admin.courses', compact('courses'));
    }

    public function instructors()
    {
        $instructors = Instructor::all()->sortBy('name');

        // return view with courses
        return view('admin.instructors', compact('instructors'));
    }

    public function semesters()
    {

    }
}
