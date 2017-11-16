@extends('layouts.public')

@section('content')

    @if(Agent::isDesktop())
        @include('components.feedback-desktop')
    @endif

    <div id="p_register">
        <div class="ui center aligned container">
            <div id="register_panel">
                <h2 class="ui teal header fw-300">
                    ثبت نام در سامانه
                </h2>

                <form class="ui large form{{ $errors->any() ? ' error' : '' }}" method="POST" action="{{ url('/register') }}">

                    {{ csrf_field() }}

                    <div class="ui stacked segment">

                        <div class="field{{ $errors->has('first_name') ? ' error' : '' }}">
                            <div class="ui left icon large input">
                                <i class="user icon"></i>
                                <input type="text" name="first_name" placeholder="نام" value="{{ old('first_name') }}" autofocus>
                            </div>
                        </div>

                        <div class="field{{ $errors->has('last_name') ? ' error' : '' }}">
                            <div class="ui left icon large input">
                                <i class="users icon"></i>
                                <input type="text" name="last_name" placeholder="نام خانوادگی" value="{{ old('last_name') }}">
                            </div>
                        </div>

                        <div class="field{{ $errors->has('student_id') ? ' error' : '' }}">
                            <div class="ui left icon large input">
                                <i class="student icon"></i>
                                <input type="text" name="student_id" placeholder="شماره دانشجویی" value="{{ old('student_id') }}">
                            </div>
                        </div>

                        <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                            <div class="ui left icon large input">
                                <i class="mail icon"></i>
                                <input type="text" name="email" placeholder="پست الکترونیکی" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="field{{ $errors->has('password') ? ' error' : '' }}">
                            <div class="ui left icon large input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" placeholder="رمز عبور">
                            </div>
                        </div>

                        <div class="field{{ $errors->has('password_confirmation') ? ' error' : '' }}">
                            <div class="ui left icon large input">
                                <i class="lock icon"></i>
                                <input type="password" name="password_confirmation" placeholder="تکرار رمز عبور">
                            </div>
                        </div>

                        <div class="field{{ $errors->has('entry_year') ? ' error' : '' }}">
                            <select name="entry_year" class="ui dropdown" value="{{ old('last_name') }}">
                                <option value="">سال ورود</option>
                                @for($i = $min_entry_year; $i <= $max_entry_year; $i++)
                                    <option value="{{ $i }}" {{ $i == old('entry_year') ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <button type="submit" class="ui fluid large green submit button fw-300">ثبت نام در سامانه</button>

                    </div>

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

                <div>
                    <div id="login_btn" class="ui segment">
                        <div class="ui horizontal divider fw-300">قبلا ثبت نام کرده اید؟</div>
                        <a href="{{ url('/login') }}" class="ui fluid large teal button fw-300">ورود به سامانه</a>
                        <div class="ui divider"></div>
                    </div>
                </div>

                <div class="ui hidden divider"></div>
                @include('components.public-footer')
            </div>
        </div>
    </div>
@endsection