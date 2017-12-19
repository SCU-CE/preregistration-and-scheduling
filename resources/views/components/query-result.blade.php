@if(count($results)>0)
<table class="ui celled striped table">
    <thead>
    <tr>
        @foreach($columns as $column)
            <th>{{$column['name']}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($results as $result)
        <tr>
            @foreach($columns as $column)
                <td>{{ $result->{$column['id']} }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
@else
    <div style="text-align: center">
        <div><i class="meh huge icon"></i></div>
        <h2 class="fw-400" style="margin-top: .75rem">نتیجه ای پیدا نشد!</h2>
    </div>
@endif