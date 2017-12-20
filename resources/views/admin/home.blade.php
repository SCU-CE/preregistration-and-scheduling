@extends('layouts.admin')

@section('content')
    <div id="p_admin_home">
        @if(in_array($currentStep,['1st','2nd','3rd']))
            @include('components.steps', [
                                            'size' => 'large',
                                            'fluid' => true,
                                            'active' => $currentStep,
                                            'dates' => [
                                                $options->find(7)->value,
                                                $options->find(8)->value,
                                                $options->find(9)->value,
                                                $options->find(10)->value,
                                                $options->find(11)->value
                                            ],
                                            'extraclasses' => ''])
        @else
            <div class="ui inverted segment center aligned grey">
                <h3>
                    <i class="warning sign big icon"></i>
                    <span class="fw-400">در حال حاضر سامانه پیش ثبت نام غیر فعال می باشد!</span>
                </h3>
            </div>
        @endif
        @if(count($recent_users)>0)
            <div class="ui segment">
            <div class="ui blue fluid large label fw-400" style="text-align: center">
                <span>آخرین افرادی که از سایت استفاده کرده اند</span>
            </div>
            @foreach($recent_users as $user)
            <div style="padding: 1rem 0 0">
                <span>
                    <i class="user teal large icon" style="margin-top: -4px"></i>
                    <span style="color: #424242">
                        <span>{{$user->student->first_name}} </span>
                        <span>{{$user->student->last_name}} </span>
                        <span class="p_number">({{$user->student->student_id}})</span>
                    </span>
                </span>
                <span style="float: left; direction: ltr; color: lightgrey">
                    1 week before
                </span>
            </div>
            @endforeach
        </div>
        @endif
        @if(count($courses)>0)
            <div class="ui segment">
                <div class="ui fluid large label fw-400{{$semester->semester == 'بهار' ? ' green' : ' orange'}}" style="text-align: center">
                    <span>وضعیت درس های ارائه شده ترم جاری </span><span>({{$semester->semester}} </span><span class="p_number">{{$semester->year}})</span>
                </div>
                <table class="ui single line table">
                    <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td style="width: 200px">
                                {{$course->name}}
                            </td>
                            <td style="width: 100px">
                                {{$course->code}}
                            </td>
                            <td>
                                <div class="ui indicating progress" data-value="{{$course->count}}" data-total="{{$course->min_capacity}}" style="margin: 0">
                                    <div class="bar">
                                        <div class="progress"></div>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 70px">
                                <i class="user teal icon"></i>
                                <span class="teal-dark" style="margin-right: -8px;">{{$course->count}}</span>
                            </td>
                            <td style="width: 200px">
                                @for($i=(int)$semester->year-1; $i>(int)$semester->year-6; $i--)
                                    <?php
                                    $student_course_count = DB::table('course_student')
                                        ->where('semester_id','=',$semester->id)
                                        ->where('course_id','=',$course->id)
                                        ->join('students','course_student.student_id','=','students.id')
                                        ->where('students.entry_year','=',$i)
                                        ->count();
                                    ?>
                                    @if($student_course_count>0)
                                        <?php
                                        $student_semester = 0;
                                        if($semester->semester == 'بهار'){
                                            $student_semester = ((int)$semester->year-$i)*2;
                                        }else{
                                            $student_semester = ((int)$semester->year-$i)*2 + 1;
                                        }
                                        ?>
                                        <div class="student symbol">
                                            <i class="student icon{{$student_semester == $course->planned_semester ? ' green' : ' grey'}}"></i>
                                            <div class="year{{$student_semester == $course->planned_semester ? ' green' : ' grey'}}">{{$i}}</div>
                                        </div>
                                        <div class="student count{{$student_semester == $course->planned_semester ? ' green-dark' : ' grey'}}">{{$student_course_count}}</div>
                                    @endif
                                @endfor
                            </td>
                            <td style="width: 220px">
                                <?php
                                $id_votes = DB::table('course_instructor')
                                    ->where('semester_id','=',$semester->id)
                                    ->where('course_id','=',$course->id)
                                    ->groupBy('instructor_id')
                                    ->select(DB::raw('instructor_id as id, count(*) as votes'))
                                    ->orderBy('votes','desc')
                                    ->take(3)
                                    ->get();
                                ?>
                                @if(count($id_votes) > 0)
                                    @if(count($id_votes) == 1)
                                        @include('components.course-instructor-status', ['instructor'=> DB::table('instructors')->find($id_votes[0]->id), 'color' => 'green', 'value' => $id_votes[0]->votes, 'max' => $id_votes[0]->votes])
                                    @elseif(count($id_votes) == 2)
                                        <?php
                                        $colo1 = 'green';
                                        $colo2 = 'yellow';
                                        if($id_votes[0]->votes == $id_votes[1]->votes){
                                            $colo2 = $colo1 = 'green';
                                        }
                                        ?>
                                        @include('components.course-instructor-status', ['instructor'=> DB::table('instructors')->find($id_votes[0]->id), 'color' => $colo1, 'value' => $id_votes[0]->votes, 'max' => $id_votes[0]->votes])
                                        @include('components.course-instructor-status', ['instructor' => DB::table('instructors')->find($id_votes[1]->id), 'color' => $colo2, 'value' => $id_votes[1]->votes, 'max' => $id_votes[0]->votes])
                                    @elseif(count($id_votes) == 3)
                                        <?php
                                        $colo1 = 'green';
                                        $colo2 = 'yellow';
                                        $colo3 = 'red';
                                        if($id_votes[0]->votes == $id_votes[1]->votes){
                                            $colo3 = $colo2 = 'yellow';
                                            $colo2 = $colo1 = 'green';
                                        }
                                        if($id_votes[1]->votes == $id_votes[2]->votes){
                                            $colo3 = $colo2 = 'yellow';
                                        }
                                        if($id_votes[0]->votes == $id_votes[1]->votes && $id_votes[1]->votes == $id_votes[2]->votes){
                                            $colo3 = $colo2 = $colo1 = 'green';
                                        }
                                        ?>
                                        @include('components.course-instructor-status', ['instructor'=> DB::table('instructors')->find($id_votes[0]->id), 'color' => $colo1, 'value' => $id_votes[0]->votes, 'max' => $id_votes[0]->votes])
                                        @include('components.course-instructor-status', ['instructor' => DB::table('instructors')->find($id_votes[1]->id), 'color' => $colo2, 'value' => $id_votes[1]->votes, 'max' => $id_votes[0]->votes])
                                        @include('components.course-instructor-status', ['instructor' => DB::table('instructors')->find($id_votes[2]->id), 'color' => $colo3, 'value' => $id_votes[2]->votes, 'max' => $id_votes[0]->votes])
                                    @endif
                                @else
                                    <span>هنوز کسی رای نداده است.</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="ui two column grid stackable">
            <div class="column">
                <div class="ui segment">
                    <div class="ui red fluid large label fw-400" style="text-align: center">
                        <span>میزان رضایت کاربران از سایت</span>
                    </div>
                    <div id="feedback_chart" style="padding: 1rem; height: 300px">
                        <canvas></canvas>
                    </div>
                    <div style="text-align: center">
                        <span>
                            <i class="smile icon big green"></i>
                            <div class="ui label green" style="margin-right: -8px;margin-left: 6px;padding: .3rem">{{ $feedback_summery['smile'] }}</div>
                        </span>
                            <span>
                            <i class="frown icon big teal"></i>
                            <div class="ui label teal" style="margin-right: -8px;margin-left: 6px;padding: .3rem">{{ $feedback_summery['frown'] }}</div>
                        </span>
                            <span>
                            <i class="heart icon big red"></i>
                            <div class="ui label red" style="margin-right: -8px;margin-left: 6px;padding: .3rem">{{ $feedback_summery['heart'] }}</div>
                        </span>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="ui segment">
                    <div class="ui teal fluid large label fw-400" style="text-align: center">
                        <span>آمار کاربران بر اساس سال ورود</span>
                    </div>
                    <div id="students_chart" style="padding: 1rem; height: 330px">
                        <canvas></canvas>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                feedback_data = {
                    datasets: [{
                        data: [
                            {{$feedback_summery['smile']}},
                            {{$feedback_summery['frown']}},
                            {{$feedback_summery['heart']}}
                        ],
                        backgroundColor: [
                            '#21BA45',
                            '#00B5AD',
                            '#DB2828'
                        ],
                    }],
                    labels: [
                        "Smile",
                        "Frown",
                        "Heart"
                    ]
                };
                random_colors = randomColor({luminosity: 'bright', count: {{ count($entry_year_count) }} });
                students_data = {
                    datasets: [{
                        data: [
                            @foreach($entry_year_count as $entry_year)
                            @if(!$loop->last)
                            {{ $entry_year->total }},
                            @else
                            {{ $entry_year->total }}
                            @endif
                            @endforeach
                        ],
                        backgroundColor: random_colors
                    }],
                    labels: [
                        @foreach($entry_year_count as $entry_year)
                        @if(!$loop->last)
                        {{ $entry_year->entry_year }},
                        @else
                        {{ $entry_year->entry_year }}
                        @endif
                        @endforeach
                    ]
                };
            });
        </script>
    </div>
@endsection