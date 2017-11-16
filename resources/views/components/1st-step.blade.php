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
        @isset($date)
        <div class="description">{{ $date }}</div>
        @endisset
    </div>
</div>