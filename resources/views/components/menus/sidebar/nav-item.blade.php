@props(['route', 'icon','label','activeWhen'=>[]])
@can($route)
<li class="nav-item">
    <a href="{{ route($route) }}" class="nav-link @activeLink($activeWhen)">
        <i class="nav-icon {{ $icon }}"></i>
        <p>{{ $label }}</p>
    </a>
</li>
@endcan
