@extends('layouts.public')

@section('content')

    @if(Agent::isDesktop())
        @include('components.feedback-desktop')
    @endif

    <div id="p_forget">
        <div class="ui center aligned container">
            <div id="forget_panel">
                <h2 class="ui teal header fw-300">
                                        درخواست بازیابی رمز عبور
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

                <form class="ui large form{{ $errors->any() ? ' error' : '' }}" method="POST" action="{{ url('/password/email') }}">

                    {{ csrf_field() }}

                    <div class="ui stacked segment">

                        <div class="field{{ $errors->has('email') ? ' error' : '' }}">
                            <div class="ui left icon large input">
                                <i class="user icon"></i>
                                <input type="text" name="email" placeholder="پست الکترونیکی" value="{{ old('email') }}" autofocus>
                            </div>
                        </div>

                        <button type="submit" class="ui fluid large orange submit button fw-300">فرستادن لینک بازیابی رمز عبور</button>

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

                @include('components.public-footer')
            </div>
        </div>
    </div>
@endsection