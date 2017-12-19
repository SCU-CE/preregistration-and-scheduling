@extends('layouts.admin')

@section('content')

    <div id="p_admin_reports">
        <div class="ui massive stackable fluid two item menu">
            <a class="blue item active" href="{{url('admin/reports')}}">
                <i class="star large icon"></i>
                <span>پرس و جو ها</span>
            </a>
            <a class="green item" href="{{url('admin/query-builder')}}">
                <i class="idea large icon"></i>
                <span>پرس و جو ساز</span>
            </a>
        </div>
        <div class="ui blue segment">
            @if(Session::has('message'))
                <div class="ui {{ Session::get('message_color') }} message session" style="text-align: center">
                    <i class="close icon"></i>
                    <div class="header fw-300">{{ Session::get('message') }}</div>
                </div>
            @endif
            @if(count($queries)>0)
                @foreach($queries as $query)
                    @if($query->description == null)
                    <span class="ui basic big query label fluid fw-400">
                    @else
                    <span class="ui basic big query label fluid fw-400" data-tooltip="{{$query->description}}" data-position="bottom left">
                    @endif
                        <div class="ui inverted dimmer">
                            <div class="ui loader"></div>
                        </div>
                        <span style="float: right;padding: .8rem 0;">
                            <span>{{$query->name}}</span>
                        </span>
                        <span style="float: left">
                            <button class="ui large green icon button" data-id="{{$query->id}}" data-tooltip="بارگذاری" data-position="bottom center">
                            <i class="folder open icon"></i>
                        </button>
                            <button class="ui large orange icon button" data-id="{{$query->id}}" data-tooltip="ویرایش" data-position="bottom center">
                                <i class="write icon"></i>
                            </button>
                            <button class="ui large red icon button" data-id="{{$query->id}}" data-tooltip="حذف" data-position="bottom center">
                                <i class="trash icon"></i>
                            </button>
                        </span>
                    </span>
                @endforeach
            @else
                <div style="text-align: center">
                    <div><i class="meh huge icon"></i></div>
                    <h2 class="fw-400" style="margin-top: .75rem">هیچ پرس و جویی در سامانه موجود نیست!</h2>
                </div>
            @endif
        </div>
        <div id="query_view"></div>
        <div class="ui dimmer modals page transition hidden">
            <div id="query_result" class="ui longer modal transition hidden">
                <div class="scrolling content">
                </div>
                <div class="actions">
                    <div class="ui negative right labeled icon button fw-300">
                        <span>انصراف</span>
                        <i class="remove icon"></i>
                    </div>
                </div>
            </div>
            <div id="edit_query" class="ui large modal transition hidden">
                <div class="content">

                </div>
                <div class="actions">
                    <div class="ui negative right labeled icon button fw-300">
                        <span>انصراف</span>
                        <i class="remove icon"></i>
                    </div>
                    <div class="ui positive right labeled icon button fw-300">
                        <span>ویرایش پرس و جو</span>
                        <i class="write icon"></i>
                    </div>
                </div>
            </div>
            <div id="delete_query" class="ui tiny modal transition hidden">
                <div class="header fw-400">
                    <span>آیا از حذف این پرس جو مطمئن هستید؟</span>
                </div>
                <div class="content">
                    <span class="ui basic big label fluid fw-400" style="text-align: center;padding: 1rem;line-height: 2.5rem;">
                        <span></span>
                    </span>
                    <form action="" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                    </form>
                </div>
                <div class="actions">
                    <div class="ui negative right labeled icon button fw-300">
                        <span>انصراف</span>
                        <i class="remove icon"></i>
                    </div>
                    <div class="ui positive right labeled icon button fw-300">
                        <span>تایید</span>
                        <i class="remove icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection