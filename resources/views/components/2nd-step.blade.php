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
            @isset($date)
            <div class="description">{{ $date }}</div>
            @endisset
        </div>
    </div>