@extends('layouts.admin')
@section('content')
    <div id="p_admin_semesters">
        <div class="ui green segment">
            <form class="ui form{{ $errors->store->any() ? ' error' : '' }}" method="POST" action="{{ url('admin/semester') }}">
                {{ csrf_field() }}
                <div class="fields">
                    <div class="six wide field{{ $errors->store->has('semester') ? ' error' : '' }}">
                        <label for="semester">نوبت ترم</label>
                        <select name="semester" class="ui dropdown" autofocus>
                            <option value="">نوبت ترم</option>
                            <option value="پاییز"{{ $errors->store->any() && old('semester') == 'پاییز' ? ' selected' : '' }}>پاییز</option>
                            <option value="بهار"{{ $errors->store->any() && old('semester') == 'بهار' ? ' selected' : '' }}>بهار</option>
                        </select>
                    </div>
                    <div class="six wide field{{ $errors->store->has('year') ? ' error' : '' }}">
                        <label for="year">سال ترم</label>
                        <input type="text" name="year" placeholder="سال (مثل 1396)" value="{{ $errors->store->any() ? old('year') : '' }}">
                    </div>
                    <div class="four wide field{{ $errors->store->has('year') ? ' error' : '' }}">
                        <label>&nbsp</label>
                        <button type="submit" class="ui fluid green submit button fw-300">افزودن ترم جدید</button>
                    </div>
                </div>
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
        @if(count($semesters)>0)
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
                        <th>نوبت ترم</th>
                        <th>سال ترم</th>
                        <th>درس های ترم</th>
                        <th>ویرایش / حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($semesters as $semester)
                        <tr id="semester_{{$semester->id}}">
                            <td>{{$semester->semester}}</td>
                            <td>{{$semester->year}}</td>
                            <td>
                                <a href="{{url('admin/semester/'.$semester->id)}}">
                                    <div class="ui blue button fw-300">درس های ترم</div>
                                </a>
                            </td>
                            <td>
                                <div class="ui orange button fw-300" data-id="{{$semester->id}}">ویرایش</div>
                                <div class="ui red button fw-300" data-id="{{$semester->id}}">حذف</div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="ui dimmer modals page transition hidden">
            <div id="edit_semester" class="ui tiny longer edit modal transition hidden" data-error="{{ $errors->update->any() ? 'true' : 'false'}}">
                <form class="ui form{{ $errors->update->any() ? ' error' : '' }}" method="POST" action="{{ url('admin/semester') }}{{ Session::has('semester_id') ? '/'.Session::get('semester_id') : '' }}">
                    <div class="scrolling content">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="field{{ $errors->update->has('semester') ? ' error' : '' }}">
                            <label for="semester">نوبت ترم</label>
                            <select name="semester" class="ui dropdown" autofocus>
                                <option value="">نوبت ترم</option>
                                <option value="پاییز"{{ $errors->update->any() && old('semester') == 'پاییز' ? ' selected' : '' }}>پاییز</option>
                                <option value="بهار"{{ $errors->update->any() && old('semester') == 'بهار' ? ' selected' : '' }}>بهار</option>
                            </select>
                        </div>
                        <div class="field{{ $errors->update->has('year') ? ' error' : '' }}">
                            <label for="year">سال ترم</label>
                            <input type="text" name="year" placeholder="سال (مثل 1396)" value="{{ $errors->update->any() ? old('year') : '' }}">
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
            <div id="delete_semester" class="ui tiny modal transition hidden">
                <div class="header fw-300">
                    آیا از حذف این ترم مطمئن هستید؟
                </div>
                <div class="content">
                    <table class="ui celled center aligned table">
                        <thead>
                        <tr>
                            <th>نوبت ترم</th>
                            <th>سال ترم</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="actions">
                    <form class="ui" method="POST" action="{{ url('admin/semester') }}">
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