@extends('layouts.admin')

@section('content')

    <div id="p_admin_courses">
        <div class="ui green segment">
            <form class="ui form{{ $errors->store->any() ? ' error' : '' }}" method="POST" action="{{ url('admin/course') }}">

                {{ csrf_field() }}

                <div class="fields">
                    <div class="eight wide field{{ $errors->store->has('course_name') ? ' error' : '' }}">
                        <label for="course_name">نام درس</label>
                        <input type="text" name="course_name" placeholder="نام درس" value="{{ $errors->store->any() ? old('course_name') : '' }}" autofocus>
                    </div>
                    <div class="four wide field{{ $errors->store->has('course_code') ? ' error' : '' }}">
                        <label for="course_code">کد درس</label>
                        <input type="text" name="course_code" placeholder="کد درس" value="{{ $errors->store->any() ? old('course_code') : '' }}">
                    </div>
                    <div class="four wide field{{ $errors->store->has('units') ? ' error' : '' }}">
                        <label for="units">تعداد واحد</label>
                        <input type="text" name="units" placeholder="تعداد واحد" value="{{ $errors->store->any() ? old('units') : '' }}">
                    </div>
                </div>
                <div class="fields">
                    <div class="five wide field{{ $errors->store->has('default_min_capacity_fall') ? ' error' : '' }}">
                        <label for="default_min_capacity_fall">حداقل ظرفیت پاییز</label>
                        <input type="text" name="default_min_capacity_fall" placeholder="حداقل ظرفیت پاییز" value="{{ $errors->store->any() ? old('default_min_capacity_fall') : '10' }}">
                    </div>
                    <div class="five wide field{{ $errors->store->has('default_min_capacity_spring') ? ' error' : '' }}">
                        <label for="default_min_capacity_spring">حداقل ظرفیت بهار</label>
                        <input type="text" name="default_min_capacity_spring" placeholder="حداقل ظرفیت بهار" value="{{ $errors->store->any() ? old('default_min_capacity_spring') : '10' }}">
                    </div>
                    <div class="six wide field{{ $errors->store->has('category') ? ' error' : '' }}">
                        <label for="category">دسته‌بندی درس</label>
                        <select name="category" class="ui dropdown">
                            <option value="">دسته‌بندی درس</option>
                            <option value="درس پایه"{{ $errors->store->any() && old('category') == 'درس پایه' ? ' selected' : '' }}>درس پایه</option>
                            <option value="درس اصلی"{{ $errors->store->any() && old('category') == 'درس اصلی' ? ' selected' : '' }}>درس اصلی</option>
                            <option value="درس اختیاری"{{ $errors->store->any() && old('category') == 'درس اختیاری' ? ' selected' : '' }}>درس اختیاری</option>
                            <option value="آزمایشگاه"{{ $errors->store->any() && old('category') == 'آزمایشگاه' ? ' selected' : '' }}>آزمایشگاه</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="ui fluid green submit button fw-300">ثبت درس</button>
                <div class="ui error message">
                    @if ($errors->store->any())
                        <ul class="list">
                            @foreach ($errors->store->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </form>
        </div>

        @if(count($courses)>0)
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
                        <th>نام درس</th>
                        <th>کد درس</th>
                        <th>واحد</th>
                        <th>پاییز</th>
                        <th>بهار</th>
                        <th>دسته‌بندی</th>
                        <th>ویرایش / حذف</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr id="course_{{$course->id}}">
                        <td>{{$course->name}}</td>
                        <td>{{$course->code}}</td>
                        <td>{{$course->units}}</td>
                        <td>{{$course->default_min_capacity_fall}}</td>
                        <td>{{$course->default_min_capacity_spring}}</td>
                        <td>{{$course->category}}</td>
                        <td>
                            <div class="ui orange button fw-300" data-id="{{$course->id}}">ویرایش</div>
                            <div class="ui red button fw-300" data-id="{{$course->id}}">حذف</div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <div class="ui dimmer modals page transition hidden">
            <div id="edit_course" class="ui tiny longer modal transition hidden" data-error="{{ $errors->update->any() ? 'true' : 'false'}}">
                <form class="ui form{{ $errors->update->any() ? ' error' : '' }}" method="POST" action="{{ url('admin/course') }}{{ Session::has('course_id') ? '/'.Session::get('course_id') : '' }}">

                    <div class="scrolling content">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="field{{ $errors->update->has('course_name') ? ' error' : '' }}">
                            <label for="course_name">نام درس</label>
                            <input type="text" name="course_name" placeholder="نام درس" value="{{ $errors->update->any() ? old('course_name') : '' }}" autofocus>
                        </div>
                        <div class="field{{ $errors->update->has('course_code') ? ' error' : '' }}">
                            <label for="course_code">کد درس</label>
                            <input type="text" name="course_code" placeholder="کد درس" value="{{ $errors->update->any() ? old('course_code') : '' }}">
                        </div>
                        <div class="field{{ $errors->update->has('units') ? ' error' : '' }}">
                            <label for="units">تعداد واحد</label>
                            <input type="text" name="units" placeholder="تعداد واحد" value="{{ $errors->update->any() ? old('units') : '' }}">
                        </div>
                        <div class="field{{ $errors->update->has('default_min_capacity_fall') ? ' error' : '' }}">
                            <label for="default_min_capacity_fall">حداقل ظرفیت پاییز</label>
                            <input type="text" name="default_min_capacity_fall" placeholder="حداقل ظرفیت پاییز" value="{{ $errors->update->any() ? old('default_min_capacity_fall') : '' }}">
                        </div>
                        <div class="field{{ $errors->update->has('default_min_capacity_spring') ? ' error' : '' }}">
                            <label for="default_min_capacity_spring">حداقل ظرفیت بهار</label>
                            <input type="text" name="default_min_capacity_spring" placeholder="حداقل ظرفیت بهار" value="{{ $errors->update->any() ? old('default_min_capacity_spring') : '' }}">
                        </div>
                        <div class="field{{ $errors->update->has('category') ? ' error' : '' }}">
                            <label for="category">دسته‌بندی درس</label>
                            <select name="category" class="ui dropdown">
                                <option value="">دسته‌بندی درس</option>
                                <option value="درس پایه"{{ $errors->update->any() && old('category') == 'درس پایه' ? ' selected' : '' }}>درس پایه</option>
                                <option value="درس اصلی"{{ $errors->update->any() && old('category') == 'درس اصلی' ? ' selected' : '' }}>درس اصلی</option>
                                <option value="درس اختیاری"{{ $errors->update->any() && old('category') == 'درس اختیاری' ? ' selected' : '' }}>درس اختیاری</option>
                                <option value="آزمایشگاه"{{ $errors->update->any() && old('category') == 'آزمایشگاه' ? ' selected' : '' }}>آزمایشگاه</option>
                            </select>
                        </div>

                        <div class="ui error message">
                            @if ($errors->update->any())
                                <ul class="list">
                                    @foreach ($errors->update->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                    </div>

                    <div class="actions">
                        <div class="ui negative right labeled icon button fw-300">
                            انصراف
                            <i class="remove icon"></i>
                        </div>

                        <button type="submit" class="ui positive right labeled icon button fw-300">
                            ویرایش
                            <i class="checkmark icon"></i>
                        </button>
                    </div>

                </form>
            </div>
            <div id="delete_course" class="ui tiny modal transition hidden">
                <div class="header fw-300">
                    آیا از حذف این درس مطمئن هستید؟
                </div>

                <div class="content">
                    <table class="ui celled table">
                        <thead>
                        <tr>
                            <th>نام درس</th>
                            <th>کد درس</th>
                            <th>تعداد واحد</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="actions">
                    <form class="ui" method="POST" action="{{ url('admin/course') }}">
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