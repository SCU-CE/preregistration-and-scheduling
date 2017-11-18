@extends('layouts.admin')

@section('content')


    <div id="p_admin_home">
        <!-- Desktop Menu -->
        <div class="ui computer menu">
            <div class="ui container">
                <button class="ui basic icon button" data-tooltip="خانه" data-position="bottom left">
                    <i class="large home icon"></i>
                </button>
                <div class="five-px-element"></div>
                <button class="ui basic icon button" data-tooltip="درس ها" data-position="bottom left">
                    <i class="large book icon"></i>
                </button>
                <div class="five-px-element"></div>
                <button class="ui basic icon button" data-tooltip="استاد ها" data-position="bottom left">
                    <i class="large student icon"></i>
                </button>
                <div class="five-px-element"></div>
                <button class="ui basic icon button" data-tooltip="ترم ها" data-position="bottom left">
                    <i class="large radio icon"></i>
                </button>
                <div class="five-px-element"></div>
                <button class="ui basic icon button" data-tooltip="دانشجو ها" data-position="bottom left">
                    <i class="large user icon"></i>
                </button>
                <div class="five-px-element"></div>
                <button class="ui basic icon button" data-tooltip="گزارش گیری" data-position="bottom left">
                    <i class="large pie chart icon"></i>
                </button>
                <div class="five-px-element"></div>
                <button class="ui basic icon button" data-tooltip="برنامه ریزی" data-position="bottom left">
                    <i class="large calendar icon"></i>
                </button>

                <div class="five-px-element"></div>
                <button class="ui basic icon button" data-tooltip="پیام ها" data-position="bottom left">
                    <i class="large comment icon"></i>
                </button>
                <div class="five-px-element"></div>
                <button class="ui basic icon button" data-tooltip="تنظیمات" data-position="bottom left">
                    <i class="large setting icon"></i>
                </button>
                <div class="five-px-element"></div>

                <div class="right menu">
                    <button class="ui basic icon button" data-tooltip="arash.e.alikhani@gmail.com" data-position="bottom right">
                        <i class="big user circle icon"></i>
                    </button>
                    <div class="five-px-element"></div>
                    <button class="ui basic icon button" data-tooltip="خروج" data-position="bottom right">
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
                    <button id="logout_btn" class="ui basic icon button" data-tooltip="خروج" data-position="bottom right">
                        <i class="large flipped sign out icon"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="ui mobile vertical menu transition hidden">
            <a class="item">
                <i class="large home icon"></i>
                <span>خانه</span>
            </a>
            <a class="item">
                <i class="large book icon"></i>
                <span>درس ها</span>
            </a>
            <a class="item">
                <i class="large student icon"></i>
                <span>استاد ها</span>
            </a>
            <a class="item">
                <i class="large radio icon"></i>
                <span>ترم ها</span>
            </a>
            <a class="item">
                <i class="large user icon"></i>
                <span>دانشجو ها</span>
            </a>
            <a class="item">
                <i class="large pie chart icon"></i>
                <span>گزارش گیری</span>
            </a>
            <a class="item">
                <i class="large calendar icon"></i>
                <span>برنامه ریزی</span>
            </a>
            <a class="item">
                <i class="large comment icon"></i>
                <span>پیام ها</span>
            </a>
            <a class="item">
                <i class="large setting icon"></i>
                <span>تنظیمات</span>
            </a>
        </div>

        <!-- Content -->
        <div class="ui container">
            <div class="ui segment">



            </div>
        </div>

        <!-- Footer -->
        @include('components.public-footer')
    </div>

@endsection