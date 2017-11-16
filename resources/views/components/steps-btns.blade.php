@if($active == '1st')
<button class="ui huge fluid blue basic button">
    آغاز فرآید پیش ثبت نام
</button>
@elseif($active == '2nd')
<button class="ui huge fluid blue basic button">
    مشاهده برنامه اولیه و ارزیابی
</button>
@elseif($active == '3rd')
<button class="ui huge fluid blue basic button">
    مشاهده برنامه نهایی
</button>
@endif