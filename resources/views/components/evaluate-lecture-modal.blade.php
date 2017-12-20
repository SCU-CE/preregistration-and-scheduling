<div class="header fw-400" style="text-align: center">
<span>{{$course->name}}</span><span> (گروه </span><span class="p_number">{{$schedule->group_number}}</span><span>)</span>
</div>

<div class="scrolling content">
    <div class="ui top attached tabular menu">
        <a class="active item" data-tab="1">اطلاعات درس</a>
        <a class="item" data-tab="2">درخواست شما</a>
        @if(count($public_evaluations) > 0)
            <a class="item" data-tab="3">درخواست های عمومی</a>
        @endif
    </div>
    <div class="ui bottom attached active tab segment" data-tab="1">
        <div class="ui divided selection list">
            <a class="item">
                <div class="ui blue big horizontal label fw-400" style="padding: 1rem">جلسه اول</div>
                <span style="font-size: 1.5rem">
                    <span>{{str_replace(array('saturday','sunday','monday','tuesday','wednesday'),array('شنبه','یکشنبه','دوشنبه','سه شنبه','چهارشنبه'),$schedule->weekday_1)}}</span>
                    <span class="p_number"> {{substr($schedule->start_time_1,0,5)}}</span><span> تا </span><span class="p_number">{{substr($schedule->end_time_1,0,5)}}</span>
                    @if($schedule->classroom_1 != '')
                    <span>کلاس </span><span class="p_number">{{$schedule->classroom_1}}</span>
                    @endif
                </span>
            </a>
            @if($schedule->weekday_2 != '')
                <a class="item">
                    <div class="ui purple big horizontal label fw-400" style="padding: 1rem">جلسه دوم</div>
                    <span style="font-size: 1.5rem">
                    <span>{{str_replace(array('saturday','sunday','monday','tuesday','wednesday'),array('شنبه','یکشنبه','دوشنبه','سه شنبه','چهارشنبه'),$schedule->weekday_2)}}</span>
                    <span class="p_number"> {{substr($schedule->start_time_2,0,5)}}</span><span> تا </span><span class="p_number">{{substr($schedule->end_time_2,0,5)}}</span>
                    @if($schedule->classroom_2 != '')
                    <span>کلاس </span><span class="p_number">{{$schedule->classroom_2}}</span>
                    @endif
                </span>
                </a>
            @endif
            <a class="item">
                <div class="ui orange horizontal big label fw-400" style="padding: 1rem">استاد درس</div>
                <img class="ui mini circular image" src="{{$instructor->photo != null ? url(Storage::url($instructor->photo)) : ( $instructor->sex == 'مرد' ? url(Storage::url('instructor_photos/img_male.png')) : url(Storage::url('instructor_photos/img_female.png')) )}}">
                <span style="font-size: 1.5rem">
                    {{$instructor->name}}
                </span>
            </a>
            @if($schedule->exam_date != '')
            <a class="item">
                <div class="ui red horizontal big label fw-400" style="padding: 1rem">امتحان</div>
                <span style="font-size: 1.5rem">
                    <span>{{$schedule->exam_date}}</span>
                    @if($schedule->exam_time != '')
                    <span> ساعت </span><span class="p_number">{{substr($schedule->exam_time,0,5)}}</span>
                    @endif
                </span>
            </a>
            @endif
        </div>
    </div>
    <div class="ui bottom attached tab segment" data-tab="2">
        @if(count($schedule_evaluation) > 0)
            @if($schedule_evaluation[0]->privacy == 'public')
                @include('components.warning-message', ['message' => 'توجه! در صورت ویرایش درخواست های عمومی آرای مرتبط نیز حذف می شوند.'])
            @endif
            <form class="ui form" method="post" action="{{url('student/evaluation/'.$schedule_evaluation[0]->id)}}">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <input type="hidden" name="schedule_id">
                @if($schedule->weekday_1 != '')
                <div class="ui horizontal divider fw-400">
                    <span>درخواست تغییر جلسه اول به</span>
                </div>
                <div class="ui hidden divider"></div>
                <div class="fields">
                    <div class="four wide field">
                        <label class="fw-400">روز هفته</label>
                        <select name="suggested_weekday_1" class="ui dropdown">
                            <option value="">انتخاب روز</option>
                            <option value="saturday"{{ $schedule_evaluation[0]->suggested_weekday_1 == 'saturday' ? ' selected' : '' }}>شنبه</option>
                            <option value="sunday"{{ $schedule_evaluation[0]->suggested_weekday_1 == 'sunday' ? ' selected' : '' }}>یکشنبه</option>
                            <option value="monday"{{ $schedule_evaluation[0]->suggested_weekday_1 == 'monday' ? ' selected' : '' }}>دوشنبه</option>
                            <option value="tuesday"{{ $schedule_evaluation[0]->suggested_weekday_1 == 'tuesday' ? ' selected' : '' }}>سه شنبه</option>
                            <option value="wednesday"{{ $schedule_evaluation[0]->suggested_weekday_1 == 'wednesday' ? ' selected' : '' }}>چهارشنبه</option>
                        </select>
                    </div>
                    <div class="six wide field">
                        <label class="fw-400">ساعت شروع</label>
                        <input class="timepicker" type="text" name="suggested_start_time_1" placeholder="ساعت شروع" value="{{$schedule_evaluation[0]->suggested_start_time_1}}">
                    </div>
                    <div class="six wide field">
                        <label class="fw-400">ساعت پایان</label>
                        <input class="timepicker" type="text" name="suggested_end_time_1" placeholder="ساعت پایان" value="{{$schedule_evaluation[0]->suggested_end_time_1}}">
                    </div>
                </div>
                <div class="field">
                    <label class="fw-400">دلیل (حداکثر در 250 کاراکتر)</label>
                    <textarea name="suggestion_reason_1" rows="2" style="font-family: IRANSans; line-height: 2rem">{{$schedule_evaluation[0]->suggestion_reason_1}}</textarea>
                </div>
                <div class="ui hidden divider"></div>
                @endif
                @if($schedule->weekday_2 != '')
                <div class="ui horizontal divider fw-400">
                    <span>درخواست تغییر جلسه دوم به</span>
                </div>
                <div class="ui hidden divider"></div>
                <div class="fields">
                    <div class="four wide field">
                        <label class="fw-400">روز هفته</label>
                        <select name="suggested_weekday_2" class="ui dropdown">
                            <option value="">انتخاب روز</option>
                            <option value="saturday"{{ $schedule_evaluation[0]->suggested_weekday_2 == 'saturday' ? ' selected' : '' }}>شنبه</option>
                            <option value="sunday"{{ $schedule_evaluation[0]->suggested_weekday_2 == 'sunday' ? ' selected' : '' }}>یکشنبه</option>
                            <option value="monday"{{ $schedule_evaluation[0]->suggested_weekday_2 == 'monday' ? ' selected' : '' }}>دوشنبه</option>
                            <option value="tuesday"{{ $schedule_evaluation[0]->suggested_weekday_2 == 'tuesday' ? ' selected' : '' }}>سه شنبه</option>
                            <option value="wednesday"{{ $schedule_evaluation[0]->suggested_weekday_2 == 'wednesday' ? ' selected' : '' }}>چهارشنبه</option>
                        </select>
                    </div>
                    <div class="six wide field">
                        <label class="fw-400">ساعت شروع</label>
                        <input class="timepicker" type="text" name="suggested_start_time_2" placeholder="ساعت شروع" value="{{$schedule_evaluation[0]->suggested_start_time_2}}">
                    </div>
                    <div class="six wide field">
                        <label class="fw-400">ساعت پایان</label>
                        <input class="timepicker" type="text" name="suggested_end_time_2" placeholder="ساعت پایان" value="{{$schedule_evaluation[0]->suggested_end_time_2}}">
                    </div>
                </div>
                <div class="field">
                    <label class="fw-400">دلیل (حداکثر در 250 کاراکتر)</label>
                    <textarea name="suggestion_reason_2" rows="2" style="font-family: IRANSans; line-height: 2rem">{{$schedule_evaluation[0]->suggestion_reason_2}}</textarea>
                </div>
                <div class="ui hidden divider"></div>
                @endif
                @if($schedule->exam_date != '')
                <div class="ui horizontal divider fw-400">
                    <span>درخواست تغییر امتحان به</span>
                </div>
                <div class="ui hidden divider"></div>
                <div class="fields">
                    <div class="eight wide field">
                        <label class="fw-400">تاریخ امتحان</label>
                        <input type="text" name="suggested_exam_date" placeholder="تاریخ امتحان" value="">
                        <input type="hidden" name="suggested_exam_date_unix" value="{{$schedule_evaluation[0]->suggested_exam_date_unix}}">
                    </div>
                    <div class="eight wide field">
                        <label class="fw-400">ساعت امتحان</label>
                        <input class="timepicker" type="text" name="suggested_exam_time" placeholder="ساعت امتحان" value="{{$schedule_evaluation[0]->suggested_exam_time}}">
                    </div>
                </div>
                <div class="field">
                    <label class="fw-400">دلیل (حداکثر در 250 کاراکتر)</label>
                    <textarea name="exam_suggestion_reason" rows="2" style="font-family: IRANSans; line-height: 2rem">{{$schedule_evaluation[0]->exam_suggestion_reason}}</textarea>
                </div>
                <div class="ui hidden divider"></div>
                @endif
                <div class="field" style="direction: ltr">
                    <label class="fw-400">نوع درخواست</label>
                    <div>
                        <div class="ui left pointing orange label fw-400" style="direction: rtl">
                            <span>توجه! درخواست های عمومی برای سایر دانشجویان قابل مشاهده هستند و میتوانند به آن ها رای بدهند.</span>
                        </div>
                        <select name="privacy" class="ui dropdown">
                            <option value="private"{{ $schedule_evaluation[0]->privacy == 'private' ? ' selected' : '' }}>شخصی</option>
                            <option value="public"{{ $schedule_evaluation[0]->privacy == 'public' ? ' selected' : '' }}>عمومی</option>
                        </select>
                    </div>
                </div>
                <div class="ui hidden divider"></div>
                <div id="erase_form" class="ui yellow right labeled icon button fw-300">
                    <span>پاک کردن فرم</span>
                    <i class="erase icon"></i>
                </div>
                <div id="delete_btn" class="ui red right labeled icon button fw-300">
                    <span>حذف درخواست</span>
                    <i class="minus icon"></i>
                </div>
                <button type="submit" class="ui green right labeled icon button fw-300">
                    <span>ویرایش درخواست</span>
                    <i class="write icon"></i>
                </button>
            </form>
            <form id="delete_form" method="post" action="{{url('student/evaluation/'.$schedule_evaluation[0]->id)}}">
                {{csrf_field()}}
                {{method_field('delete')}}
            </form>
        @else
            <form class="ui form" method="post" action="{{url('student/evaluation')}}">
                {{ csrf_field() }}
                <input type="hidden" name="schedule_id">
                @if($schedule->weekday_1 != '')
                <div class="ui horizontal divider fw-400">
                    <span>درخواست تغییر جلسه اول به</span>
                </div>
                <div class="ui hidden divider"></div>
                <div class="fields">
                    <div class="four wide field">
                        <label class="fw-400">روز هفته</label>
                        <select name="suggested_weekday_1" class="ui dropdown">
                            <option value="">انتخاب روز</option>
                            <option value="saturday">شنبه</option>
                            <option value="sunday">یکشنبه</option>
                            <option value="monday">دوشنبه</option>
                            <option value="tuesday">سه شنبه</option>
                            <option value="wednesday">چهارشنبه</option>
                        </select>
                    </div>
                    <div class="six wide field">
                        <label class="fw-400">ساعت شروع</label>
                        <input class="timepicker" type="text" name="suggested_start_time_1" placeholder="ساعت شروع" value="">
                    </div>
                    <div class="six wide field">
                        <label class="fw-400">ساعت پایان</label>
                        <input class="timepicker" type="text" name="suggested_end_time_1" placeholder="ساعت پایان" value="">
                    </div>
                </div>
                <div class="field">
                    <label class="fw-400">دلیل (حداکثر در 250 کاراکتر)</label>
                    <textarea name="suggestion_reason_1" rows="2" style="font-family: IRANSans; line-height: 2rem"></textarea>
                </div>
                <div class="ui hidden divider"></div>
                @endif
                @if($schedule->weekday_2 != '')
                <div class="ui horizontal divider fw-400">
                    <span>درخواست تغییر جلسه دوم به</span>
                </div>
                <div class="ui hidden divider"></div>
                <div class="fields">
                    <div class="four wide field">
                        <label class="fw-400">روز هفته</label>
                        <select name="suggested_weekday_2" class="ui dropdown">
                            <option value="">انتخاب روز</option>
                            <option value="saturday">شنبه</option>
                            <option value="sunday">یکشنبه</option>
                            <option value="monday">دوشنبه</option>
                            <option value="tuesday">سه شنبه</option>
                            <option value="wednesday">چهارشنبه</option>
                        </select>
                    </div>
                    <div class="six wide field">
                        <label class="fw-400">ساعت شروع</label>
                        <input class="timepicker" type="text" name="suggested_start_time_2" placeholder="ساعت شروع" value="">
                    </div>
                    <div class="six wide field">
                        <label class="fw-400">ساعت پایان</label>
                        <input class="timepicker" type="text" name="suggested_end_time_2" placeholder="ساعت پایان" value="">
                    </div>
                </div>
                <div class="field">
                    <label class="fw-400">دلیل (حداکثر در 250 کاراکتر)</label>
                    <textarea name="suggestion_reason_2" rows="2" style="font-family: IRANSans; line-height: 2rem"></textarea>
                </div>
                <div class="ui hidden divider"></div>
                @endif
                @if($schedule->exam_date != '')
                <div class="ui horizontal divider fw-400">
                    <span>درخواست تغییر امتحان به</span>
                </div>
                <div class="ui hidden divider"></div>
                <div class="fields">
                    <div class="eight wide field">
                        <label class="fw-400">تاریخ امتحان</label>
                        <input type="text" name="suggested_exam_date" placeholder="تاریخ امتحان" value="">
                        <input type="hidden" name="suggested_exam_date_unix" value="">
                    </div>
                    <div class="eight wide field">
                        <label class="fw-400">ساعت امتحان</label>
                        <input class="timepicker" type="text" name="suggested_exam_time" placeholder="ساعت امتحان" value="">
                    </div>
                </div>
                <div class="field">
                    <label class="fw-400">دلیل (حداکثر در 250 کاراکتر)</label>
                    <textarea name="exam_suggestion_reason" rows="2" style="font-family: IRANSans; line-height: 2rem"></textarea>
                </div>
                <div class="ui hidden divider"></div>
                @endif
                <div class="field" style="direction: ltr">
                    <label class="fw-400">نوع درخواست</label>
                    <div>
                        <div class="ui left pointing orange label fw-400" style="direction: rtl">
                            <span>توجه! درخواست های عمومی برای سایر دانشجویان قابل مشاهده هستند و میتوانند به آن ها رای بدهند.</span>
                        </div>
                        <select name="privacy" class="ui dropdown">
                            <option value="private">شخصی</option>
                            <option value="public">عمومی</option>
                        </select>
                    </div>
                </div>
                <div class="ui hidden divider"></div>
                <div id="erase_form" class="ui yellow right labeled icon button fw-300">
                    <span>پاک کردن فرم</span>
                    <i class="erase icon"></i>
                </div>
                <button type="submit" class="ui green right labeled icon button fw-300">
                    <span>ثبت درخواست</span>
                    <i class="checkmark icon"></i>
                </button>
            </form>
        @endif
    </div>
    @if(count($public_evaluations) > 0)
    <div class="ui bottom attached tab segment" data-tab="3">
        <div class="ui text container">
        @foreach($public_evaluations as $public_evaluation)
            <div class="ui fluid inverted card">
                <div class="ui inverted dimmer">
                    <div class="ui loader"></div>
                </div>
                <div class="content">
                    <div class="ui divided selection list">
                        @if($public_evaluation->suggested_weekday_1 != '')
                            <a class="item">
                                <div class="ui blue large horizontal label fw-400" style="padding: 1rem">تغییر جلسه اول</div>
                                <span style="font-size: 1.2rem">
                                    <span>از </span>
                                    <span>{{str_replace(array('saturday','sunday','monday','tuesday','wednesday'),array('شنبه','یکشنبه','دوشنبه','سه شنبه','چهارشنبه'),$schedule->weekday_1)}}</span>
                                    <span class="p_number"> {{substr($schedule->start_time_1,0,5)}}</span><span> تا </span><span class="p_number">{{substr($schedule->end_time_1,0,5)}}</span>
                                    <span> به </span>
                                    <span>{{str_replace(array('saturday','sunday','monday','tuesday','wednesday'),array('شنبه','یکشنبه','دوشنبه','سه شنبه','چهارشنبه'),$public_evaluation->suggested_weekday_1)}}</span>
                                    <span class="p_number"> {{substr($public_evaluation->suggested_start_time_1,0,5)}}</span><span> تا </span><span class="p_number">{{substr($public_evaluation->suggested_end_time_1,0,5)}}</span>
                                </span>
                                <div style="margin-top: .5rem">
                                    <div class="ui green fluid basic label">
                                        <div class="ui green horizontal label fw-400" style="padding: .5rem">دلیل</div>
                                        <span style="line-height: 2rem">{{$public_evaluation->suggestion_reason_1}}</span>
                                    </div>
                                </div>
                            </a>
                        @endif
                        @if($public_evaluation->suggested_weekday_2 != '')
                            <a class="item">
                                <div class="ui purple large horizontal label fw-400" style="padding: 1rem">تغییر جلسه دوم</div>
                                <span style="font-size: 1.2rem">
                                    <span>از </span>
                                    <span>{{str_replace(array('saturday','sunday','monday','tuesday','wednesday'),array('شنبه','یکشنبه','دوشنبه','سه شنبه','چهارشنبه'),$schedule->weekday_2)}}</span>
                                    <span class="p_number"> {{substr($schedule->start_time_2,0,5)}}</span><span> تا </span><span class="p_number">{{substr($schedule->end_time_2,0,5)}}</span>
                                    <span> به </span>
                                    <span>{{str_replace(array('saturday','sunday','monday','tuesday','wednesday'),array('شنبه','یکشنبه','دوشنبه','سه شنبه','چهارشنبه'),$public_evaluation->suggested_weekday_2)}}</span>
                                    <span class="p_number"> {{substr($public_evaluation->suggested_start_time_2,0,5)}}</span><span> تا </span><span class="p_number">{{substr($public_evaluation->suggested_end_time_2,0,5)}}</span>
                                </span>
                                <div style="margin-top: .5rem">
                                    <div class="ui green fluid basic label">
                                        <div class="ui green horizontal label fw-400" style="padding: .5rem">دلیل</div>
                                        <span style="line-height: 2rem">{{$public_evaluation->suggestion_reason_2}}</span>
                                    </div>
                                </div>
                            </a>
                        @endif
                        @if($public_evaluation->suggested_exam_date != '')
                            <a class="item">
                                <div class="ui red large horizontal label fw-400" style="padding: 1rem">تغییر امتحان</div>
                                <span style="font-size: 1.2rem">
                                    <span>از </span>
                                    <span>{{$schedule->exam_date}}</span>
                                    <span> ساعت </span><span class="p_number">{{substr($schedule->exam_time,0,5)}}</span>
                                    <span> به </span>
                                    <span>{{$public_evaluation->suggested_exam_date}}</span>
                                    <span> ساعت </span><span class="p_number">{{substr($public_evaluation->suggested_exam_time,0,5)}}</span>
                                </span>
                                <div style="margin-top: .5rem">
                                    <div class="ui green fluid basic label">
                                        <div class="ui green horizontal label fw-400" style="padding: .5rem">دلیل</div>
                                        <span style="line-height: 2rem">{{$public_evaluation->exam_suggestion_reason}}</span>
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="extra content">
                    <?php
                    $upvotes = DB::table('evaluation_votes')
                                    ->where('evaluation_id','=',$public_evaluation->id)
                                    ->where('vote','=',1)
                                    ->count();
                    $has_upvoted = DB::table('evaluation_votes')
                                    ->where('evaluation_id','=',$public_evaluation->id)
                                    ->where('student_id','=',$student->id)
                                    ->where('vote','=',1)
                                    ->count() > 0;

                    $downotes = DB::table('evaluation_votes')
                                    ->where('evaluation_id','=',$public_evaluation->id)
                                    ->where('vote','=',-1)
                                    ->count();
                    $has_downoted = DB::table('evaluation_votes')
                                        ->where('evaluation_id','=',$public_evaluation->id)
                                        ->where('student_id','=',$student->id)
                                        ->where('vote','=',-1)
                                        ->count() > 0;
                    if($downotes > 0){
                        $downotes = -$downotes;
                    }
                    ?>
                    <div id="upvote" data-id="{{$public_evaluation->id}}" class="left floated{{$has_upvoted ? ' blue-color' : ''}}" style="direction: ltr">
                        <i class="thumbs outline up big icon"></i>
                        <span>{{$upvotes}}</span>
                    </div>
                    <div id="downvote" data-id="{{$public_evaluation->id}}" class="right floated{{$has_downoted ? ' red-color' : ''}}" style="direction: ltr">
                        <i class="thumbs outline down big icon"></i>
                        <span>{{$downotes}}</span>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
    @endif
</div>
<div class="actions">
    <div class="ui negative right labeled icon button fw-300">
        <span>انصراف</span>
        <i class="remove icon"></i>
    </div>
</div>