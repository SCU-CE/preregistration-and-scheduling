@extends('layouts.student')

@section('content')

    @if(Agent::isDesktop())
        @include('components.feedback-desktop')
    @endif

    <div id="p_student_semestercourses">
        <!-- Menu -->
        @include('components.student-menu', ['hasSteps' => true, 'active' => $currentStep])

        <!-- Content -->
        <div id="units_summery" class="desktop">
            <div>
                <div class="category button">
                    <i class="bordered inverted blue cube big icon"></i>
                </div>
                <div class="units number" style="background-color: #216aad">
                    <div data-value="{{ $units_by_category[0] }}">{{ $units_by_category[0] }}</div>
                </div>
            </div>
            <div>
                <div class="category button">
                    <i class="bordered inverted green puzzle big icon"></i>
                </div>
                <div class="units number" style="background-color: #1f9c3e">
                    <div data-value="{{ $units_by_category[1] }}">{{ $units_by_category[1] }}</div>
                </div>
            </div>
            <div>
                <div class="category button">
                    <i class="bordered inverted red empty heart big icon"></i>
                </div>
                <div class="units number" style="background-color: #c22525">
                    <div data-value="{{ $units_by_category[2] }}">{{ $units_by_category[2] }}</div>
                </div>
            </div>
            <div>
                <div class="category button">
                    <i class="bordered inverted lab orange big icon"></i>
                </div>
                <div class="units number" style="background-color: #d66319">
                    <div data-value="{{ $units_by_category[3] }}">{{ $units_by_category[3] }}</div>
                </div>
            </div>
            <div>
                <div class="category sum"
                     data-html="<div class='content'>شما در این نیمسال حداکثر مجاز به انتخاب {{ $max_units }} واحد می‌باشید.</div>"
                     data-position="bottom right"
                     data-offset="10">
                    <i class="circular inverted plus grey big icon"></i>
                </div>
                <div class="units sum" style="background-color: #666666">
                    <div data-value="{{ $sum_of_units }}">{{ $sum_of_units }}</div>
                </div>
            </div>
        </div>
        <div id="units_summery" class="mobile">
            <div class="group">
                <div class="category button">
                    <i class="bordered inverted blue cube big icon"></i>
                </div>
                <div class="units number" style="background-color: #216aad">
                    <div data-value="{{ $units_by_category[0] }}">{{ $units_by_category[0] }}</div>
                </div>
            </div>
            <div class="group">
                <div class="category button">
                    <i class="bordered inverted green puzzle big icon"></i>
                </div>
                <div class="units number" style="background-color: #1f9c3e">
                    <div data-value="{{ $units_by_category[1] }}">{{ $units_by_category[1] }}</div>
                </div>
            </div>
            <div class="group">
                <div class="category button">
                    <i class="bordered inverted red empty heart big icon"></i>
                </div>
                <div class="units number" style="background-color: #c22525">
                    <div data-value="{{ $units_by_category[2] }}">{{ $units_by_category[2] }}</div>
                </div>
            </div>
            <div class="group">
                <div class="category button">
                    <i class="bordered inverted lab orange big icon"></i>
                </div>
                <div class="units number" style="background-color: #d66319">
                    <div data-value="{{ $units_by_category[3] }}">{{ $units_by_category[3] }}</div>
                </div>
            </div>
            <div class="group">
                <div class="category sum"
                     data-html="<div class='content'>شما در این نیمسال حداکثر مجاز به انتخاب {{ $max_units }} واحد می‌باشید.</div>"
                     data-position="bottom right">
                    <i class="circular inverted plus grey big icon"></i>
                </div>
                <div class="units sum" style="background-color: #666666">
                    <div data-value="{{ $sum_of_units }}">{{ $sum_of_units }}</div>
                </div>
            </div>
        </div>

        <div class="ui container">
            <div class="ui segment">
                @include('components.preregister-steps', ['active' => '2nd'])
                <div class="ui divider"></div>
                <div class="ui massive{{$current_semester->semester == 'بهار' ? ' green' : ' orange'}} inverted center aligned segment">
                    <span>ترم {{$current_semester->semester}} {{$current_semester->year}}</span>
                </div>
                @if($passed_all_courses)
                    <h3 class="ui center aligned grey icon header">
                        <i class="massive student icon"></i>
                        <span>شما همه درس‌های ارائه شده در این ترم را گذرانده اید!</span>
                    </h3>
                @else
                    @include('components.info-message', ['message' => 'لطفا درس هایی را که قصد دارید در ترم پیش رو اخذ کنید انتخاب کنید.'])
                    <div class="ui divider"></div>
                    @for($i = 0; $i<4; $i++)
                        @if($category_has_courses[$i])
                            @include('components.course-category-ribbon', ['category' => $i])
                            <div class="ui four course cards">
                                @foreach($courses_by_category[$i] as $course)
                                    @if(!$student->passed_course($course->id))
                                        <?php
                                            $is_taken = DB::table('course_student')->where('course_id', $course->id)->where('student_id', $student->id)->where('semester_id', $current_semester->id)->count() != 0;
                                            $progress_value = DB::table('course_student')->where('course_id', $course->id)->where('semester_id', $current_semester->id)->count();
                                            $progress_max = DB::table('course_semester')->where('semester_id', $current_semester->id)->where('course_id', $course->id)->first()->min_capacity;
                                        ?>
                                        @include('components.semester-course-card', ['course' => $course, 'is_taken' => $is_taken, '$progress_value' => $progress_value, 'progress_max' => $progress_max, 'category_num' => $i+1])
                                    @endif
                                @endforeach
                            </div>
                            <div class="ui divider"></div>
                        @endif
                    @endfor
                @endif
                @include('components.next-back-btns', ['back_title' => 'مرحله قبل', 'back_link' => 'passed-courses',
                                                       'next_title' => 'مرحله بعد', 'next_link' => 'instructor-suggestion'])
            </div>
        </div>
        <!-- Footer -->
        @include('components.public-footer')
    </div>
@endsection