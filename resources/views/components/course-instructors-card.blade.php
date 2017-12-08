<div class="ui course card{{$voted?' green':''}}" id="course_{{ $course->id }}" data-id="{{ $course->id }}" data-state="{{$voted?'voted':'notvoted'}}">
    <div class="ui right corner label{{$voted?' green':' hidden'}}">
        <i class="legal icon"></i>
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
        @if(count($id_votes) > 0)
            @if(count($id_votes) == 1)
                @include('components.course-instructor-status', ['instructor'=> DB::table('instructors')->find($id_votes[0]->id), 'color' => 'green', 'value' => $id_votes[0]->votes, 'max' => $id_votes[0]->votes])
            @elseif(count($id_votes) == 2)
                <?php
                    $colo1 = 'green';
                    $colo2 = 'yellow';
                    if($id_votes[0]->votes == $id_votes[1]->votes){
                        $colo2 = $colo1 = 'green';
                    }
                ?>
                @include('components.course-instructor-status', ['instructor' => DB::table('instructors')->find($id_votes[1]->id), 'color' => $colo2, 'value' => $id_votes[1]->votes, 'max' => $id_votes[0]->votes])
                @include('components.course-instructor-status', ['instructor'=> DB::table('instructors')->find($id_votes[0]->id), 'color' => $colo1, 'value' => $id_votes[0]->votes, 'max' => $id_votes[0]->votes])
            @elseif(count($id_votes) == 3)
                <?php
                    $colo1 = 'green';
                    $colo2 = 'yellow';
                    $colo3 = 'red';
                    if($id_votes[0]->votes == $id_votes[1]->votes){
                        $colo3 = $colo2 = 'yellow';
                        $colo2 = $colo1 = 'green';
                    }
                    if($id_votes[1]->votes == $id_votes[2]->votes){
                        $colo3 = $colo2 = 'yellow';
                    }
                    if($id_votes[0]->votes == $id_votes[1]->votes && $id_votes[1]->votes == $id_votes[2]->votes){
                        $colo3 = $colo2 = $colo1 = 'green';
                    }
                ?>
                @include('components.course-instructor-status', ['instructor' => DB::table('instructors')->find($id_votes[2]->id), 'color' => $colo3, 'value' => $id_votes[2]->votes, 'max' => $id_votes[0]->votes])
                @include('components.course-instructor-status', ['instructor' => DB::table('instructors')->find($id_votes[1]->id), 'color' => $colo2, 'value' => $id_votes[1]->votes, 'max' => $id_votes[0]->votes])
                @include('components.course-instructor-status', ['instructor'=> DB::table('instructors')->find($id_votes[0]->id), 'color' => $colo1, 'value' => $id_votes[0]->votes, 'max' => $id_votes[0]->votes])
            @endif
        @else
            <span>هنوز کسی رای نداده است.</span>
        @endif
    </div>
</div>