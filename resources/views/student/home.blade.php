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
                        @include('components.steps-btns', ['active' => $currentStep])
                    @endif
                @else
                    <div class="ui inverted segment center aligned orange">
                        <h3>
                            <i class="warning sign big icon"></i>
                            <span class="fw-400">در حال حاضر سامانه پیش ثبت نام غیر فعال می باشد!</span>
                        </h3>
                    </div>

                @endif
            </div>
        </div>

        <!-- Footer -->
        @include('components.public-footer')
    </div>

@endsection