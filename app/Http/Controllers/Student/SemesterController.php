<?php

namespace App\Http\Controllers\Student;

use App\Models\Option;
use App\Models\Semester;
use App\Models\Course;
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
}
