@extends('layouts.student')
@section('content')
    @if(Agent::isDesktop())
        @include('components.feedback-desktop')
    @endif
    <div id="p_student_edit_information">
        <!-- Menu -->
        @include('components.student-menu', ['hasSteps' => true, 'active' => $currentStep])

        <div class="ui container">
            <div class="ui segment" style="max-width: 540px; margin: 0 auto">
                @if(Session::has('message'))
                    <div class="ui {{ Session::get('message_color') }} message session" style="text-align: center">
                        <i class="close icon"></i>
                        <div class="header fw-300">{{ Session::get('message') }}</div>
                    </div>
                @endif
                <form class="ui form{{ $errors->any() ? ' error' : '' }}" role="form" method="POST" action="{{url('student/update-information')}}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="field{{ $errors->has('first_name') ? ' error' : '' }}">
                        <label class="fw-400">نام</label>
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input name="first_name" placeholder="نام" type="text" value="{{ $student->first_name }}" required autofocus>
                        </div>
                    </div>
                    <div class="field{{ $errors->has('last_name') ? ' error' : '' }}">
                        <label class="fw-400">نام خانوادگی</label>
                        <div class="ui left icon input">
                            <i class="users icon"></i>
                            <input name="last_name" placeholder="نام خانوادگی" type="text" value="{{ $student->last_name }}" required>
                        </div>
                    </div>
                    <div class="field{{ $errors->has('student_id') ? ' error' : '' }}">
                        <label class="fw-400">شماره دانشجویی</label>
                        <div class="ui left icon input">
                            <i class="student icon"></i>
                            <input name="student_id" placeholder="شماره دانشجویی" type="text" value="{{ $student->student_id }}" required>
                        </div>
                    </div>
                    <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                        <label class="fw-400">پست الکترونیکی</label>
                        <div class="ui left icon input">
                            <i class="mail icon"></i>
                            <input name="email" placeholder="پست الکترونیکی" type="email" value="{{ $user->email }}" required>
                        </div>
                    </div>
                    <div class="field{{ $errors->has('entry_year') ? ' error' : '' }}">
                        <label class="fw-400">سال ورود</label>
                        <select name="entry_year" class="ui dropdown" required>
                            <option value="">سال ورود</option>
                            @for($i = $min_entry_year; $i <= $max_entry_year; $i++)
                                <option value="{{ $i }}"{{ $i == $student->entry_year ? ' selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="ui divider"></div>
                    <div class="field{{ $errors->has('password') ? ' error' : '' }}">
                        <label class="fw-400">رمز عبور</label>
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input id="password" name="password" placeholder="رمز عبور" type="password" required>
                        </div>
                    </div>
                    <button type="submit" class="ui fluid yellow submit button fw-400">ثبت تغییرات</button>
                    <div class="ui error message">
                        @if ($errors->any())
                            <ul class="list">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        @include('components.public-footer')
    </div>
@endsection