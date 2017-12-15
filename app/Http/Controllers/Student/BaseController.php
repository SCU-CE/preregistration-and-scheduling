<?php

namespace App\Http\Controllers\Student;

use App\Models\Instructor;
use App\Models\Option;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function passed_courses ()
    {
        $currentStep = '1st';
        $has_category = [];
        $courses_by_category = [];
        $student = Auth::user()->student;

        $categories = ['درس پایه', 'درس اصلی', 'درس اختیاری', 'آزمایشگاه'];
        for($i = 0; $i<count($categories); $i++){
            $has_category[$i] = DB::table('courses')->where('category', $categories[$i])->count() > 0;
            $courses_by_category[$i] = DB::table('courses')->where('category', $categories[$i])->get();
        }
        return view('student.passed-courses', compact('currentStep', 'has_category', 'courses_by_category', 'student'));
    }
    public function semester_courses ()
    {
        $currentStep = '1st';
        $student = Auth::user()->student;
        $current_semester = Semester::find(Option::find(1)->value);
        $passed_all_courses = $current_semester->courses()
                                    ->join('course_student', 'courses.id', '=', 'course_student.course_id')
                                    ->select('courses.id','course_student.student_id','course_student.semester_id')
                                    ->where('course_student.student_id', $student->id)
                                    ->where('course_student.semester_id', 1)->count() == $current_semester->courses()->count();

        $units_by_category = [];
        $sum_of_units = 0;
        $max_units = Option::find(4)->value;
        $category_has_courses = [];
        $courses_by_category = [];
        $categories = ['درس پایه', 'درس اصلی', 'درس اختیاری', 'آزمایشگاه'];
        for($i = 0; $i<count($categories); $i++){
            $units_by_category[$i] = DB::table('course_student')->where('student_id', $student->id)
                                                                ->where('semester_id', $current_semester->id)
                                                                ->join('courses', 'course_student.course_id', '=', 'courses.id')
                                                                ->select('courses.units', 'courses.category')
                                                                ->where('category', '=', $categories[$i])
                                                                ->sum('courses.units');
            $sum_of_units += $units_by_category[$i];
            $category_has_courses[$i] = $current_semester->courses()->where('category', '=', $categories[$i])
                                                                    ->join('course_student', 'courses.id', '=', 'course_student.course_id')
                                                                    ->select('courses.id','course_student.student_id','course_student.semester_id')
                                                                    ->where('course_student.student_id', $student->id)
                                                                    ->where('course_student.semester_id', 1)
                                                                    ->count() != $current_semester->courses()->where('category', '=', $categories[$i])->count();
            $courses_by_category[$i] = $current_semester->courses()->where('category', '=', $categories[$i])->get();
        }

        return view('student.semester-courses', compact('currentStep', 'current_semester', 'student', 'passed_all_courses', 'units_by_category', 'sum_of_units', 'max_units', 'category_has_courses', 'courses_by_category'));
    }
    public function instructor_suggestion ()
    {
        $currentStep = '1st';
        $student = Auth::user()->student;
        $semester = Semester::find(Option::find(1)->value);
        $student_courses = DB::table('course_student')
                                ->where('student_id','=',$student->id)
                                ->where('semester_id','=',$semester->id)
                                ->join('courses','course_student.course_id','=','courses.id')
                                ->where('courses.category','!=','درس پایه')
                                ->orderBy('courses.category','desc')
                                ->get();
        $semester_courses = DB::table('course_semester')
                                ->where('semester_id','=',$semester->id)
                                ->whereNotIn('course_id',$student_courses->pluck('course_id'))
                                ->join('courses','course_semester.course_id','=','courses.id')
                                ->where('courses.category','!=','درس پایه')
                                ->orderBy('courses.category','desc')
                                ->get();
        $instructors = Instructor::all();

        return view('student.instructor-suggestion', compact('currentStep','student', 'semester','student_courses','semester_courses','instructors'));
    }
    public function evaluate ()
    {
        $currentStep = '1st';
        return view('student.evaluate', compact('currentStep'));
    }
    public function final_schedule ()
    {
        $currentStep = '1st';
        return view('student.final-schedule', compact('currentStep'));
    }
    public function coursesReport()
    {
        $ts = microtime();
        $currentSemester = Semester::current();
        $courseReport = $currentSemester
            ->registrations()
            ->join('courses', 'course_id', '=', 'courses.id')
            ->groupby('courses.code', 'courses.name')
            ->select(DB::raw('courses.name,courses.code ,count(*) as count'))
            ->orderby('count','desc')
            ->get()->toArray();
        $header = ['عنوان درس','کد درس','تعداد ثبت نامی'];
        $ts = microtime() - $ts;
        $message = "زمان اجرا: $ts ثانیه";
        return view('admin.tablereport',['data'=>$courseReport,'header'=>$header,'indexed'=>true,'message'=>$message]);
    }
    public function mutualCourseConflicts()
    {
        $ts = microtime();
        $data = [];
        $currentCourses = Semester::current()->courses()->get();
        foreach($currentCourses as $c1)
        {
            $row = ['name'=>$c1->name, 'code'=>$c1->code, 'students'=>[]];
            foreach($c1->students()->get() as $st)
                $row['students'][] = $st->id;
            $courseRegistrations[] = $row;

        }

        $counts = [];
        foreach($courseRegistrations as $reg1)
            foreach($courseRegistrations as $reg2)
            {
                if($reg1['code']!=$reg2['code']) {
                    $c = count(array_intersect($reg1['students'],$reg2['students']));
                    if($c)
                    {
                        $data[] = [$reg1['name'], $reg2['name'],$c];
                        $counts[] = $c;
                    }
                }
            }
        array_multisort($counts,SORT_DESC,$data);
        $header = ['درس 1','درس 2', 'تعداد تداخل'];
        $ts = microtime() - $ts;
        $message = "زمان اجرا: $ts ثانیه";
        return view('admin.tablereport',['data'=>$data,'header'=>$header,'indexed'=>true,'message'=>$message]);
    }
    public function courseConflicts(Request $request)
    {

        if($request['course']==null) {
            $allcourses = Semester::current()->courses()->get();
            return view('admin.courseconflicts', ['courses' => $allcourses, 'message' => '']);
        }
    }
    public function courseConflictsResult(Request $request)
    {
        $ts = microtime();
        $course = Course::find($request['course']);
        $courseReg = array_column($course->students()->get()->toArray(),'studentId');
        //var_dump($courseReg);
        $courses = Semester::current()
            ->courses()
            ->where('course_id','!=',$course->id)
            ->get();

        $coursesReg = [];
        $counts = [];
        foreach($courses as $crs)
        {
            $reg = array_column($crs->students()->get()->toArray(),'studentId');
            //var_dump($reg);
            //var_dump(array_intersect($courseReg,$reg));
            $interCount = count(array_intersect($courseReg,$reg));
            if($interCount>0){
                $row = ['name'=>$crs->name,
                    'code'=>$crs->code,
                    'count'=>$interCount];
                $coursesReg[] = $row;
                $counts[] = $interCount;
            }
        }

        array_multisort($counts,SORT_DESC,$coursesReg);

        $header = ['نام درس','کد درس', 'تعداد تداخل'];
        $ts = microtime() - $ts;
        $message = "زمان اجرا: $ts ثانیه";
        $allcourses = Semester::current()->courses()->get();

        return view('admin.courseconflicts',
            ['courses'=>$allcourses,
                'data'=>$coursesReg,
                'header'=>$header,
                'indexed'=>true,
                'message'=>$message,
                'courseid'=>$course->id
            ]);
    }
    public function courseIntersectionView()
    {
        $allcourses = Semester::current()->courses()->get();
        return view('admin.courseintersection', ['courses' => $allcourses,
            'message' => ''
            ,'course1'=>'',
            'course2'=>'',
            'course3'=>'',
            'course4'=>'',
        ]);
    }
    public function courseIntersection(Request $request)
    {
        $ts = microtime();

        if( $request['course1'] != "")
        {
            $students = array_column(Semester::current()->registrations()->where('course_id','=',$request['course1'])->get()->toArray(),'student_id');
            //echo "ddddddddddddddddddddddddddddd1";
        }

        if( $request['course2'] != "")
        {

            $newStudents = array_column(Semester::current()->registrations()->where('course_id','=',$request['course2'])->get()->toArray(),'student_id');
            if(!isset($students))
                $students = $newStudents;
            else
            {
                $students = array_intersect($students,$newStudents);
            }
        }
        if( $request['course3'] != "")
        {
            $newStudents = array_column(Semester::current()->registrations()->where('course_id','=',$request['course3'])->get()->toArray(),'student_id');
            if(!isset($students))
                $students = $newStudents;
            else
            {
                $students = array_intersect($students,$newStudents);
            }
        }
        if( $request['course4'] != "")
        {
            $newStudents = array_column(Semester::current()->registrations()->where('course_id','=',$request['course4'])->get()->toArray(),'student_id');
            if(!isset($students))
                $students = $newStudents;
            else
            {
                $students = array_intersect($students,$newStudents);
            }
        }
        //var_dump($students);
        if(isset($students))
            $students = Student::whereIn('id',$students)->select('studentId','firstname','lastname')->get()->toArray();
        else
            $students = [];


        $ts = microtime() - $ts;
        $message = "زمان اجرا: $ts ثانیه";
        $allcourses = Semester::current()->courses()->get();
        $header = ['شماره دانشجویی','نام', 'نام خانوادگی'];
        return view('admin.courseintersection',
            ['data'=>$students,
                'header'=>$header,
                'indexed'=>true,
                'message'=>$message,
                'courses'=>$allcourses,
                'course1'=>$request['course1'],
                'course2'=>$request['course2'],
                'course3'=>$request['course3'],
                'course4'=>$request['course4'],
            ]);

    }
    public function runSQLForm()
    {
        $sqls = SQL::all()->toArray();
        return view('admin.runsql',['storedSQLs'=>$sqls]);

    }
    public function runSQL(Request $request)
    {
        $sqls = SQL::all()->toArray();
        if($request['action']=='run')
        {
            try {
                $result = DB::select($request['statement']);
                $header = [];
                foreach(get_object_vars($result[0]) as $k=>$v)
                    $header[] = $k;
                return view('admin.runsql',
                    ['header' => [],
                        'data' => $result,
                        'statement' => $request['statement'],
                        'header'=>$header,
                        'storedSQLs'=>$sqls
                    ]);
            }
            catch(\Exception $e)
            {
                $message = $e->getMessage();
                return view('admin.runsql', ['statement' => $request['statement'],'message'=>$message,'storedSQLs'=>$sqls]);
            }
        }
        elseif($request['action']=='save')
        {
            //var_dump($request);
            $stmt = new SQL;
            $stmt->name = $request['name'];
            $stmt->statement = $request['statement'];
            $stmt->menu_id = 0;
            $stmt->save();
            $message = "دستور sql  فوق ذخیره گردید";
            return view('admin.runsql', ['statement' => $request['statement'],'message'=>$message,'storedSQLs'=>$sqls]);
        }
        else
        {
            echo "what?";
        }
    }
}
