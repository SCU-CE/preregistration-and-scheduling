<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>


    <!-- Desktop Menu -->
    <div class="ui computer menu">
        <div class="ui container">
            <a href="{{ url('admin/home') }}">
                <button class="ui basic icon button" data-tooltip="خانه" data-position="bottom left">
                    <i class="large home icon"></i>
                </button>
            </a>
            <div class="five-px-element"></div>
            <a href="{{ url('admin/courses') }}">
                <button class="ui basic icon button" data-tooltip="درس ها" data-position="bottom left">
                    <i class="large book icon"></i>
                </button>
            </a>
            <div class="five-px-element"></div>
            <a href="{{ url('admin/instructors') }}">
                <button class="ui basic icon button" data-tooltip="استاد ها" data-position="bottom left">
                    <i class="large student icon"></i>
                </button>
            </a>
            <div class="five-px-element"></div>
            <a href="{{ url('admin/semesters') }}">
                <button class="ui basic icon button" data-tooltip="ترم ها" data-position="bottom left">
                    <i class="large road icon"></i>
                </button>
            </a>
            <div class="five-px-element"></div>
            <a href="{{ url('admin/students') }}">
                <button class="ui basic icon button" data-tooltip="دانشجو ها" data-position="bottom left">
                    <i class="large user icon"></i>
                </button>
            </a>
            <div class="five-px-element"></div>
            <a href="{{ url('admin/reports') }}">
                <button class="ui basic icon button" data-tooltip="گزارش گیری" data-position="bottom left">
                    <i class="large pie chart icon"></i>
                </button>
            </a>
            <div class="five-px-element"></div>
            <a href="{{ url('admin/scheduling') }}">
                <button class="ui basic icon button" data-tooltip="برنامه ریزی" data-position="bottom left">
                    <i class="large calendar icon"></i>
                </button>
            </a>
            <div class="five-px-element"></div>
            <a href="{{ url('admin/messages') }}">
                <button class="ui basic icon button" data-tooltip="پیام ها" data-position="bottom left">
                    <i class="large comment icon"></i>
                </button>
            </a>
            <div class="five-px-element"></div>
            <a href="{{ url('admin/settings') }}">
                <button class="ui basic icon button" data-tooltip="تنظیمات" data-position="bottom left">
                    <i class="large setting icon"></i>
                </button>
            </a>
            <div class="five-px-element"></div>

            <div class="right menu">
                <button class="ui basic icon button" data-tooltip="arash.e.alikhani@gmail.com" data-position="bottom right">
                    <i class="big user circle icon"></i>
                </button>
                <div class="five-px-element"></div>
                <button class="ui basic logout icon button" data-tooltip="خروج" data-position="bottom right">
                    <i class="big flipped sign out icon"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="ui mobile menu">
        <div class="ui container">
            <button id="sidebar_btn" class="ui basic icon button">
                <i class="large sidebar icon"></i>
            </button>
            <div class="five-px-element"></div>

            <div class="right menu">
                <button id="user_btn" class="ui basic icon button"  data-tooltip="arash.e.alikhani@gmail.com" data-position="bottom right">
                    <i class="large user circle icon"></i>
                </button>
                <div class="five-px-element"></div>
                <button class="ui basic logout icon button" data-tooltip="خروج" data-position="bottom right">
                    <i class="large flipped sign out icon"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="ui mobile vertical menu transition hidden">
        <a class="item" href="{{ url('admin/home') }}">
            <i class="large home grey icon"></i>
            <span>خانه</span>
        </a>
        <a class="item" href="{{ url('admin/courses') }}">
            <i class="large book grey icon"></i>
            <span>درس ها</span>
        </a>
        <a class="item" href="{{ url('admin/instructors') }}">
            <i class="large student grey icon"></i>
            <span>استاد ها</span>
        </a>
        <a class="item" href="{{ url('admin/semesters') }}">
            <i class="large road grey icon"></i>
            <span>ترم ها</span>
        </a>
        <a class="item" href="{{ url('admin/students') }}">
            <i class="large user grey icon"></i>
            <span>دانشجو ها</span>
        </a>
        <a class="item" href="{{ url('admin/reports') }}">
            <i class="large pie chart grey icon"></i>
            <span>گزارش گیری</span>
        </a>
        <a class="item" href="{{ url('admin/scheduling') }}">
            <i class="large calendar grey icon"></i>
            <span>برنامه ریزی</span>
        </a>
        <a class="item" href="{{ url('admin/messages') }}">
            <i class="large comment grey icon"></i>
            <span>پیام ها</span>
        </a>
        <a class="item" href="{{ url('admin/settings') }}">
            <i class="large setting grey icon"></i>
            <span>تنظیمات</span>
        </a>
    </div>

    <!-- Logout Form -->
    <form id="logout_form" action="{{url('/logout')}}" method="POST">
        {{ csrf_field() }}
    </form>

    <!-- Content -->
    <div class="ui container">
        <div class="ui segment">

            @yield('content')

        </div>
    </div>

    <!-- Footer -->
    @include('components.public-footer')

    <!-- Scripts -->
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
