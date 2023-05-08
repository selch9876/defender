@if (!isset($show) || $show)  {{--  If $show is not defined or the $show is true  --}}
    <span class="badge badge-{{ $type ?? 'success' }}">
        {{ $slot }}
    </span>
@endif
