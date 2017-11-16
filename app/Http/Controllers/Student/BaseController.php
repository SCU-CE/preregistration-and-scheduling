<?php

namespace App\Http\Controllers\Student;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $currentStep = '1st';
        return view('student.home', compact('currentStep'));
    }
}
