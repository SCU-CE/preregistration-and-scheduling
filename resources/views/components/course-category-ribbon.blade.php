@switch($category)
    @case(0)
        <div class="ui blue ribbon label huge">
            <i class="cube large icon"></i>
            <span class="fw-300"> درس های پایه</span>
        </div>
        @break
    @case(1)
        <div class="ui green ribbon label huge">
            <i class="puzzle large icon"></i>
            <span class="fw-300"> درس های اصلی</span>
        </div>
        @break
    @case(2)
        <div class="ui red ribbon label huge">
            <i class="heart large icon"></i>
            <span class="fw-300"> درس های اختیاری</span>
        </div>
        @break
    @case(3)
        <div class="ui orange ribbon label huge">
            <i class="lab large icon"></i>
            <span class="fw-300">آزمایشگاه ها</span>
        </div>
        @break
@endswitch