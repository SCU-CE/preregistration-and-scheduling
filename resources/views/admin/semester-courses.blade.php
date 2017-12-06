@extends('layouts.admin')

@section('content')

    <div id="p_admin_semester_courses">
        <div class="ui {{$color}} segment">
            <div class="ui breadcrumb">
                <a class="section fw-300" href="{{url('admin/semesters')}}">ترم ها</a>
                <i class="left chevron icon divider"></i>
                <div class="active section fw-300">
                    <span>درس های ترم </span><span>{{$semester->semester . ' ' . $semester->year}}</span>
                </div>
            </div>
        </div>
        @if(count($courses) > 0)
        <div class="ui segment">
            <table class="ui striped celled definition padded center aligned table">
                <thead>
                <tr>
                    <th></th>
                    <th>نام درس</th>
                    <th>کد درس</th>
                    <th>تعداد واحد</th>
                    <th>دسته‌بندی</th>
                    <th>حداقل ظرفیت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr id="{{$course->id}}">
                        <td class="collapsing">
                            <div class="ui toggle checkbox">
                                <input type="checkbox" {{ $course->offered($semester) ? ' checked' : '' }}>
                                <label></label>
                            </div>
                        </td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->code }}</td>
                        <td>{{ $course->units }}</td>
                        <td>{{ $course->category }}</td>
                        <td>
                            <div class="ui fluid input{{!$course->offered($semester) ? ' disabled' : ''}}">
                                <input type="text" tabindex="{{$loop->index+1}}" value="{{$course->offered($semester) ? $course->min_capacity($semester) : ($color == 'green' ? $course->default_min_capacity_spring : $course->default_min_capacity_fall)}}">
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="display: flow-root">
            <div id="deselect_all" class="ui red left floated button fw-300">
                <span>حذف همه</span>
            </div>
            <div id="select_all" class="ui blue left floated button fw-300">
                <span>انتخاب همه</span>
            </div>

            <div id="submit_changes" class="ui green right floated button fw-300">
                <span>اعمال تغییرات</span>
            </div>
            <a href="{{url('admin/semesters')}}">
                <div class="ui teal right floated button fw-300">
                    <span>بازگشت</span>
                </div>
            </a>
        </div>
        @endif
    </div>

@endsection