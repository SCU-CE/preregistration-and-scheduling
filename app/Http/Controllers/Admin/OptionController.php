<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
