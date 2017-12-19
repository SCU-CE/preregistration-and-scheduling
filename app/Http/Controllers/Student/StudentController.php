<?php

namespace App\Http\Controllers\Student;

use App\Models\Option;
use App\Models\Student;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit_information()
    {
        $min_entry_year = Option::find(2)->value;
        $max_entry_year = Option::find(3)->value;
        $currentStep = Option::find(5)->value;
        $user = Auth::user();
        $student = Auth::user()->student;
        return view('student.edit-information', compact('currentStep', 'student', 'user', 'min_entry_year', 'max_entry_year'));
    }
    public function update_information(Request $request)
    {
        $user = Auth::user();
        $student = Auth::user()->student();

        $this->validate($request, [
            'first_name' => 'required|max:255|persian',
            'last_name' => 'required|max:255|persian',
            'student_id' => 'required|digits:7|unique:students,student_id,'.$student->first()->id,
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'entry_year' => 'required|digits:4',
            'password' => 'required|valid_pass'
        ]);

        $user->email = $request->input('email');
        $user->save();

        $student->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'student_id' => $request->input('student_id'),
            'entry_year' => $request->input('entry_year'),
        ]);

        Session::flash('message', 'اطلاعات شما با موفقیت به روز رسانی شدند.');
        Session::flash('message_color', 'teal');

        return redirect('student/edit-information');
    }
    public function change_password()
    {
        $currentStep = Option::find(5)->value;
        return view('student.change-password', compact('currentStep'));
    }
    public function update_password(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'old_password' => 'required|valid_pass',
            'password' => 'required|min:6|confirmed'
        ]);

        $user->password = bcrypt($request->input('password'));
        $user->save();

        Session::flash('message', 'رمز عبور شما با موفقیت به روز رسانی شد.');
        Session::flash('message_color', 'teal');

        return redirect('student/change-password');
    }
}
