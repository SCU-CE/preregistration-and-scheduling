@extends('layouts.student')

@section('content')

    @if(Agent::isDesktop())
        @include('components.feedback-desktop')
    @endif

    <div id="p_student">
        <div class="ui container">
            <!-- Menu -->
             @include('components.student-menu', ['hasSteps' => true])

            <!-- Content -->
            <div class="ui segment">

                <div class="ui fluid steps">
                    <div class="active step active-color">
                        <i class="hand peace blue icon"></i>
                        <div class="content">
                            <div class="title">گذرانده شده ها</div>
                        </div>
                    </div>
                    <div class="step disabled-color">
                        <i class="book icon"></i>
                        <div class="content">
                            <div class="title">درس های ترم</div>
                        </div>
                    </div>
                    <div class="step disabled-color">
                        <i class="student icon"></i>
                        <div class="content">
                            <div class="title">پیشنهاد استاد</div>
                        </div>
                    </div>
                </div>

                <div class="ui divider"></div>

                <div class="ui blue ribbon label huge">
                    <i class="cube large icon"></i>
                    <span class="fw-300"> درس های پایه</span>
                </div>

                <div class="ui divider"></div>

                <div class="ui green ribbon label huge">
                    <i class="puzzle large icon"></i>
                    <span class="fw-300"> درس های اصلی</span>
                </div>

                <div class="ui divider"></div>

                <div class="ui red ribbon label huge">
                    <i class="heart large icon"></i>
                    <span class="fw-300"> درس های اختیاری</span>
                </div>

                <div class="ui divider"></div>

                <div class="ui orange ribbon label huge">
                    <i class="lab large icon"></i>
                    <span class="fw-300">آزمایشگاه ها</span>
                </div>
            </div>

            <!-- Footer -->
            @include('components.public-footer')
        </div>
    </div>

@endsection