@extends('layouts.admin')

@section('content')

    <div id="p_admin_query_builder">
        <div class="ui massive stackable fluid two item menu">
            <a class="blue item" href="{{url('admin/reports')}}">
                <i class="star large icon"></i>
                <span>پرس و جو ها</span>
            </a>
            <a class="green item active" href="{{url('admin/query-builder')}}">
                <i class="idea large icon"></i>
                <span>پرس و جو ساز</span>
            </a>
        </div>
        <div class="ui green segment">
            @if(Session::has('message'))
                <div class="ui {{ Session::get('message_color') }} message session" style="text-align: center">
                    <i class="close icon"></i>
                    <div class="header fw-300">{{ Session::get('message') }}</div>
                </div>
            @endif
            <form id="create_query" class="ui form" action="{{url('admin/query')}}" method="post">
                {{ csrf_field() }}
                <div class="fields">
                    <div class="six wide field">
                        <label class="fw-400">نام پرس و جو</label>
                        <input type="text" name="name" placeholder="نام پرس و جو" required>
                    </div>
                    <div class="ten wide field">
                        <label class="fw-400">شرح پرس و جو</label>
                        <input type="text" name="description" placeholder="شرح پرس و جو">
                    </div>
                </div>
                <div class="field">
                    <label class="fw-400">پرس و جوی اصلی</label>
                    <textarea name="query" rows="3" style="direction: ltr" placeholder="SELECT statement with ${p1},${p2},.. as parameters" required></textarea>
                </div>
                <div>
                    <div id="remove_column" style="position: absolute; z-index: 1000; margin-top: 1.6rem; margin-left: -90px;">
                        <a class="circular ui big red icon button" data-tooltip="حذف آخرین ستون" data-position="top center">
                            <i class="icon minus"></i>
                        </a>
                    </div>
                    <div id="add_column" style="position: absolute; z-index: 1000; margin-top: 1.6rem; margin-left: -46px;">
                        <a class="circular ui big blue icon button" data-tooltip="افزودن ستون جدید" data-position="top center">
                            <i class="icon plus"></i>
                        </a>
                    </div>
                </div>
                <input type="hidden" name="number_of_columns" value="1">
                <div id="query_columns" class="ui six column grid">
                    <div class="column" data-number="1">
                        <input type="text" name="column_id_1" placeholder="'id' of column 1"  style="direction: ltr" required>
                        <input type="text" name="column_name_1" placeholder="'نام فارسی' ستون 1" required>
                    </div>
                </div>
                <input type="hidden" name="number_of_parameters" value="0">
                <div>
                    <div id="parameters"></div>
                    <div id="remove_parameter" style="margin-top: -57px; right: -112px; position: absolute">
                        <a class="circular ui big red icon button" data-tooltip="حذف آخرین پارامتر" data-position="top center">
                            <i class="icon minus"></i>
                        </a>
                    </div>
                    <div id="add_parameter" style="margin-top: -57px; right: -68px; position: absolute">
                        <a class="circular ui big green icon button" data-tooltip="افزودن پارامتر جدید" data-position="top center">
                            <i class="icon plus"></i>
                        </a>
                    </div>
                </div>
                <div id="view_database" class="ui yellow icon button" style="display: inline-block" data-tooltip="نقشه پایگاه داده" data-position="bottom center">
                    <i class="database icon"></i>
                </div>
                <button type="submit" class="ui green right labeled icon button fw-400">
                    <i class="plus icon"></i>
                    <spna>ذخیره پرس و جو</spna>
                </button>
            </form>
        </div>
        <div class="ui dimmer modals page transition hidden">
            <div id="database_map" class="ui longer modal transition hidden">
                <div class="scrolling content">
                    <img class="ui image" src="{{Storage::url('database.png')}}" alt="">
                </div>
                <div class="actions">
                    <div class="ui negative right labeled icon button fw-300">
                        <span>انصراف</span>
                        <i class="remove icon"></i>
                    </div>
                    <a class="ui blue right labeled icon button fw-300" target="_blank" href="{{Storage::url('database.png')}}">
                        <span>مشاهده در صفحه جدید</span>
                        <i class="external icon"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection