@if($state == 'complete')
    <div class="completed step completed-color">
        <i class="flag icon"></i>
@elseif($state == 'active')
    <div class="active step active-color">
        <i class="flag blue icon"></i>
@elseif($state == 'deactive')
    <div class="step disabled-color">
        <i class="flag icon"></i>
@endif
        <div class="content">
            <div class="title">برنامه نهایی</div>
            @isset($date)
            <div class="description">{{ $date }}</div>
            @endisset
        </div>
    </div>