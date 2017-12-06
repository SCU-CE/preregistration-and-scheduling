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

                @include('components.next-back-btns', ['back_title' => 'مرحله قبل', 'back_link' => 'semester-courses',
                                                       'next_title' => 'پایان فرآیند', 'next_link' => 'home'])
            </div>
        </div>
        <!-- Footer -->
        @include('components.public-footer')
    </div>
@endsection