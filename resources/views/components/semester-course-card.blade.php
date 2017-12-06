<div class="ui course card{{$is_taken?' green':''}}" id="course_{{ $course->id }}" data-category="{{$category_num}}" data-units="{{ $course->units }}" data-id="{{ $course->id }}" data-state="{{$is_taken?'taken':'nottaken'}}">
    <div class="ui right corner label{{$is_taken?' green':' hidden'}}">
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
    <div class="extra content">
        <div class="ui indicating progress" data-value="{{ $progress_value }}" data-total="{{ $progress_max }}">
            <div class="bar">
                <div class="progress"></div>
            </div>
            <div class="label">دانشجویی این درس را اخذ نکرده است.</div>
        </div>
    </div>
</div>