<?php
$color_hex;
switch ($color){
    case 'green':
        $color_hex = '21BA45';
        break;
    case 'yellow':
        $color_hex = 'FBBD08';
        break;
    case 'red':
        $color_hex = 'DB2828';
        break;
}
$height = ($value/$max)*26;
?>
<div class="instructor" data-tooltip="{{$instructor->name}}" data-position="bottom center">
    <div class="votes">
        <div class="bar" style="background-color: #{{$color_hex}}; height: {{$height}}px"></div>
        <div class="number">{{$value}}</div>
    </div>
    <div class="photo">
        <img class="ui mini circular image"
             src="{{$instructor->photo != null ? Storage::url($instructor->photo) : ( $instructor->sex == 'مرد' ? Storage::url('instructor_photos/img_male.png') : Storage::url('instructor_photos/img_female.png') )}}">
    </div>
</div>