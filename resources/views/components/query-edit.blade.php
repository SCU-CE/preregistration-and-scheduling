<form class="ui form" action="" method="post">
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <div class="fields">
        <div class="six wide field">
            <label class="fw-400">نام پرس و جو</label>
            <input type="text" name="name" placeholder="نام پرس و جو" value="{{$row->name}}" required>
        </div>
        <div class="ten wide field">
            <label class="fw-400">شرح پرس و جو</label>
            <input type="text" name="description" placeholder="شرح پرس و جو" value="{{$row->description}}">
        </div>
    </div>
    <div class="field">
        <label class="fw-400">پرس و جوی اصلی</label>
        <textarea name="query" rows="3" style="direction: ltr" placeholder="SELECT statement with ${p1},${p2},.. as parameters" required>{{$query['query']}}</textarea>
    </div>
    <div>
        <div id="remove_column" style="position: absolute; z-index: 1000; margin-top: 28px; margin-left: -70px;">
            <a class="circular ui red icon button" data-tooltip="حذف آخرین ستون" data-position="top center">
                <i class="icon minus"></i>
            </a>
        </div>
        <div id="add_column" style="position: absolute; z-index: 1000; margin-top: 28px; margin-left: -36px;">
            <a class="circular ui blue icon button" data-tooltip="افزودن ستون جدید" data-position="top center">
                <i class="icon plus"></i>
            </a>
        </div>
    </div>
    <input type="hidden" name="number_of_columns" value="{{count($query['columns'])}}">
    <div id="query_columns" class="ui six column grid">
        @foreach($query['columns'] as $column)
            <div class="column" data-number="{{$loop->iteration}}">
                <input type="text" name="column_id_{{$loop->iteration}}" placeholder="'id' of column {{$loop->iteration}}" value="{{$column['id']}}" style="direction: ltr" required>
                <input type="text" name="column_name_{{$loop->iteration}}" placeholder="'نام فارسی' ستون {{$loop->iteration}}" value="{{$column['name']}}" required>
            </div>
        @endforeach
    </div>
    <input type="hidden" name="number_of_parameters" value="{{count($query['parameters'])}}">
    <div>
        <div id="parameters">
            @foreach($query['parameters'] as $parameter)
                <div class="fields" data-number="{{$loop->iteration}}">
                    <div class="two wide field">
                        <label class="fw-400">'id' پارامتر {{$loop->iteration}}</label>
                        <input type="text" name="p_id_{{$loop->iteration}}" placeholder="'p' in ${p}" style="direction: ltr" value="{{$parameter['id']}}" required>
                    </div>
                    <div class="three wide field">
                        <label class="fw-400">نام فارسی پارامتر {{$loop->iteration}}</label>
                        <input type="text" name="p_name_{{$loop->iteration}}" placeholder="نام فارسی پارامتر {{$loop->iteration}}" value="{{$parameter['name']}}" required>
                    </div>
                    <div class="two wide field">
                        <label class="fw-400">نوع پارامتر {{$loop->iteration}}</label>
                        <select class="ui fluid dropdown" name="p_type_{{$loop->iteration}}" required>
                            <option value="textbox"{{$parameter['type'] == 'textbox' ? ' selected' : ''}}>Textbox</option>
                            <option value="dropdown"{{$parameter['type'] == 'dropdown' ? ' selected' : ''}}>Dropdown</option>
                        </select>
                    </div>
                    <div id="p_query" class="seven wide field{{$parameter['query'] == null ? ' disabled' : ''}}">
                        <label class="fw-400">پرس و جوی پارامتر {{$loop->iteration}}</label>
                        <input type="text" name="p_query_{{$loop->iteration}}" placeholder="SELECT statement for dropdown parameter" value="{{$parameter['query'] != null ? $parameter['query'] : ''}}" style="direction: ltr">
                    </div>
                    <div id="p_query_column" class="two wide field{{$parameter['column'] == null ? ' disabled' : ''}}">
                        <label class="fw-400">'id' پرس و جو</label>
                        <input type="text" name="p_query_column_{{$loop->iteration}}" placeholder="column id" value="{{$parameter['column'] != null ? $parameter['column'] : ''}}" style="direction: ltr">
                    </div>
                </div>
            @endforeach
        </div>
        <div id="remove_parameter" style="margin-top: -89px; right: -42px; position: absolute">
            <a class="circular ui red icon button" data-tooltip="حذف آخرین پارامتر" data-position="right center">
                <i class="icon minus"></i>
            </a>
        </div>
        <div id="add_parameter" style="margin-top: -54px; right: -42px; position: absolute">
            <a class="circular ui green icon button" data-tooltip="افزودن پارامتر جدید" data-position="right center">
                <i class="icon plus"></i>
            </a>
        </div>
    </div>
    <input type="submit" style="display: none">
</form>