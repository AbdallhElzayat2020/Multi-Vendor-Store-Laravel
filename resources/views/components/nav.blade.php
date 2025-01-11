<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @foreach ($items as $item)
            <li class="nav-item">
                <a class="nav-link {{ Route::is($item['active']) ? 'bg-primary text-white' : '' }} "
                    href="{{ route($item['route']) }}">
                    <i class="{{ $item['icon'] }} text-black"></i>
                    <span>{{ $item['title'] }}</span>
                    @if (isset($item['badge']))
                        <span class="badge rounded-pill bg-primary mx-2  p-2">
                            {{ $item['badge'] }}
                        </span>
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
</aside>
