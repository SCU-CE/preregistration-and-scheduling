@extends('layouts.admin')
@section('content')
    <div id="p_admin_students">
        <div class="ui grey segment">
            @if(Session::has('message'))
                <div class="ui {{ Session::get('message_color') }} message">
                    <i class="close icon"></i>
                    <div class="header fw-300">{{ Session::get('message') }}</div>
                </div>
            @endif
            <table class="ui selectable celled striped center aligned table">
                <thead>
                <tr>
                    <th>نام</th>
                    <th>نام خانوادگی</th>
                    <th>شماره دانشجویی</th>
                    <th>پست الکترونیکی</th>
                    <th>سال ورود</th>
                    <th>درس های گرفته شده</th>
                    <th>حذف</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr id="student_{{$student->id}}">
                        <td>{{$student->first_name}}</td>
                        <td>{{$student->last_name}}</td>
                        <td>{{$student->student_id}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{$student->entry_year}}</td>
                        <td>
                            <a href="{{url('admin/student/'.$student->id)}}">
                                <div class="ui blue button fw-300">مشاهده درس ها</div>
                            </a>
                        </td>
                        <td>
                            <div class="ui red button fw-300" data-id="{{$student->id}}">حذف</div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="ui dimmer modals page transition hidden">
            <div id="delete_student" class="ui tiny modal transition hidden">
                <div class="header fw-300">
                    آیا از حذف این دانشجو مطمئن هستید؟
                </div>
                <div class="content">
                    <table class="ui celled center aligned table">
                        <thead>
                        <tr>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>شماره دانشجویی</th>
                            <th>پست الکترونیکی</th>
                            <th>سال ورود</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="actions">
                    <form class="ui" method="POST" action="{{ url('admin/student') }}">
                        <div class="ui negative right labeled icon button fw-300">
                            خیر
                            <i class="remove icon"></i>
                        </div>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="ui positive right labeled icon button fw-300">
                            بله
                            <i class="checkmark icon"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection