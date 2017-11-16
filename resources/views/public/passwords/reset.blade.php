@extends('layouts.public')

@section('content')

    @if(Agent::isDesktop())
        @include('components.feedback-desktop')
    @endif

    <div id="p_reset">
        <div class="ui center aligned container">
            <div id="reset_panel">
                <h2 class="ui teal header fw-300">
                                        بازیابی رمز عبور
                </h2>

                @if (session('status'))
                    <div class="ui green message">
                        <i class="close icon"></i>
                        <div class="header fw-300">
                            {{ session('status') }}
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="ui red message">
                        <i class="close icon"></i>
                        <div class="header fw-300">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                <form class="ui large form{{ $errors->any() ? ' error' : '' }}" method="POST" action="{{ url('/password/reset') }}">

                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="ui stacked segment">

                        <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                            <div class="ui left icon large input">
                                <i class="user icon"></i>
                                <input type="text" name="email" placeholder="پست الکترونیکی" value="{{ $email or old('email') }}" autofocus>
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

                        <button type="submit" class="ui fluid large yellow submit button fw-300">تغییر رمز عبور</button>

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