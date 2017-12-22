@extends('layouts.student')
@section('content')
    @if(Agent::isDesktop())
        @include('components.feedback-desktop')
    @endif
    <div id="p_student_final_schedule">
        <!-- Menu -->
        @include('components.student-menu', ['hasSteps' => true, 'active' => $currentStep])

        <div class="ui container">
            <div class="ui segment">
                <div id="schedule_table">
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
            <div id="schedule_preview" class="ui longer modal transition hidden"></div>
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