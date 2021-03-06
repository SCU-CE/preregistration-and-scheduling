<div class="ui computer menu">
    <div class="ui container">
        @if($hasSteps)
            <a href="{{url('student/home')}}" class="ui basic icon button">
                <i class="big flipped home icon"></i>
            </a>
            <div class="five-px-element"></div>
            @if(in_array($active, ['1st','2nd','3rd']))
                @include('components.steps', ['size' => 'mini', 'fluid' => false, 'active' => $active, 'extraclasses' => ''])
            @endif
        @endif
        <div class="right menu">
            <div class="five-px-element"></div>
            <button id="user_btn"  class="ui basic icon button" data-tooltip="{{Auth::user()->student->first_name . ' ' . Auth::user()->student->last_name}}" data-position="left center">
                <i class="big user icon"></i>
            </button>
            <div class="five-px-element"></div>
            <button id="logout_btn" class="ui basic logout icon button" data-tooltip="خروج" data-position="bottom right">
                <i class="big flipped sign out icon"></i>
            </button>
        </div>
    </div>
</div>
<div class="ui computer menu vertical transition hidden">
    <a class="item" href="{{url('student/edit-information')}}">
        <i class="configure icon"></i>
        <span>ویرایش اطلاعات</span>
    </a>
    <a class="item" href="{{url('student/change-password')}}">
        <i class="lock icon"></i>
        <span>تغییر رمز عبور</span>
    </a>
</div>
<div class="ui mobile menu">
    <div class="ui container">
        @if($hasSteps)
            <a id="home_btn" class="ui basic icon button" href="{{url('student/home')}}">
                <i class="large home icon"></i>
            </a>
            <div class="five-px-element"></div>
            @if(in_array($active, ['1st','2nd','3rd']))
            <button id="steps_btn" class="ui basic icon button">
                <i class="large map outline icon"></i>
            </button>
            @endif
        @endif
        <div class="right menu">
            <div class="five-px-element"></div>
            <button id="user_btn"  class="ui basic icon button" data-tooltip="{{Auth::user()->student->first_name . ' ' . Auth::user()->student->last_name}}" data-position="left center">
                <i class="large user icon"></i>
            </button>
            <div class="five-px-element"></div>
            <button id="logout_btn" class="ui basic logout icon button" data-tooltip="خروج" data-position="bottom right">
                <i class="large flipped sign out icon"></i>
            </button>
        </div>
    </div>
</div>
@if($hasSteps)
    @if(in_array($active, ['1st','2nd','3rd']))
        @include('components.steps', ['size' => 'mini', 'fluid' => false, 'active' => $active, 'extraclasses' => ' mobile transition hidden'])
    @endif
@endif
<div class="ui mobile menu vertical tiny transition hidden">
    <a class="item" href="{{url('student/edit-information')}}">
        <i class="configure icon"></i>
        <span>ویرایش اطلاعات</span>
    </a>
    <a class="item" href="{{url('student/change-password')}}">
        <i class="lock icon"></i>
        <span>تغییر رمز عبور</span>
    </a>
</div>
<!-- Logout Form -->
<form id="logout_form" action="{{url('/logout')}}" method="POST">
    {{ csrf_field() }}
</form>