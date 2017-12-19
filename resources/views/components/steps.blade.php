<div class="ui{{$fluid?' fluid':''}} {{$size}} main steps{{$extraclasses}}">
    @isset($dates)
        @if($active == '1st')
            @include('components.1st-step', ['state' => 'active', 'dates' => $dates])
            @include('components.2nd-step', ['state' => 'deactive', 'dates' => $dates])
            @include('components.3rd-step', ['state' => 'deactive', 'dates' => $dates])
        @elseif($active == '2nd')
            @include('components.1st-step', ['state' => 'complete', 'dates' => $dates])
            @include('components.2nd-step', ['state' => 'active', 'dates' => $dates])
            @include('components.3rd-step', ['state' => 'deactive', 'dates' => $dates])
        @elseif($active == '3rd')
            @include('components.1st-step', ['state' => 'complete', 'dates' => $dates])
            @include('components.2nd-step', ['state' => 'complete', 'dates' => $dates])
            @include('components.3rd-step', ['state' => 'active', 'dates' => $dates])
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