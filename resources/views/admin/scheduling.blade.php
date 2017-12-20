@extends('layouts.admin')

@section('content')

    <div id="p_admin_scheduling" data-stage="{{$schedulingStage}}">
        <!-- Header -->
        @include('components.scheduling-steps', ['active' => $schedulingStage])
        @if($prereg_time)
            @include('components.warning-message', ['message' => 'توجه داشته باشید که دانشجویان هم اکنون در حال پیش ثبت نام می باشند!'])
        @endif
        @if($schedulingStage == '1st')
        <div class="ui basic segment" style="padding: 0">
            <button id="add_to_schedule_btn" class="ui large green labeled icon button">
                <i class="plus icon"></i>
                <span class="fw-400">افزرودن به برنامه</span>
            </button>
        </div>
        @elseif($schedulingStage == '2nd')
            @if($any_eval_session)
                @if($eval_time)
                    @include('components.warning-message', ['message' => 'توجه داشته باشید که دانشجویان هم اکنون در حال ثبت درخواست های خود برای مرحله '.$active_eval_session.' ارزیابی هستند! لطفا قبل از تغییر برنامه، با توجه به مهلت مرحله، وضعیت سیستم را در حالت غیر فعال قرار دهید تا تداخلی در درخواست های دانشجویان به وجود نیاید!'])
                @else
                    @include('components.warning-message', ['message' => 'لطفا در بخش تنظیمات وضعیت سیستم را بر روی حالت درست قرار دهید تا دانشجویان بتوانند درخواست های خود را برای این مرحله ارزیابی ثبت کنند.'])
                @endif
            @else
                @include('components.warning-message', ['message' => 'لطفا به کمک بخش مراحل ارزیابی حداقل یک مرحله ی ارزیابی برای برنامه تعریف کنید.'])
            @endif
            <div class="ui menu" style="padding: 0;border: none;box-shadow: none;">
                <button id="add_to_schedule_btn" class="ui large blue labeled icon button">
                    <i class="mail icon"></i>
                    <span class="fw-400">درس ها بر اساس درخواست</span>
                </button>
                <div class="right menu">
                    <button id="evaluation_sessions_btn" class="ui large orange right labeled icon button" style="margin: 0">
                        <i class="road icon"></i>
                        <span class="fw-400">مراحل ارزیابی</span>
                    </button>
                </div>
            </div>
        @elseif($schedulingStage == '3rd')
            @if(!$final_time)
                @include('components.warning-message', ['message' => 'لطفا در بخش تنظیمات وضعیت سیستم را بر روی حالت درست قرار دهید تا برنامه برای دانشجویان قابل مشاهده شود.'])
            @endif
        @endif

        <!-- Content -->
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

        <!-- Footer -->
        @if($schedulingStage == '1st')
        <div class="ui basic center aligned segment" style="padding: 0">
            <form action="{{url('admin/scheduling/schedulingstage')}}" method="post" style="display: inline-block;">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <input type="hidden" name="scheduling_stage" value="2nd">
                <button type="submit" class="ui large red right labeled icon button">
                    <i class="checkmark icon"></i>
                    <span class="fw-400">تایید برنامه و رفتن به مرحله ارزیابی</span>
                </button>
            </form>
        </div>
        @elseif($schedulingStage == '2nd')
        <div class="ui basic center aligned segment" style="padding: 0">
            <form action="{{url('admin/scheduling/schedulingstage')}}" method="post" style="display: inline-block;">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <input type="hidden" name="scheduling_stage" value="1st">
                <button class="ui large blue labeled icon button">
                    <i class="right arrow icon"></i>
                    <span class="fw-400">بازگشت به مرحله برنامه ریزی اولیه</span>
                </button>
            </form>
            <form action="{{url('admin/scheduling/schedulingstage')}}" method="post" style="display: inline-block;">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <input type="hidden" name="scheduling_stage" value="3rd">
                <button class="ui large red right labeled icon button">
                    <i class="checkmark icon"></i>
                    <span class="fw-400">تایید برنامه و رفتن به مرحله نهایی</span>
                </button>
            </form>
        </div>
        @elseif($schedulingStage == '3rd')
        <div class="ui basic center aligned segment" style="padding: 0">
            <form action="{{url('admin/scheduling/schedulingstage')}}" method="post" style="display: inline-block;">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <input type="hidden" name="scheduling_stage" value="2nd">
                <button class="ui large blue labeled icon button">
                    <i class="right arrow icon"></i>
                    <span class="fw-400">بازگشت به مرحله ارزیابی برنامه</span>
                </button>
            </form>
        </div>
        @endif

        <!-- Modals -->
        <div class="ui dimmer modals page transition hidden">
            @if(in_array($schedulingStage, ['1st','2nd']))
            <div id="courses" class="ui large longer modal transition hidden">
                <div class="scrolling content">
                    <div class="ui four course cards">
                        @if($schedulingStage == '1st')
                            @foreach($courses as $course)
                                <?php
                                $is_scheduled = DB::table('course_schedule')
                                                        ->where('semester_id','=',$semester->id)
                                                        ->where('course_id','=',$course->id)
                                                        ->count() > 0;
                                ?>
                                @include('components.schedule-course-card', ['course' => $course, 'semester' => $semester, 'is_scheduled' => $is_scheduled])
                            @endforeach
                        @elseif($schedulingStage == '2nd')
                            @foreach($courses_by_eval_count as $course_by_eval_count)
                                @if($course = $courses->where('id',$course_by_eval_count->id)->first())
                                    <?php
                                    $is_scheduled = DB::table('course_schedule')
                                            ->where('semester_id','=',$semester->id)
                                            ->where('course_id','=',$course->id)
                                            ->count() > 0;
                                    ?>
                                    @include('components.schedule-course-card', ['course' => $course, 'semester' => $semester, 'is_scheduled' => $is_scheduled, 'schedulingStage' => $schedulingStage, 'course_by_eval_count' => $course_by_eval_count])
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="actions">
                    <div style="float:right;">
                        <span class="ui green large tag label fw-400">درس های به حد نصاب رسیده</span>
                        <span class="ui red large tag label fw-400">درس های به حد نصاب نرسیده</span>
                    </div>
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
                    <div id="course_info">
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
                    <div class="ui positive right labeled icon button fw-300">
                        <span>ثبت در برنامه</span>
                        <i class="checkmark icon"></i>
                    </div>
                </div>
            </div>
            @endif
            @if($schedulingStage == '2nd')
            <div id="evaluation_sessions" class="ui longer modal transition hidden">
                <div class="scrolling content">
                    @include('components.warning-message', ['message' => 'توجه داشته باشید در صورت حذف مرحله ی ارزیابی درخواست های مرتبط با آن نیز حذف می شوند!'])
                    <form class="ui form" action="{{url('admin/scheduling/evaluation-sessions')}}" method="post">
                        {{ csrf_field() }}
                        <table class="ui center aligned celled definition table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="fw-400">مرحله</th>
                                    <th class="fw-400">تاریخ شروع</th>
                                    <th class="fw-400">تاریخ پایان</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($evaluation_sessions) > 0)
                                <input type="hidden" name="number_of_sessions" value="{{count($evaluation_sessions)}}">
                                @foreach($evaluation_sessions as $evaluation_session)
                                    <tr id="session_{{$evaluation_session->session_number}}" data-number="{{$evaluation_session->session_number}}">
                                        <td class="collapsing">
                                            <div class="ui toggle checkbox" style="display: block;">
                                                <input name="session_enable" type="radio" value="{{$evaluation_session->session_number}}"{{$evaluation_session->session_number == $active_eval_session ? ' checked' : ''}}>
                                                <label style="padding-right: 3.5rem;"></label>
                                            </div>
                                        </td>
                                        <td>مرحله <span class="p_number">{{$evaluation_session->session_number}}</span>
                                            <input type="hidden" name="session_number_{{$evaluation_session->session_number}}" value="{{$evaluation_session->session_number}}">
                                        </td>
                                        <td>
                                            <div class="fluid field">
                                                <input type="text" name="start_date_p_{{$evaluation_session->session_number}}" placeholder="تاریخ شروع" style="text-align: center">
                                                <input type="hidden" name="start_date_{{$evaluation_session->session_number}}" value="{{$evaluation_session->start_date}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fluid field">
                                                <input type="text" name="end_date_p_{{$evaluation_session->session_number}}" placeholder="تاریخ پایان" style="text-align: center">
                                                <input type="hidden" name="end_date_{{$evaluation_session->session_number}}" value="{{$evaluation_session->end_date}}">
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <input type="hidden" name="number_of_sessions" value="1">
                                <tr id="session_1" data-number="1">
                                    <td class="collapsing">
                                        <div class="ui toggle checkbox" style="display: block;">
                                            <input name="session_enable" type="radio" value="1" checked>
                                            <label style="padding-right: 3.5rem;"></label>
                                        </div>
                                    </td>
                                    <td>مرحله <span class="p_number">1</span>
                                        <input type="hidden" name="session_number_1" value="1">
                                    </td>
                                    <td>
                                        <div class="fluid field">
                                            <input type="text" name="start_date_p_1" placeholder="تاریخ شروع" style="text-align: center">
                                            <input type="hidden" name="start_date_1">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fluid field">
                                            <input type="text" name="end_date_p_1" placeholder="تاریخ پایان" style="text-align: center">
                                            <input type="hidden" name="end_date_1">
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot class="full-width">
                            <tr>
                                <th></th>
                                <th colspan="3">
                                    <div id="add_session" class="ui right floated blue labeled icon button">
                                        <i class="plus icon"></i>
                                        <span class="fw-300">افزوردن مرحله جدید</span>
                                    </div>
                                    <div id="remove_session" class="ui right floated orange labeled icon button{{count($evaluation_sessions) > 0 ? '' : ' disabled'}}">
                                        <i class="remove icon"></i>
                                        <span class="fw-300">حذف آخرین مرحله</span>
                                    </div>
                                </th>
                            </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
                <div class="actions">
                    <div class="ui negative right labeled icon button fw-300">
                        <span>انصراف</span>
                        <i class="remove icon"></i>
                    </div>
                    <div class="ui positive right labeled icon button fw-300">
                        <span>ثبت اطلاعات</span>
                        <i class="checkmark icon"></i>
                    </div>
                </div>
            </div>
            @endif
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