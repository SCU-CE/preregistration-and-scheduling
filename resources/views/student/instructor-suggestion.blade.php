@extends('layouts.student')

@section('content')

    @if(Agent::isDesktop())
        @include('components.feedback-desktop')
    @endif

    <div id="p_student_instructorsuggestion">
        <!-- Menu -->
        @include('components.student-menu', ['hasSteps' => true, 'active' => $currentStep])

        <!-- Content -->
        <div class="ui container">
            <div class="ui segment">
                @include('components.preregister-steps', ['active' => '3rd'])
                <div class="ui divider"></div>
                @include('components.info-message', ['message' => 'لطفا اساتید پیشنهادی خود برای درس های ترم پیش رو را انتخاب کنید.'])
                @if(count($student_courses)>0)
                <div class="ui green ribbon label huge">
                    <i class="user large icon"></i>
                    <span class="fw-300"> درس های شما</span>
                </div>
                <div class="ui four course cards">
                @foreach($student_courses as $course)
                    <?php
                    $voted = DB::table('course_instructor')
                            ->where('semester_id','=',$semester->id)
                            ->where('student_id','=',$student->id)
                            ->where('course_id','=',$course->id)
                            ->count() > 0;

                    $id_votes = DB::table('course_instructor')
                                        ->where('semester_id','=',$semester->id)
                                        ->where('course_id','=',$course->id)
                                        ->groupBy('instructor_id')
                                        ->select(DB::raw('instructor_id as id, count(*) as votes'))
                                        ->orderBy('votes','desc')
                                        ->take(3)
                                        ->get();
                    ?>
                    @include('components.course-instructors-card', ['course' => $course, 'voted' => $voted, 'id_votes' => $id_votes])
                @endforeach
                </div>
                <div class="ui divider"></div>
                @endif

                @if(count($semester_courses)>0)
                <div class="ui blue ribbon label huge">
                    <i class="road large icon"></i>
                    <span class="fw-300"> سایر درس های ترم</span>
                </div>
                <div class="ui four course cards">
                    @foreach($semester_courses as $course)
                        <?php
                        $voted = DB::table('course_instructor')
                                ->where('semester_id','=',$semester->id)
                                ->where('student_id','=',$student->id)
                                ->where('course_id','=',$course->id)
                                ->count() > 0;

                        $id_votes = DB::table('course_instructor')
                                        ->where('semester_id','=',$semester->id)
                                        ->where('course_id','=',$course->id)
                                        ->groupBy('instructor_id')
                                        ->select(DB::raw('instructor_id as id, count(*) as votes'))
                                        ->orderBy('votes','desc')
                                        ->take(3)
                                        ->get();
                        ?>
                            @include('components.course-instructors-card', ['course' => $course, 'voted' => $voted, 'id_votes' => $id_votes])
                    @endforeach
                </div>
                <div class="ui divider"></div>
                @endif

                @include('components.next-back-btns', ['back_title' => 'مرحله قبل', 'back_link' => 'semester-courses',
                                                       'next_title' => 'پایان فرآیند', 'next_link' => 'home'])
            </div>
        </div>

        <div class="ui dimmer modals page transition hidden">
            <div id="instructor_suggest" class="ui large longer modal transition hidden" data-id="">
                    <div class="header fw-400">
                        <span>لطفا اساتید مورد نظر خود را انتخاب کنید:</span>
                    </div>
                    <div class="scrolling content">
                        <div class="ui six doubling cards">
                            @foreach($instructors as $instructor)
                                @include('components.instructor-card', ['instructor' => $instructor])
                            @endforeach
                        </div>
                    </div>

                    <div class="actions">
                        <div class="ui negative right labeled icon button fw-300">
                            <span>انصراف</span>
                            <i class="remove icon"></i>
                        </div>
                        <div class="ui positive right labeled icon button fw-300">
                            <span>ثبت رای</span>
                            <i class="legal icon"></i>
                        </div>
                    </div>
            </div>
        </div>
        <!-- Footer -->
        @include('components.public-footer')
    </div>
@endsection