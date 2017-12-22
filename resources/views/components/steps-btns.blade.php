@if($active == '1st')
<a href="{{url('student/passed-courses')}}" class="ui huge fluid blue basic button">
    آغاز فرآید پیش ثبت نام
</a>
@elseif($active == '2nd' && $any_eval_session)
<a href="{{url('student/evaluate-schedule')}}" class="ui huge fluid blue basic button">
    <span>مشاهده برنامه اولیه و ارزیابی</span>
    <span>(</span>
    <span>مرحله </span><span class="p_number">{{$active_eval_session_record->session_number}}</span>
    <span>از </span><span class="unix date">{{$active_eval_session_record->start_date}}</span><span> تا </span><span class="unix date">{{$active_eval_session_record->end_date}}</span>
    <span>)</span>
</a>
@elseif($active == '3rd')
<a href="{{url('student/final-schedule')}}" class="ui huge fluid blue basic button">
    مشاهده برنامه نهایی
</a>
@endif