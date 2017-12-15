@if(count($messages) > 0)
    @foreach($messages as $message)
        <div class="ui fluid card msg{{ $message->state == 'inbox' ? ' blue' : '' }}{{ $message->state == 'star' ? ' yellow' : '' }}{{ $message->state == 'later' ? ' orange' : '' }}{{ $message->state == 'archive' ? ' brown' : '' }}" id="message_{{$message->id}}">
            <div id="message_dimmer" class="ui inverted dimmer">
                <div class="ui loader"></div>
            </div>
            <div class="content">
                <div class="description">
                    <div>
                        <div style="float: right">
                            <i style="margin: 6px;" class="{{ $message->type }} huge icon{{ $message->type == 'smile' ? ' green' : '' }}{{ $message->type == 'frown' ? ' teal' : '' }}{{ $message->type == 'heart' ? ' red' : '' }}" ></i>
                        </div>
                        <div style="padding-right: 5.5rem">
                            <p style="padding: 6px; line-height: 25px;">
                                <span>{{ $message->message }}</span>
                            </p>
                            <p style="text-align: left; padding-left: 10px; color: #BBBBBB; font-weight: 200;"><span>{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="extra content">
        <span class="left floated">
            <i class="star big icon star-bt{{ $message->state == 'star' ? ' yellow' : '' }}" data-id="{{$message->id}}" data-color="yellow" data-state="star" style="cursor: pointer">
                {{ csrf_field() }} {{ method_field('PATCH') }}
            </i>
            <i class="wait big icon later-bt{{ $message->state == 'later' ? ' orange' : '' }}" data-id="{{$message->id}}" data-color="orange" data-state="later" style="cursor: pointer">
                {{ csrf_field() }} {{ method_field('PATCH') }}
            </i>
            <i class="archive big icon archive-bt{{ $message->state == 'archive' ? ' brown' : '' }}" data-id="{{$message->id}}" data-color="brown" data-state="archive" style="cursor: pointer">
                {{ csrf_field() }} {{ method_field('PATCH') }}
            </i>
        </span>
        <span class="right floated">

            <i class="trash big icon trash-bt" style="margin-left: -8px; cursor: pointer" data-id="{{$message->id}}">
                {{ csrf_field() }} {{ method_field('PATCH') }}
            </i>
        </span>
            </div>
        </div>
    @endforeach
@endif