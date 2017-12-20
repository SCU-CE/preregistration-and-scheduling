<div class="ui instructor card" id="instructor_{{ $instructor->id }}" data-id="{{ $instructor->id }}" data-state="">
    <div class="ui right corner label hidden">
        <i class="icon"></i>
    </div>
    <div class="ui inverted dimmer">
        <div class="ui loader"></div>
    </div>
    <div class="image">
        <img src="{{$instructor->photo != null ? url(Storage::url($instructor->photo)) : ( $instructor->sex == 'مرد' ? url(Storage::url('instructor_photos/img_male.png')) : url(Storage::url('instructor_photos/img_female.png')) )}}">
    </div>
    <div class="content">
        <span class="header center aligned fw-400">{{$instructor->name}}</span>
    </div>
</div>