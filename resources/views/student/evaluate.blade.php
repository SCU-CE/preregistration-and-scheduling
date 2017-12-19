@extends('layouts.student')
@section('content')
    @if(Agent::isDesktop())
        @include('components.feedback-desktop')
    @endif
    <div id="p_student_evaluate_schedule">
        <!-- Menu -->
        @include('components.student-menu', ['hasSteps' => true, 'active' => $currentStep])

        @if(Session::has('message'))
            <div class="ui {{ Session::get('message_color') }} message session container" style="text-align: center; position: fixed; z-index: 10000; bottom: 1rem; display: none;">
                <i class="close icon"></i>
                <div class="header fw-300">{{ Session::get('message') }}</div>
            </div>
        @endif

        <div class="ui container">
            <div class="ui segment">
                <div class="ui inverted yellow center aligned huge segment">
                    <span>مرحله </span><span class="p_number">{{$active_eval_session->session_number}}</span><span> ارزیابی ( </span><span class="unix date">{{$active_eval_session->start_date}}</span><span> تا </span><span class="unix date">{{$active_eval_session->end_date}}</span><span> )</span>
                </div>
                @include('components.info-message', ['message' => 'برای مشاهده جزئیات و/یا درخواست تغییر در برنامه بر روی درس ها کلیک کنید.'])
                <div id="schedule_table">
                    <div class="ui inverted dimmer">
                        <div class="ui loader"></div>
                    </div>
                    <div class="schedule"></div>
                    <table class="ui unstackable fixed center aligned celled striped definition table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>شنبه</th>
                            <th>یکشنبه</th>
                            <th>دوشنبه</th>
                            <th>سه شنبه</th>
                            <th>چهارشنبه</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i = 8; $i<=20; $i++)
                            <tr>
                                <td class="collapsing">
                                    {{$i < 10 ? '0'.$i : $i}}:00
                                </td>
                                <td><div class="ui divider"></div></td>
                                <td><div class="ui divider"></div></td>
                                <td><div class="ui divider"></div></td>
                                <td><div class="ui divider"></div></td>
                                <td><div class="ui divider"></div></td>
                            </tr>
                            @if ($i != 20)
                                <tr>
                                    <td class="collapsing">
                                        {{$i < 10 ? '0'.$i : $i}}:30
                                    </td>
                                    <td><div class="ui divider"></div></td>
                                    <td><div class="ui divider"></div></td>
                                    <td><div class="ui divider"></div></td>
                                    <td><div class="ui divider"></div></td>
                                    <td><div class="ui divider"></div></td>
                                </tr>
                            @endif
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="ui dimmer modals page transition hidden">
            <div id="evaluate_lecture" class="ui longer modal transition hidden">

            </div>
        </div>
        <script>
            var schedule_data = [
            @foreach($schedules as $schedule)
            {
                lecture_info: {
                    schedule_id: '{{$schedule->id}}',
                    course_name: '{{$schedule->course_name}}',
                    course_id: '{{$schedule->course_id}}',
                    instructor_name: '{{$schedule->instructor_name}}',
                    instructor_id: '{{$schedule->instructor_id}}',
                    group_number: '{{$schedule->group_number}}',
                    classroom: '{{$schedule->classroom_1}}',
                    exam_date: '{{$schedule->exam_date}}',
                    exam_time: '{{$schedule->exam_time}}'
                },
                weekday: '{{$schedule->weekday_1}}',
                start_time: '{{$schedule->start_time_1}}',
                end_time: '{{$schedule->end_time_1}}',
                course_color: '{{$schedule->course_color}}'
            },
                @if($schedule->weekday_2 != null)
                {
                    lecture_info: {
                        schedule_id: '{{$schedule->id}}',
                        course_name: '{{$schedule->course_name}}',
                        course_id: '{{$schedule->course_id}}',
                        instructor_name: '{{$schedule->instructor_name}}',
                        instructor_id: '{{$schedule->instructor_id}}',
                        group_number: '{{$schedule->group_number}}',
                        classroom: '{{$schedule->classroom_2}}',
                        exam_date: '{{$schedule->exam_date}}',
                        exam_time: '{{$schedule->exam_time}}'
                    },
                    weekday: '{{$schedule->weekday_2}}',
                    start_time: '{{$schedule->start_time_2}}',
                    end_time: '{{$schedule->end_time_2}}',
                    course_color: '{{$schedule->course_color}}'
                },
                @endif
            @endforeach
            ];
        </script>
        <!-- Footer -->
        @include('components.public-footer')
    </div>
@endsection