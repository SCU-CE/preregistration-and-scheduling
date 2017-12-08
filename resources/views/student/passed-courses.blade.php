@extends('layouts.student')

@section('content')

    @if(Agent::isDesktop())
        @include('components.feedback-desktop')
    @endif

    <div id="p_student_passedcourses">
        <!-- Menu -->
        @include('components.student-menu', ['hasSteps' => true, 'active' => $currentStep])

        <!-- Content -->
        <div class="ui container">
            <div class="ui segment">
                @include('components.preregister-steps', ['active' => '1st'])
                <div class="ui divider"></div>
                @include('components.info-message', ['message' => 'لطفا تمام درس هایی را که در ترم های گذشته گذرانده اید انتخاب کنید.'])
                <div class="ui divider"></div>
                @for($i = 0; $i<4; $i++)
                    @if($has_category[$i])
                        @include('components.course-category-ribbon', ['category' => $i])
                        <div class="ui four course cards">
                            @foreach($courses_by_category[$i] as $course)
                                @include('components.passed-course-card', ['is_passed' => $student->passed_course($course->id), 'course' => $course])
                            @endforeach
                        </div>
                        <div class="ui divider"></div>
                    @endif
                @endfor
                @include('components.next-back-btns', ['back_title' => 'بازگشت', 'back_link' => 'home',
                                                       'next_title' => 'مرحله بعد', 'next_link' => 'semester-courses'])
            </div>
        </div>
        <!-- Footer -->
        @include('components.public-footer')
    </div>
@endsection