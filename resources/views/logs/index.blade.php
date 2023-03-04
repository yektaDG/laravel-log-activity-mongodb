<h1>Showing all Logs</h1>

@foreach($logs as $log)
    <li>{{$log->action}}</li>
@endforeach

