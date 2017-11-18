<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Feedback;
use App\Models\Semester;
use App\Models\Student;
use App\Models\User;
use App\Models\Option;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}
