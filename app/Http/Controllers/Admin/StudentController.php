<?php

namespace App\Http\Controllers\Admin;

use App\Models\Semester;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::all();
        $users = DB::select('SELECT users.id, users.email, students.firstName, students.lastName, students.studentId, students.entryYear, students.id as sid FROM users JOIN students ON users.id = students.user_id WHERE role = \'student\'');
        return view('partials.studentTable', ['users', $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    ////////////////////////////////////////

    public function studentsTable(Request $request)
    {
        $sortBy = $request->input('sortBy');
        $sortType = $request->input('sortType');

        $sortBys = ['lastName', 'studentId', 'email', 'entryYear'];
        $sortTypes = ['asc', 'desc'];

        if(in_array($sortBy, $sortBys) && in_array($sortType, $sortTypes))
        {
            if($sortBy == 'email'){
                $sortTable = 'users';
            }else{
                $sortTable = 'students';
            }

            if($sortType == 'asc'){
                $queryString = 'SELECT users.id, users.email, students.firstName, students.lastName, students.studentId, students.entryYear, students.id as sid FROM users JOIN students ON users.id = students.user_id WHERE role = \'student\' ORDER BY ' . $sortTable . '.' . $sortBy . ' ASC';
                $users = DB::select($queryString);
            }else{
                $queryString = 'SELECT users.id, users.email, students.firstName, students.lastName, students.studentId, students.entryYear, students.id as sid FROM users JOIN students ON users.id = students.user_id WHERE role = \'student\' ORDER BY ' . $sortTable . '.' . $sortBy . ' DESC';
                $users = DB::select($queryString);
            }
            return view('partials.studentTable', ['users' => $users]);
        }

        $users = DB::select('SELECT users.id, users.email, students.firstName, students.lastName, students.studentId, students.entryYear, students.id as sid FROM users JOIN students ON users.id = students.user_id WHERE role = \'student\' ORDER BY students.entryYear DESC');
        if(count($users) > 0){
            return view('partials.studentTable', ['users' => $users]);
        }else{
            return '';
        }

    }

    ////////////////////////////////////////

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$user = User::find($id);
        $user = DB::select('SELECT users.id, users.email, students.firstName, students.lastName, students.studentId, students.entryYear, students.id as sid FROM users JOIN students ON users.id = students.user_id WHERE role = \'student\' AND id=', [$id]);
        return view('partials.studentTableRow', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    ///////////////////////////////////////

    public function showCourses($student_id){
        $semesters = DB::table('course_student')->where('student_id', '=' ,$student_id)->where('semester_id', '!=' ,'1')
            ->join('semesters', 'course_student.semester_id', '=', 'semesters.id')
            ->select('semesters.id','semesters.semester','semesters.year')
            ->orderBy('semesters.year', 'desc')->orderBy('semesters.semester', 'desc')->distinct()->get();
        return view('partials.studentCourses', ['semesters' => $semesters, 'student_id' => $student_id]);
    }
}
