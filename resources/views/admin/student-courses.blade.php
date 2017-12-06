@extends('layouts.admin')
@section('content')
    <div id="p_admin_student_courses">
        <div class="ui blue segment">
            <div class="ui breadcrumb">
                <a class="section fw-300" href="{{url('admin/students')}}">دانشجو ها</a>
                <i class="left chevron icon divider"></i>
                <div class="active section fw-300">
                    <span>{{$student->first_name . ' ' . $student->last_name . ' (' . $student->student_id . ')'}}</span>
                </div>
            </div>
        </div>
        <div class="ui segment">
            @if($has_course)
                <div class="ui top attached tabular menu">
                    @foreach($semesters as $semester)
                        <a class="item{{ $loop->first ? ' active' : '' }}" data-tab="{{ $semester->id }}">{{ $semester->semester . ' ' . $semester->year}}</a>
                    @endforeach
                    @if($has_passed_course)
                            <a class="item{{ $has_only_passed_courses ? ' active' : '' }}" data-tab="passed">گذرانده شده</a>
                    @endif
                </div>
                @foreach($semesters as $semester)
                    <div class="ui bottom attached tab segment{{ $loop->first ? ' active' : '' }}" data-tab="{{ $semester->id }}">
                        <?php
                        $courses = DB::table('course_student')
                                        ->where('semester_id', '=', $semester->id)
                                        ->where('student_id', '=', $student->id)
                                        ->join('courses', 'course_student.course_id', '=', 'courses.id')
                                        ->select('courses.code', 'courses.name', 'courses.units', 'courses.category')
                                        ->orderBy('category', 'desc')
                                        ->get();
                        $total_units = 0;
                        ?>
                        <table class="ui striped celled padded center aligned table">
                            <thead>
                            <tr>
                                <th>نام درس</th>
                                <th>کد درس</th>
                                <th>تعداد واحد</th>
                                <th>دسته‌بندی</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->code }}</td>
                                    <td>{{ $course->units }}</td>
                                    <td>{{ $course->category }}</td>
                                </tr>
                                <?php $total_units += $course->units; ?>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>
                                    <span>{{ $total_units }} = جمع واحدها</span>
                                </th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                @endforeach
                @if($has_passed_course)
                    <div class="ui bottom attached tab segment{{ $has_only_passed_courses ? ' active' : '' }}" data-tab="passed">
                        <?php
                        $courses = DB::table('course_student')
                                        ->where('semester_id', '=', '1')
                                        ->where('student_id', '=', $student->id)
                                        ->join('courses', 'course_student.course_id', '=', 'courses.id')
                                        ->select('courses.code', 'courses.name', 'courses.units', 'courses.category')
                                        ->orderBy('category', 'desc')
                                        ->get();
                        $total_units = 0;
                        ?>
                        <table class="ui striped celled padded center aligned table">
                            <thead>
                            <tr>
                                <th>نام درس</th>
                                <th>کد درس</th>
                                <th>تعداد واحد</th>
                                <th>دسته‌بندی</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->code }}</td>
                                    <td>{{ $course->units }}</td>
                                    <td>{{ $course->category }}</td>
                                </tr>
                                <?php $total_units += $course->units; ?>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>
                                    <span>{{ $total_units }} = جمع واحدها</span>
                                </th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                @endif
            @else
            <h3 class="ui center aligned red icon header">
                <i class="massive warning circle icon"></i>
                <span>این دانشجو هنوز هیچ درسی را اخذ نکرده است!</span>
            </h3>
            @endif
        </div>
        <div style="display: flow-root">
            <a href="{{url('admin/students')}}">
                <div class="ui teal right floated button fw-300">
                    <span>بازگشت</span>
                </div>
            </a>
        </div>
    </div>
@endsection