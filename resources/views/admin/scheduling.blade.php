@extends('layouts.admin')

@section('content')

    <div id="p_admin_scheduling">
        @include('components.scheduling-steps', ['active' => '1st'])
        <div class="ui menu">
            <button class="ui large green labeled icon button">
                <i class="plus icon"></i>
                <span class="fw-400">افزرودن به برنامه</span>
            </button>
            <div class="right menu">
                <button class="ui large red labeled icon button">
                    <i class="checkmark icon"></i>
                    <span class="fw-400">تایید برنامه و رفتن به ارزیابی</span>
                </button>
            </div>
        </div>
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
        <div class="ui dimmer modals page transition hidden">
            <div id="courses" class="ui large longer modal transition hidden">
                <div class="scrolling content">
                    <div class="ui four course cards">
                        @foreach($courses as $course)
                            <?php
                                $is_scheduled = DB::table('course_schedule')
                                                        ->where('semester_id','=',$semester->id)
                                                        ->where('course_id','=',$course->id)
                                                        ->count() > 0;
                            ?>
                            @include('components.schedule-course-card', ['course' => $course, 'semester' => $semester, 'is_scheduled' => $is_scheduled])
                        @endforeach
                    </div>
                </div>
                <div class="actions">
                    <div class="ui negative right labeled icon button fw-300">
                        <span>انصراف</span>
                        <i class="remove icon"></i>
                    </div>
                </div>
            </div>
            <div id="add_schedule" class="ui large longer modal transition hidden">
                <div class="scrolling content">
                    <div id="course_groups">
                        <div class="ui top attached tabular menu">
                            <div class="left menu">
                                <a class="item active fw-400" data-tab="1">گروه 1</a>
                            </div>
                            <div class="right menu">
                                <button class="ui red labeled icon disabled button fw-300">
                                    <i class="remove icon"></i>
                                    <span>حذف آخرین گروه</span>
                                </button>
                                <button class="ui green labeled icon button fw-300">
                                    <i class="plus icon"></i>
                                    <span>افزودن گروه جدید</span>
                                </button>
                            </div>
                        </div>
                        <div class="ui bottom attached tab segment active" data-tab="1">
                            <form class="ui form">
                                <input type="hidden" name="course_id">
                                <input type="hidden" name="group_number" value="1">
                                <div class="fields">
                                    <div class="eight wide required field">
                                        <label for="instructor_id">استاد درس</label>
                                        <select name="instructor_id" class="ui dropdown">
                                            <option value="">انتخاب استاد</option>
                                            @foreach($instructors as $instructor)
                                                <option value="{{$instructor->id}}">{{$instructor->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="eight wide field">
                                        <label>رنگ درس</label>
                                        <div class="block preview"></div>
                                        <input type="hidden" name="course_color">
                                    </div>
                                </div>
                                <div class="ui hidden divider"></div>
                                <div class="ui horizontal divider fw-400">
                                    <span>اطلاعات جلسه اول</span>
                                </div>
                                <div class="fields">
                                    <div class="four wide required field">
                                        <label for="weekday_1">روز هفته</label>
                                        <select name="weekday_1" class="ui dropdown">
                                            <option value="">انتخاب روز</option>
                                            <option value="saturday">شنبه</option>
                                            <option value="sunday">یکشنبه</option>
                                            <option value="monday">دوشنبه</option>
                                            <option value="tuesday">سه شنبه</option>
                                            <option value="wednesday">چهارشنبه</option>
                                        </select>
                                    </div>
                                    <div class="four wide field">
                                        <label for="classroom_1">کلاس درس</label>
                                        <input type="text" name="classroom_1" placeholder="کلاس درس" value="">
                                    </div>
                                    <div class="four wide required field">
                                        <label for="start_time_1">ساعت شروع</label>
                                        <input class="timepicker" type="text" name="start_time_1" placeholder="ساعت شروع" value="">
                                    </div>
                                    <div class="four wide required field">
                                        <label for="end_time_1">ساعت پایان</label>
                                        <input class="timepicker" type="text" name="end_time_1" placeholder="ساعت پایان" value="">
                                    </div>
                                </div>
                                <div class="ui hidden divider"></div>
                                <div class="ui horizontal divider fw-400">
                                    <span>اطلاعات جلسه دوم</span>
                                </div>
                                <div class="fields">
                                    <div class="four wide field">
                                        <label for="weekday_2">روز هفته</label>
                                        <select name="weekday_2" class="ui dropdown">
                                            <option value="">انتخاب روز</option>
                                            <option value="saturday">شنبه</option>
                                            <option value="sunday">یکشنبه</option>
                                            <option value="monday">دوشنبه</option>
                                            <option value="tuesday">سه شنبه</option>
                                            <option value="wednesday">چهارشنبه</option>
                                        </select>
                                    </div>
                                    <div class="four wide field">
                                        <label for="classroom_2">کلاس درس</label>
                                        <input type="text" name="classroom_2" placeholder="کلاس درس" value="">
                                    </div>
                                    <div class="four wide field">
                                        <label for="start_time_2">ساعت شروع</label>
                                        <input class="timepicker" type="text" name="start_time_2" placeholder="ساعت شروع" value="">
                                    </div>
                                    <div class="four wide field">
                                        <label for="end_time_2">ساعت پایان</label>
                                        <input class="timepicker" type="text" name="end_time_2" placeholder="ساعت پایان" value="">
                                    </div>
                                </div>
                                <div class="ui hidden divider"></div>
                                <div class="ui horizontal divider fw-400">
                                    <span>اطلاعات امتحان</span>
                                </div>
                                <div class="fields">
                                    <div class="eight wide field">
                                        <label for="exam_date">تاریخ امتحان</label>
                                        <input type="text" name="exam_date" placeholder="تاریخ امتحان" value="">
                                        <input type="hidden" name="exam_date_unix" value="">
                                    </div>
                                    <div class="eight wide field">
                                        <label for="exam_time">ساعت امتحان</label>
                                        <input class="timepicker" type="text" name="exam_time" placeholder="ساعت امتحان" value="">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="ui hidden divider"></div>
                    <div>
                        <div class="ui top attached tabular menu">
                            <a class="item active fw-400" data-tab="instructors">اساتید پیشنهادی</a>
                            <a class="item fw-400" data-tab="conflicts">تداخل های درس</a>
                            <a class="item fw-400" data-tab="students">دانشجویان درس</a>
                        </div>
                        <div class="ui bottom attached tab segment active" data-tab="instructors">
                            <div class="instructors"></div>
                        </div>
                        <div class="ui bottom attached tab segment" data-tab="conflicts">
                            <table class="ui selectable celled striped center aligned conflicts table">
                                <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>کد درس</th>
                                    <th>نام درس</th>
                                    <th>تعداد تداخل</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="ui bottom attached tab segment" data-tab="students">
                            <table class="ui selectable celled striped center aligned students table">
                                <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام</th>
                                    <th>نام خانوادگی</th>
                                    <th>شماره دانشجویی</th>
                                    <th>سال ورود</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="actions">
                    <div class="ui blue left labeled icon button left floated fw-300">
                        <span>بازگشت</span>
                        <i class="arrow right icon"></i>
                    </div>
                    <div class="ui negative right labeled icon button fw-300">
                        <span>انصراف</span>
                        <i class="remove icon"></i>
                    </div>
                    <div class="ui orange right labeled icon button fw-300">
                        <span>حذف برنامه</span>
                        <i class="minus icon"></i>
                    </div>
                    <div class="ui positive yellow right labeled icon button fw-300">
                        <span>ثبت در برنامه</span>
                        <i class="checkmark icon"></i>
                    </div>
                </div>
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
    </div>

@endsection