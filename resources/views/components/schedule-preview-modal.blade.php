<div class="header fw-400" style="text-align: center">
    <span>{{$course->name}}</span><span> (گروه </span><span class="p_number">{{$schedule->group_number}}</span><span>)</span>
</div>
<div class="scrolling content">
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
<div class="actions">
    <div class="ui negative right labeled icon button fw-300">
        <span>انصراف</span>
        <i class="remove icon"></i>
    </div>
</div>