@if($state == 'complete')
    <div class="completed step completed-color">
        <i class="thumbs outline up icon"></i>
@elseif($state == 'active')
    <div class="active step active-color">
        <i class="thumbs outline up blue icon"></i>
@elseif($state == 'deactive')
    <div class="step disabled-color">
        <i class="thumbs outline up icon"></i>
@endif
        <div class="content">
            <div class="title">ارزیابی برنامه</div>
            @isset($dates)
            <div class="description"><span class="unix date">{{$dates[2]}}</span> تا <span class="unix date">{{$dates[3]}}</span></div>
            @endisset
        </div>
    </div>