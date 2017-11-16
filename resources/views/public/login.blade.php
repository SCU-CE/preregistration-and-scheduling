@extends('layouts.public')

@section('content')

    @if(Agent::isDesktop())
        @include('components.feedback-desktop')
    @endif

    <div id="p_login">
        <div class="ui center aligned container">
            <div id="login_panel">
                <h2 class="ui teal header fw-300">
                                        سامانه پیش ثبت نام
                </h2>

                <form class="ui large form{{ $errors->any() ? ' error' : '' }}" method="POST" action="{{ url('/login') }}">

                    {{ csrf_field() }}

                    <div class="ui stacked segment">

                        <div class="field{{ ($errors->has('email') || $errors->has('password')) ? ' error' : '' }}">
                            <div class="ui left icon large input">
                                <i class="user icon"></i>
                                <input type="text" name="email" placeholder="پست الکترونیکی" value="{{ old('email') }}" autofocus>
                            </div>
                        </div>

                        <div class="field{{ ($errors->has('email') || $errors->has('password')) ? ' error' : '' }}">
                            <div class="ui left icon large input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" placeholder="رمز عبور">
                            </div>
                        </div>

                        <div id="remember_password" class="field">
                            <div class="ui large checkbox">
                                <input name="remember" type="checkbox">
                                <label class="fw-300">ورود مرا به خاطر بسپار</label>
                            </div>
                        </div>

                        <button type="submit" class="ui fluid large teal submit button fw-300">ورود به سامانه</button>

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
                    <div class="ui segment fw-300">
                        رمز عبور خود را فراموش کرده اید؟
                        <a href="{{ url('/password/reset') }}">بازیابی رمز عبور</a>
                    </div>

                    <div id="register_btn" class="ui segment">
                        <div class="ui horizontal divider fw-300">هنوز ثبت نام نکرده اید؟</div>
                        <a href="{{ url('/register') }}" class="ui fluid large green button fw-300">ثبت نام در سامانه</a>
                        <div class="ui divider"></div>
                    </div>
                </div>

                <div class="ui hidden divider"></div>
                @include('components.public-footer')
            </div>
        </div>
    </div>
@endsection