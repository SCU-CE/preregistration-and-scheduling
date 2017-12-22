@extends('layouts.student')

@section('content')

    @if(Agent::isDesktop())
        @include('components.feedback-desktop')
    @endif

    <div id="p_student_home">
        <!-- Menu -->
        @include('components.student-menu', ['hasSteps' => false])

        <!-- Content -->
        <div class="ui container">
            <div class="ui segment">
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
                    @if($stepState == 'enable')
                        @include('components.steps-btns', ['active' => $currentStep, 'any_eval_session' => $any_eval_session, 'active_eval_session_record' => $active_eval_session_record])
                    @endif
                @else
                    <div class="ui inverted segment center aligned orange">
                        <h3>
                            <i class="warning sign big icon"></i>
                            <span class="fw-400">در حال حاضر سامانه پیش ثبت نام غیر فعال می باشد!</span>
                        </h3>
                    </div>
                @endif

                @if($currentStep == '1st')
                    @if(count($courses)>0)
                        <div id="course_summery" class="ui segment">
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
                @endif

            </div>
        </div>

        <!-- Footer -->
        @include('components.public-footer')
    </div>

@endsection