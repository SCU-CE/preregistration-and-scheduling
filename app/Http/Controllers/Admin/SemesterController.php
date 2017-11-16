<?php

namespace App\Http\Controllers\Admin;

use App\Models\Semester;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
}
