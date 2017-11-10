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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeOptions(Request $request)
    {
        $this->validate($request, [
            'current_semester' => 'required|numeric',
            'min_entry_year' => 'required|numeric|digits:4',
            'max_entry_year' => 'required|numeric|digits:4',
            'max_register_units' => 'required|numeric',
        ]);

        $current_semester = Option::find(1);
        $current_semester->value = $request->input('current_semester');
        $current_semester->save();

        $min_entry_year = Option::find(2);
        $min_entry_year->value = $request->input('min_entry_year');
        $min_entry_year->save();

        $max_entry_year = Option::find(3);
        $max_entry_year->value = $request->input('max_entry_year');
        $max_entry_year->save();

        $max_entry_year = Option::find(4);
        $max_entry_year->value = $request->input('max_register_units');
        $max_entry_year->save();
    }

    public function changeAdminPassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|valid_pass',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return 'تغییر رمز عبور با موفقیت انجام شد.';
    }

    public function registerNewAdmin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $admin = User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'admin',
            'lastVisitedTime' => Carbon::now()
        ]);

        return view('partials.registeredAdminRow', ['admin' => $admin]);
    }

    public function unregisterAdmin($id)
    {
        $admin_count = User::where('role','=','admin')->count();
        if($admin_count < 2) abort(403);
        $admin = User::find($id);
        if($admin->email == Auth::user()->email) abort(403);
        $admin->delete();
    }
}
