@props(['icon','label','activeWhen'=>[]])
<li class="nav-item @activeLink($activeWhen,'menu-is-opening menu-open')">
    <a href="#" class="nav-link @activeLink($activeWhen)">
        <i class="nav-icon {{ $icon }}"></i>
        <p>
            {{ $label }}
            <i class="right fas fa-angle-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        {{ $slot }}
    </ul>
</li>
