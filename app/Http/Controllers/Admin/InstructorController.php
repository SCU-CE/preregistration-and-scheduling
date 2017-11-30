<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InstructorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $sexes = ['مرد', 'زن'];
        $validator = Validator::make($request->all(), [
            'instructor_name' => 'required|enfa_num|max:100',
            'sex' => 'required|in:' . implode(',', $sexes),
            'profile_link' => 'nullable|url',
            'photo' => 'nullable|file|image'
        ]);

        if ($validator->fails()) {
            return redirect('admin/instructors')
                ->withErrors($validator, 'store')
                ->withInput();
        }

        $photo = null;
        if($request->file('photo') != null){
            $photo = $request->file('photo')->storeAs('instructor_photos', uniqid('img_') . '.jpg', 'public');
        }

        $instructor = Instructor::create([
            'name' => $request->input('instructor_name'),
            'sex' => $request->input('sex'),
            'link' => $request->input('profile_link') == 'http://engg.scu.ac.ir/' ? null : $request->input('profile_link'),
            'photo' => $photo
        ]);

        Session::flash('message', 'استاد "' . $instructor->name . '" با موفقیت در سامانه ثبت شد.');
        Session::flash('message_color', 'green');

        return redirect('admin/instructors');
    }

    public function update(Request $request, $id)
    {
        $instructor = Instructor::find($id);

        $sexes = ['مرد', 'زن'];
        $validator = Validator::make($request->all(), [
            'instructor_name' => 'required|enfa_num|max:100',
            'sex' => 'required|in:' . implode(',', $sexes),
            'profile_link' => 'nullable|url',
            'photo' => 'nullable|file|image'
        ]);

        if ($validator->fails()) {
            return redirect('admin/instructors')
                ->withErrors($validator, 'update')
                ->withInput()
                ->with('instructor_id', $instructor->id);
        }

        $instructor->name = $request->input('instructor_name');
        $instructor->sex = $request->input('sex');
        $instructor->link = $request->input('profile_link') == 'http://engg.scu.ac.ir/' ? null : $request->input('profile_link');

        if($request->file('photo') != null){
            $path_name = explode('/', $instructor->photo);
            $request->file('photo')->storeAs($path_name[0],$path_name[1],'public');
        }

        $instructor->save();

        Session::flash('message', 'استاد "' . $instructor->name . '" با موفقیت به روز رسانی شد.');
        Session::flash('message_color', 'teal');

        return redirect('admin/instructors');
    }

    public function destroy($id)
    {
        $instructor = Instructor::find($id);
        if($instructor->photo != null) {
            Storage::delete('public/' . $instructor->photo);
        }
        $instructor->delete();

        Session::flash('message', 'استاد "' . $instructor->name . '" با موفقیت از سامانه حذف شد.');
        Session::flash('message_color', 'orange');

        return redirect('admin/instructors');
    }
}
