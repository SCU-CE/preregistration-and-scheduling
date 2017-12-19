@extends('layouts.admin')

@section('content')

    <div id="p_admin_settings" style="padding: 1rem">
        <div>
            <form class="ui form" method="post" action="{{ url('/admin/settings/store') }}">

                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="fields">
                    <div class="four wide field">
                        <label class="fw-400">انتخاب ترم جاری </label>
                        <select name="current_semester" class="ui fluid dropdown" autofocus>
                            <option value="">ترم جاری</option>
                            @foreach($semesters as $semester)
                                <option value="{{ $semester->id }}" {{ $semester->id == $options->get(0)->value ? 'selected' : '' }}>
                                    {{ $semester->semester }} {{str_replace(array('0','1','2','3','4','5','6','7','8','9'),array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'),$semester->year)}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="four wide field">
                        <label class="fw-400">حداقل سال ورودی</label>
                        <input name="min_entry_year" placeholder="حداقل سال ورودی" type="text" value="{{ $options->get(1)->value }}">
                    </div>
                    <div class="four wide field">
                        <label class="fw-400">حداکثر سال ورودی</label>
                        <input name="max_entry_year" placeholder="حداکثر سال ورودی" type="text" value="{{ $options->get(2)->value }}">
                    </div>
                    <div class="four wide field">
                        <label class="fw-400">حداکثر واحد مجاز</label>
                        <input name="max_register_units" placeholder="حداکثر واحد مجاز" type="text" value="{{ $options->get(3)->value }}">
                    </div>
                </div>
                <div class="fields">
                    <div class="four wide field">
                        <label class="fw-400">تاریخ شروع پیش ثبت نام</label>
                        <input name="prereg_start_date_p" placeholder="انتخاب تاریخ" type="text">
                        <input name="prereg_start_date" type="hidden" value="{{$options->get(6)->value}}">
                    </div>
                    <div class="four wide field">
                        <label class="fw-400">تاریخ پایان پیش ثبت نام</label>
                        <input name="prereg_end_date_p" placeholder="انتخاب تاریخ" type="text">
                        <input name="prereg_end_date" type="hidden" value="{{$options->get(7)->value}}">
                    </div>
                    <div class="four wide field">
                        <label class="fw-400">تاریخ شروع ارزیابی</label>
                        <input name="eval_start_date_p" placeholder="انتخاب تاریخ" type="text">
                        <input name="eval_start_date" type="hidden" value="{{$options->get(8)->value}}">
                    </div>
                    <div class="four wide field">
                        <label class="fw-400">تاریخ پایان ارزیابی</label>
                        <input name="eval_end_date_p" placeholder="انتخاب تاریخ" type="text">
                        <input name="eval_end_date" type="hidden" value="{{$options->get(9)->value}}">
                    </div>
                </div>
                <div class="fields">
                    <div class="four wide field">
                        <label class="fw-400">تاریخ ارائه ی برنامه نهایی</label>
                        <input name="final_date_p" placeholder="انتخاب تاریخ" type="text">
                        <input name="final_date" type="hidden" value="{{$options->get(10)->value}}">
                    </div>
                    <div class="four wide field">
                        <label class="fw-400">مرحله فعالیت سیستم</label>
                        <select name="process_stage" class="ui fluid dropdown">
                            <option value="disable"{{ $options->get(4)->value == 'disable' ? ' selected' : '' }}>عدم فعالیت</option>
                            <option value="1st"{{ $options->get(4)->value == '1st' ? ' selected' : '' }}>پیش ثبت نام</option>
                            <option value="2nd"{{ $options->get(4)->value == '2nd' ? ' selected' : '' }}>ارزیابی برنامه</option>
                            <option value="3rd"{{ $options->get(4)->value == '3rd' ? ' selected' : '' }}>برنامه نهایی</option>
                        </select>
                    </div>
                    <div class="four wide field">
                        <label class="fw-400">وضعیت مرحله</label>
                        <select name="process_stage_state" class="ui fluid dropdown">
                            <option value="enable"{{ $options->get(11)->value == 'enable' ? ' selected' : '' }}>فعال</option>
                            <option value="disable"{{ $options->get(11)->value == 'disable' ? ' selected' : '' }}>غیرفعال</option>
                        </select>
                    </div>
                    <div class="four wide field">
                        <label class="fw-400">&nbsp</label>
                        <button type="submit" class="ui fluid green submit button fw-400">ذخیره اطلاعات</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="ui hidden divider"></div>
        <div class="ui divider"></div>
        <div class="ui hidden divider"></div>
        <div>
            <form class="ui form{{ $errors->change_password->any() ? ' error' : '' }}" role="form" method="POST" action="{{ url('/admin/settings/changepassword') }}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="fields">
                    <div class="four wide field{{ $errors->change_password->has('old_password') ? ' error' : '' }}">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input name="old_password" placeholder="رمز عبور قبلی" type="password" required>
                        </div>
                    </div>
                    <div class="four wide field{{ $errors->change_password->has('password') ? ' error' : '' }}">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input name="password" placeholder="رمز عبور جدید" type="password" required>
                        </div>
                    </div>
                    <div class="four wide field{{ $errors->change_password->has('password_confirmation') ? ' error' : '' }}">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input name="password_confirmation" placeholder="تکرار رمز عبور جدید" type="password" required>
                        </div>
                    </div>
                    <div class="four wide field">
                        <button type="submit" class="ui fluid yellow submit button fw-400">تغییر رمز عبور</button>
                    </div>
                </div>
                <div class="ui error message">
                    @if ($errors->change_password->any())
                        <ul class="list">
                            @foreach ($errors->change_password->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </form>
        </div>
        <div class="ui hidden divider"></div>
        <div class="ui divider"></div>
        <div class="ui hidden divider"></div>
        <div id="manage_admin_panel">
            @if(Session::has('message'))
                <div class="ui {{ Session::get('message_color') }} message session" style="text-align: center">
                    <i class="close icon"></i>
                    <div class="header fw-300">{{ Session::get('message') }}</div>
                </div>
            @endif
            <table class="ui celled center aligned table">
                <thead>
                <tr>
                    <th>پست الکترونیکی</th>
                    <th>زمان آخرین دسترسی</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="registered_admin_list">
                @foreach(DB::table('users')->where('role','=','admin')->orderBy('last_visit_time','desc')->get() as $admin)
                    <tr id="admin_{{ $admin->id }}">
                        <td>{{ $admin->email }}</td>
                        <td style="direction: ltr;">
                            <?php $lvt = new \Carbon\Carbon($admin->last_visit_time); ?>
                            {{ $lvt->diffForHumans(\Carbon\Carbon::now()) }}
                        </td>
                        <td>
                            <div data-id="{{ $admin->id }}" class="ui red button fw-400">
                                <span>حذف</span>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <form class="ui form{{ $errors->register_admin->any() ? ' error' : '' }}" role="form" method="POST" action="{{ url('/admin/settings/registeradmin') }}">
                {{ csrf_field() }}
                <div class="fields">
                    <div class="four wide field{{ $errors->register_admin->has('email') ? ' error' : '' }}">
                        <div class="ui left icon input">
                            <i class="mail icon"></i>
                            <input name="email" placeholder="پست الکترونیکی" type="email" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="four wide field{{ $errors->register_admin->has('password') ? ' error' : '' }}">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input name="password" placeholder="رمز عبور" type="password" class="medium-size" required>
                        </div>
                    </div>
                    <div class="four wide field{{ $errors->register_admin->has('password_confirmation') ? ' error' : '' }}">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input name="password_confirmation" placeholder="تکرار رمز عبور" type="password" class="medium-size" required>
                        </div>
                    </div>
                    <div class="four wide field">
                        <button type="submit" class="ui fluid purple submit button fw-400">ثبت مدیر جدید</button>
                    </div>
                </div>
                <div class="ui error message">
                    @if ($errors->register_admin->any())
                        <ul class="list">
                            @foreach ($errors->register_admin->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </form>
        </div>
        <div class="ui dimmer modals page transition hidden">
            <div id="delete_admin" class="ui small modal transition hidden">
                <div class="header fw-400">
                    <span>آیا از حذف این مدیر مطمئن هستید؟</span>
                </div>
                <form action="{{url('/admin/settings/')}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>

                <div class="content">
                    <table class="ui celled fixed center aligned table">
                        <thead>
                        <tr>
                            <th>پست الکترونیکی</th>
                            <th>زمان آخرین دسترسی</th>
                        </tr>
                        </thead>
                        <tbody>
                            <td></td>
                            <td></td>
                        </tbody>
                    </table>
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