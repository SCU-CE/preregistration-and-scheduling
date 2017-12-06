@extends('layouts.admin')

@section('content')

    <div id="p_admin_instructors">
        <div class="ui green segment">
            <form class="ui form{{ $errors->store->any() ? ' error' : '' }}" method="POST" enctype="multipart/form-data" action="{{ url('admin/instructor') }}">

                {{ csrf_field() }}

                <div class="fields">
                    <div class="ten wide field{{ $errors->store->has('instructor_name') ? ' error' : '' }}">
                        <label for="instructor_name">نام استاد</label>
                        <input type="text" name="instructor_name" placeholder="نام استاد" value="{{ $errors->store->any() ? old('instructor_name') : '' }}" autofocus>
                    </div>
                    <div class="six wide field{{ $errors->store->has('sex') ? ' error' : '' }}">
                        <label for="sex">جنسیت</label>
                        <select name="sex" class="ui dropdown">
                            <option value="">جنسیت</option>
                            <option value="مرد"{{ $errors->store->any() && old('sex') == 'مرد' ? ' selected' : '' }}>مرد</option>
                            <option value="زن"{{ $errors->store->any() && old('sex') == 'زن' ? ' selected' : '' }}>زن</option>
                        </select>
                    </div>
                </div>
                <div class="fields">
                    <div class="eight wide field{{ $errors->store->has('profile_link') ? ' error' : '' }}">
                        <label for="profile_link">آدرس پروفایل</label>
                        <div class="ui right icon input" data-tooltip="این فیلد می تواند خالی باشد" data-position="right center">
                            <i class="student icon"></i>
                            <input type="text" name="profile_link" placeholder="{{env('DEP_URL','http://engg.scu.ac.ir/')}}name" value="{{ $errors->store->any() ? old('profile_link') : env('DEP_URL','http://engg.scu.ac.ir/') }}">
                        </div>
                    </div>
                    <div class="eight wide field{{ $errors->store->has('photo') ? ' error' : '' }}">
                        <label for="photo">تصویر</label>
                        <input type="file" name="photo" data-tooltip="این فیلد می تواند خالی باشد" data-position="left center">
                    </div>
                </div>
                <button type="submit" class="ui fluid green submit button fw-300">ثبت استاد</button>
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

        @if(count($instructors)>0)
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
                        <th>نام استاد</th>
                        <th>جنسیت</th>
                        <th>آدرس پروفایل</th>
                        <th>تصویر</th>
                        <th>ویرایش / حذف</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($instructors as $instructor)
                    <tr id="instructor_{{$instructor->id}}">
                        <td>{{$instructor->name}}</td>
                        <td>{{$instructor->sex}}</td>
                        <td><a href="{{$instructor->link}}" target="_blank">{{$instructor->link}}</a></td>
                        <td>
                            <img src="{{$instructor->photo != null ? Storage::url($instructor->photo) : ( $instructor->sex == 'مرد' ? Storage::url('instructor_photos/img_male.png') : Storage::url('instructor_photos/img_female.png') )}}" alt="">
                        </td>
                        <td>
                            <div class="ui orange button fw-300" data-id="{{$instructor->id}}">ویرایش</div>
                            <div class="ui red button fw-300" data-id="{{$instructor->id}}">حذف</div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <div class="ui dimmer modals page transition hidden">
            <div id="edit_instructor" class="ui tiny longer edit modal transition hidden" data-error="{{ $errors->update->any() ? 'true' : 'false'}}">
                <form class="ui form{{ $errors->update->any() ? ' error' : '' }}" method="POST" enctype="multipart/form-data"  action="{{ url('admin/instructor') }}{{ Session::has('instructor_id') ? '/'.Session::get('instructor_id') : '' }}">

                    <div class="scrolling content">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="field{{ $errors->update->has('instructor_name') ? ' error' : '' }}">
                            <label for="instructor_name">نام استاد</label>
                            <input type="text" name="instructor_name" placeholder="نام استاد" value="{{ $errors->update->any() ? old('instructor_name') : '' }}" autofocus>
                        </div>
                        <div class="field{{ $errors->update->has('sex') ? ' error' : '' }}">
                            <label for="sex">جنسیت</label>
                            <select name="sex" class="ui dropdown">
                                <option value="">جنسیت</option>
                                <option value="مرد"{{ $errors->update->any() && old('sex') == 'مرد' ? ' selected' : '' }}>مرد</option>
                                <option value="زن"{{ $errors->update->any() && old('sex') == 'زن' ? ' selected' : '' }}>زن</option>
                            </select>
                        </div>
                        <div class="field{{ $errors->update->has('profile_link') ? ' error' : '' }}">
                            <label for="profile_link">آدرس پروفایل</label>
                            <div class="ui right icon input">
                                <i class="student icon"></i>
                                <input type="text" name="profile_link" placeholder="{{env('DEP_URL','http://engg.scu.ac.ir/')}}name" value="{{ $errors->update->any() ? old('profile_link') : env('DEP_URL','http://engg.scu.ac.ir/') }}">
                            </div>
                        </div>
                        <div class="field{{ $errors->update->has('photo') ? ' error' : '' }}">
                            <label for="photo">تصویر</label>
                            <input type="file" name="photo">
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
            <div id="delete_instructor" class="ui tiny modal transition hidden">
                <div class="header fw-300">
                    آیا از حذف این استاد مطمئن هستید؟
                </div>

                <div class="content">
                    <table class="ui celled center aligned table">
                        <thead>
                        <tr>
                            <th>نام استاد</th>
                            <th>جنسیت</th>
                            <th>آدرس پروفایل</th>
                            <th>تصویر</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="actions">
                    <form class="ui" method="POST" action="{{ url('admin/instructor') }}">
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