<h1>Showing all Logs</h1>

@forelse ($logs as $log)
    <li>{{ $log->action }}</li>
@empty
    <p> 'No logs yet' </p>
@endforelse
