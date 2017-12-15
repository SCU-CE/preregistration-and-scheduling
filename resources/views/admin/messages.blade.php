@extends('layouts.admin')

@section('content')

    <div id="p_admin_messages">
        <div id="messages_menu" class="ui massive stackable fluid four item menu">
            <a class="blue item active" data-state="inbox">
                <i class="inbox large icon"></i>
                <span>ورودی ها</span>
            </a>
            <a class="orange item" data-state="star">
                <i class="star large icon"></i>
                <span>ستاره دارها</span>
            </a>
            <a class="green item" data-state="later">
                <i class="wait large icon"></i>
                <span>برای بعد</span>
            </a>
            <a class="brown item" data-state="archive">
                <i class="archive large icon"></i>
                <span>آرشیو شده</span>
            </a>
        </div>
        <div>
            <div id="messages_dimmer" class="ui inverted dimmer">
                <div class="ui massive loader"></div>
            </div>
            <div id="messages_list">
                @if(count($messages)>0)
                    @include('components.feedback-cards', ['messages' => $messages])
                @endif
            </div>
            <div id="no_messages" style="display:{{count($messages) > 0 ? 'none' : 'block'}}">
                <h1 class="ui center aligned icon header grey">
                    <i class="massive mail outline icon"></i>
                    <span>هیچ پیامی در این صندوق وجود ندارد!</span>
                </h1>
            </div>
        </div>
        <div class="ui dimmer modals page transition hidden">
            <div class="ui small modal transition hidden">
                <div class="header fw-400">
                    از حذف این پیام مطمئن هستید؟
                </div>

                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <div class="content">

                </div>
                <div class="actions">
                    <div class="ui negative right labeled icon button fw-300">
                        خیر
                        <i class="remove icon"></i>
                    </div>
                    <div class="ui positive right labeled icon button fw-300">
                        بله
                        <i class="checkmark icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection