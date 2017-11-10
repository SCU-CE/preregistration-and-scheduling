<?php

namespace App\Http\Controllers\Student;

use App\Models\Option;
use App\Models\Student;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
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

    public function editInformationForm()
    {
        $min_entry_year = Option::find(2)->value;
        $max_entry_year = Option::find(3)->value;

        return view('student.editInfo', ['min_entry_year' => $min_entry_year, 'max_entry_year' => $max_entry_year]);
    }

    public function changePasswordForm()
    {
        return view('student.changePass');
    }

    public function editInformation(Request $request){

        $this->validate($request, [
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'studentId' => 'required|digits:7|valid_sid',
            'email' => 'required|email|max:255|valid_email',
            'entryYear' => 'required|digits:4',
            'password' => 'required|valid_pass'
        ]);

        $user = Auth::user();
        $user->email = $request->input('email');
        $user->save();

        $user->student()->update([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'studentId' => $request->input('studentId'),
            'entryYear' => $request->input('entryYear'),
        ]);

        return 'اطلاعات با موفقیت ثبت شدند.';
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'old_password' => 'required|valid_pass',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return 'تغییر رمز عبور با موفقیت انجام شد.';
    }
}
