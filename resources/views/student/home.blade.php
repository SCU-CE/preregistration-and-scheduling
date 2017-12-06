@extends('layouts.student')

@section('content')

    @if(Agent::isDesktop())
        @include('components.feedback-desktop')
    @endif

    <div id="p_student_home">
        <!-- Menu -->
        @include('components.student-menu', ['hasSteps' => false, 'active' => $currentStep])

        <!-- Content -->
        <div class="ui container">
            <div class="ui segment">

                @include('components.steps', [
                                                'size' => 'large',
                                                'fluid' => true,
                                                'active' => $currentStep,
                                                'dates' => ['29 مهر تا 16 آبان','29 آبان تا 16 آذر','25 آذر تا 30 آذر'],
                                                'extraclasses' => ''])

                @include('components.steps-btns', ['active' => $currentStep])

                <div class="ui divider"></div>


            </div>
        </div>

        <!-- Footer -->
        @include('components.public-footer')
    </div>

@endsection