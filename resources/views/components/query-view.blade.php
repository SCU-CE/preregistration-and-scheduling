<div class="ui green segment">
    <form class="ui form" action="{{url('admin/query/'.$row->id.'/execute')}}">
        <div class="ui inverted dimmer">
            <div class="ui loader"></div>
        </div>
        @if(count($query['parameters']) > 0)
        <div class="ui two column grid">
            @foreach($query['parameters'] as $parameter)
                @if($parameter['type'] == 'textbox')
                    <div class="column">
                        <label for="" class="fw-400">{{$parameter['name']}}</label>
                        <input type="text" name="{{$parameter['id']}}" placeholder="{{$parameter['name']}}" required>
                    </div>
                @elseif($parameter['type'] == 'dropdown')
                    <div class="column">
                        <label for="" class="fw-400">{{$parameter['name']}}</label>
                        <select class="ui fluid dropdown" name="{{$parameter['id']}}">
                            @foreach(DB::select($parameter['query']) as $option)
                                <option value="{{ $option->{$parameter['column']} }}">{{ $option->{$parameter['column']} }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="ui hidden divider"></div>
        @endif
        <button class="ui right labeled green icon button fw-400">
            <i class="lightning icon"></i>
            <span>اجرای پرس و جو</span>
        </button>
    </form>
</div>