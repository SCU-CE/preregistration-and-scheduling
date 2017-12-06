@switch($active)
    @case('1st')
    <div class="ui fluid steps">
        <div class="active step active-color">
            <i class="hand peace blue icon"></i>
            <div class="content">
                <div class="title">گذرانده شده ها</div>
            </div>
        </div>
        <div class="step disabled-color">
            <i class="book icon"></i>
            <div class="content">
                <div class="title">درس های ترم</div>
            </div>
        </div>
        <div class="step disabled-color">
            <i class="student icon"></i>
            <div class="content">
                <div class="title">پیشنهاد استاد</div>
            </div>
        </div>
    </div>
    @break
    @case('2nd')
    <div class="ui fluid steps">
        <div class="completed step completed-color">
            <i class="hand peace icon"></i>
            <div class="content">
                <div class="title">گذرانده شده ها</div>
            </div>
        </div>
        <div class="active step active-color">
            <i class="book blue icon"></i>
            <div class="content">
                <div class="title">درس های ترم</div>
            </div>
        </div>
        <div class="step disabled-color">
            <i class="student icon"></i>
            <div class="content">
                <div class="title">پیشنهاد استاد</div>
            </div>
        </div>
    </div>
    @break
    @case('3rd')
    <div class="ui fluid steps">
        <div class="completed step completed-color">
            <i class="hand peace icon"></i>
            <div class="content">
                <div class="title">گذرانده شده ها</div>
            </div>
        </div>
        <div class="completed step completed-color">
            <i class="book icon"></i>
            <div class="content">
                <div class="title">درس های ترم</div>
            </div>
        </div>
        <div class="active step active-color">
            <i class="student blue icon"></i>
            <div class="content">
                <div class="title">پیشنهاد استاد</div>
            </div>
        </div>
    </div>
    @break
@endswitch

