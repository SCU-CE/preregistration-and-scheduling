<div class="ui course card{{$is_passed?' green':''}}" id="course_{{ $course->id }}" data-id="{{ $course->id }}" data-state="{{$is_passed?'taken':'nottaken'}}">
    <div class="ui right corner label{{$is_passed?' green':' hidden'}}">
        <i class="checkmark icon"></i>
    </div>
    <div class="ui inverted dimmer">
        <div class="ui loader"></div>
    </div>

    <div class="content">
        <div class="header fw-400">{{ $course->name }}</div>
        <div class="meta">
            <span class="right floated time"><span>{{ $course->units }}</span> واحد</span>
            <span class="category">{{ $course->code }}</span>
        </div>
        <div class="description">
            <p></p>
        </div>
    </div>
</div>