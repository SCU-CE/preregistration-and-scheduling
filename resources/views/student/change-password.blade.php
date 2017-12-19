@extends('layouts.student')
@section('content')
    @if(Agent::isDesktop())
        @include('components.feedback-desktop')
    @endif
    <div id="p_student_change_password">
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
                <form class="ui form{{ $errors->any() ? ' error' : '' }}" role="form" method="POST" action="{{url('student/update-password')}}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="field{{ $errors->has('old_password') ? ' error' : '' }}">
                        <label class="fw-400">رمز عبور قبلی</label>
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input name="old_password" placeholder="رمز عبور قبلی" type="password" required>
                        </div>
                    </div>
                    <div class="ui divider"></div>
                    <div class="field{{ $errors->has('password') ? ' error' : '' }}">
                        <label class="fw-400">رمز عبور جدید</label>
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input name="password" placeholder="رمز عبور جدید" type="password" required>
                        </div>
                    </div>
                    <div class="field{{ $errors->has('password_confirmation') ? ' error' : '' }}">
                        <label class="fw-400">تکرار رمز عبور جدید</label>
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input name="password_confirmation" placeholder="تکرار رمز عبور جدید" type="password" required>
                        </div>
                    </div>
                    <button type="submit" class="ui fluid yellow submit button fw-400">تغییر رمز عبور</button>
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