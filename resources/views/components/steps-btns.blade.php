@if($active == '1st')
<a href="{{url('student/passed-courses')}}" class="ui huge fluid blue basic button">
    آغاز فرآید پیش ثبت نام
</a>
@elseif($active == '2nd')
<a href="{{url('student/evaluate-schedule')}}" class="ui huge fluid blue basic button">
    مشاهده برنامه اولیه و ارزیابی
</a>
@elseif($active == '3rd')
<a href="{{url('student/final-schedule')}}" class="ui huge fluid blue basic button">
    مشاهده برنامه نهایی
</a>
@endif