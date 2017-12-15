<div class="ui course card{{$course->count >= $course->min_capacity ? ' green' : ' red'}}" id="course_{{ $course->id }}" data-id="{{ $course->id }}" data-state="{{$is_scheduled ? 'scheduled' : 'notscheduled'}}">
    <div class="ui right corner label{{$course->count >= $course->min_capacity ? ' green' : ' red'}}">
        <i class="icon{{$is_scheduled ? ' checkmark' : ''}}"></i>
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
    <div class="extra content center aligned">
        @for($i=(int)$semester->year-1; $i>(int)$semester->year-6; $i--)
            <?php
            $student_course_count = DB::table('course_student')
                                        ->where('semester_id','=',$semester->id)
                                        ->where('course_id','=',$course->id)
                                        ->join('students','course_student.student_id','=','students.id')
                                        ->where('students.entry_year','=',$i)
                                        ->count();
            ?>
            @if($student_course_count>0)
                    <?php
                    $student_semester = 0;
                    if($semester->semester == 'بهار'){
                        $student_semester = ((int)$semester->year-$i)*2;
                    }else{
                        $student_semester = ((int)$semester->year-$i)*2 + 1;
                    }
                    ?>
                    <div class="left floated">
                        <div class="student symbol">
                            <i class="student icon{{$student_semester == $course->planned_semester ? ' green' : ''}}"></i>
                            <div class="year{{$student_semester == $course->planned_semester ? ' green' : ''}}">{{$i}}</div>
                        </div>
                        <div class="student count{{$student_semester == $course->planned_semester ? ' green-dark' : ''}}">{{$student_course_count}}</div>
                    </div>
            @endif
        @endfor

        <span class="right floated">
            <span class="teal-dark">{{$course->count}}</span>
            <i class="large user teal icon"></i>
        </span>
    </div>
</div>