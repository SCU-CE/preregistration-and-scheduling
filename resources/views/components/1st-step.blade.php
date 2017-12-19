@if($state == 'complete')
<div class="completed step completed-color">
    <i class="add circle icon"></i>
@elseif($state == 'active')
<div class="active step active-color">
    <i class="add circle blue icon"></i>
@elseif($state == 'deactive')
<div class="step disabled-color">
    <i class="add circle icon"></i>
@endif
    <div class="content">
        <div class="title">پیش ثبت نام</div>
        @isset($dates)
        <div class="description"><span class="unix date">{{$dates[0]}}</span> تا <span class="unix date">{{$dates[1]}}</span></div>
        @endisset
    </div>
</div>