<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            if(Auth::user()->isStudent()){
                return redirect('student/home');
            }else if(Auth::user()->isAdmin()){
                return redirect('admin/home');
            }
        }
        return redirect('/login');
    }

    public function sendFeedback(Request $request)
    {
        $this->validate($request, [
            'mtype' => 'required|in:smile,frown,heart',
            'message' => 'string|nullable'
        ]);

        $feedback = Feedback::create([
            'type' => $request->input('mtype'),
            'message' => $request->input('message'),
            'state' => 'inbox'
        ]);
    }
}
