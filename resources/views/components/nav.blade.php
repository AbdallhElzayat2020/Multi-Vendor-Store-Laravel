<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


        @foreach ($items as $item)
            <li class="nav-item">
                <a class="nav-link " href="{{ route($item['route']) }}">
                    @if (isset($item['badge']))
                        <i class="{{ $item['icon'] }}"></i>
                    @endif
                    <span>{{ $item['title'] }}</span>
                </a>
            </li>
        @endforeach

    </ul>

</aside>
