<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store_options(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_semester' => 'required|numeric',
            'min_entry_year' => 'required|numeric|digits:4',
            'max_entry_year' => 'required|numeric|digits:4',
            'max_register_units' => 'required|numeric',
            'process_stage' => 'required|in:disable,1st,2nd,3rd'
        ]);
        if ($validator->fails()) {
            return redirect('admin/settings')
                ->withErrors($validator, 'semester_options')
                ->withInput();
        }
        $options = [
            [
                'id' => '1',
                'name' => 'current_semester'
            ],
            [
                'id' => '2',
                'name' => 'min_entry_year'
            ],
            [
                'id' => '3',
                'name' => 'max_entry_year'
            ],
            [
                'id' => '4',
                'name' => 'max_register_units'
            ],
            [
                'id' => '5',
                'name' => 'process_stage'
            ],
            [
                'id' => '7',
                'name' => 'prereg_start_date'
            ],
            [
                'id' => '8',
                'name' => 'prereg_end_date'
            ],
            [
                'id' => '9',
                'name' => 'eval_start_date'
            ],
            [
                'id' => '10',
                'name' => 'eval_end_date'
            ],
            [
                'id' => '11',
                'name' => 'final_date'
            ],
        ];
        foreach ($options as $option){
            $row = Option::find($option['id']);
            $value = $request->input($option['name']) == null ? '' : $request->input($option['name']);
            $row->value = $value;
            $row->save();
        }
        return redirect('admin/settings');
    }
    public function change_admin_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|valid_pass',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect('admin/settings')
                ->withErrors($validator, 'change_password')
                ->withInput();
        }

        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect('admin/settings');
    }
    public function register_admin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect('admin/settings')
                ->withErrors($validator, 'register_admin')
                ->withInput();
        }

        $admin = User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'admin',
            'lastVisitedTime' => Carbon::now()
        ]);
        Session::flash('message', '"'.$admin->email.'"'.' با موفقیت در سامانه ثبت شد.');
        Session::flash('message_color', 'green');
        return redirect('admin/settings');
    }
    public function unregister_admin($id)
    {
        $admin_count = User::where('role','=','admin')->count();
        if($admin_count < 2) {
            Session::flash('message', 'سیستم باید حداقل دارای یک مدیر باشد.');
            Session::flash('message_color', 'red');
            return redirect('admin/settings');
        }
        $admin = User::find($id);
        if($admin->email == Auth::user()->email) {
            Session::flash('message', 'شما نمیتوانید خودتان را حذف کنید!');
            Session::flash('message_color', 'red');
            return redirect('admin/settings');
        }
        $email = $admin->email;
        $admin->delete();

        Session::flash('message', '"'.$email.'"'.' با موفقیت از سامانه حذف شد.');
        Session::flash('message_color', 'orange');
        return redirect('admin/settings');
    }
}
