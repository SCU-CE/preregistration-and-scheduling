<div class="ui{{$fluid?' fluid':''}} {{$size}} steps{{$extraclasses}}">
    @isset($dates)
        @if($active == '1st')
            @include('components.1st-step', ['state' => 'active', 'date' => $dates[0]])
            @include('components.2nd-step', ['state' => 'deactive', 'date' => $dates[1]])
            @include('components.3rd-step', ['state' => 'deactive', 'date' => $dates[2]])
        @elseif($active == '2nd')
            @include('components.1st-step', ['state' => 'complete', 'date' => $dates[0]])
            @include('components.2nd-step', ['state' => 'active', 'date' => $dates[1]])
            @include('components.3rd-step', ['state' => 'deactive', 'date' => $dates[2]])
        @elseif($active == '3rd')
            @include('components.1st-step', ['state' => 'complete', 'date' => $dates[0]])
            @include('components.2nd-step', ['state' => 'complete', 'date' => $dates[1]])
            @include('components.3rd-step', ['state' => 'active', 'date' => $dates[2]])
        @endif
    @endisset

    @empty($dates)
        @if($active == '1st')
            @include('components.1st-step', ['state' => 'active'])
            @include('components.2nd-step', ['state' => 'deactive'])
            @include('components.3rd-step', ['state' => 'deactive'])
        @elseif($active == '2nd')
            @include('components.1st-step', ['state' => 'complete'])
            @include('components.2nd-step', ['state' => 'active'])
            @include('components.3rd-step', ['state' => 'deactive'])
        @elseif($active == '3rd')
            @include('components.1st-step', ['state' => 'complete'])
            @include('components.2nd-step', ['state' => 'complete'])
            @include('components.3rd-step', ['state' => 'active'])
        @endif
    @endempty
</div>