@switch($active)
    @case('1st')
    <div class="ui fluid steps">
        <div class="active step active-color">
            <i class="checked calendar blue icon"></i>
            <div class="content">
                <div class="title">برنامه ریزی اولیه</div>
            </div>
        </div>
        <div class="step disabled-color">
            <i class="thumbs up outline icon"></i>
            <div class="content">
                <div class="title">ارزیابی برنامه</div>
            </div>
        </div>
        <div class="step disabled-color">
            <i class="flag icon"></i>
            <div class="content">
                <div class="title">برنامه نهایی</div>
            </div>
        </div>
    </div>
    @break
    @case('2nd')
    <div class="ui fluid steps">
        <div class="completed step completed-color">
            <i class="checked calendar green icon"></i>
            <div class="content">
                <div class="title">برنامه ریزی اولیه</div>
            </div>
        </div>
        <div class="active step active-color">
            <i class="thumbs up outline blue icon"></i>
            <div class="content">
                <div class="title">ارزیابی برنامه</div>
            </div>
        </div>
        <div class="step disabled-color">
            <i class="flag icon"></i>
            <div class="content">
                <div class="title">برنامه نهایی</div>
            </div>
        </div>
    </div>
    @break
    @case('3rd')
    <div class="ui fluid steps">
        <div class="completed step completed-color">
            <i class="checked calendar green icon"></i>
            <div class="content">
                <div class="title">برنامه ریزی اولیه</div>
            </div>
        </div>
        <div class="completed step completed-color">
            <i class="thumbs up outline green icon"></i>
            <div class="content">
                <div class="title">ارزیابی برنامه</div>
            </div>
        </div>
        <div class="active step active-color">
            <i class="flag blue icon"></i>
            <div class="content">
                <div class="title">برنامه نهایی</div>
            </div>
        </div>
    </div>
    @break
@endswitch

