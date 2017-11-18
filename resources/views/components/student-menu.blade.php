<div class="ui computer menu">
    <div class="ui container">
        @if($hasSteps)
            @include('components.steps', ['size' => 'mini', 'fluid' => false, 'active' => $active, 'extraclasses' => ''])
        @endif
        <div class="right menu">
            <div class="five-px-element"></div>
            <button id="user_btn" class="ui basic button">
                <i class="big user icon"></i>
                <span class="fw-300">آرش علیخانی</span>
            </button>
            <div class="five-px-element"></div>
            <button id="logout_btn" class="ui basic icon button">
                <i class="big flipped sign out icon"></i>
            </button>
        </div>
    </div>
</div>
<div class="ui computer menu vertical transition hidden">
    <a class="item">
        <i class="configure icon"></i>
        <span>ویرایش اطلاعات</span>
    </a>
    <a class="item">
        <i class="lock icon"></i>
        <span>تغییر رمز عبور</span>
    </a>
</div>
<div class="ui mobile menu">
    <div class="ui container">
        @if($hasSteps)
        <button id="steps_btn" class="ui basic icon button">
            <i class="large map outline icon"></i>
        </button>
        @endif
        <div class="right menu">
            <div class="five-px-element"></div>
            <button id="user_btn" class="ui basic button">
                <i class="large user icon"></i>
                <span class="fw-300">آرش علیخانی</span>
            </button>
            <div class="five-px-element"></div>
            <button id="logout_btn" class="ui basic icon button">
                <i class="large flipped sign out icon"></i>
            </button>
        </div>
    </div>
</div>
@if($hasSteps)
    @include('components.steps', ['size' => 'mini', 'fluid' => false, 'active' => $active, 'extraclasses' => ' mobile transition hidden'])
@endif
<div class="ui mobile menu vertical tiny transition hidden">
    <a class="item">
        <i class="configure icon"></i>
        <span>ویرایش اطلاعات</span>
    </a>
    <a class="item">
        <i class="lock icon"></i>
        <span>تغییر رمز عبور</span>
    </a>
</div>