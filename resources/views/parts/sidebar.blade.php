<!--- Menu -->
<ul class="menu">

    @php
        use Illuminate\Support\Facades\Route;

        $menus = collect(session('menus'));
        $route = Route::currentRouteName();

    @endphp
    @foreach ($menus->where('level', 0) as $item)
        @if ($menus->where('parent_id', $item->id)->where('level', 1)->count() > 0)
            <li class="menu-title">{{ $item->menu }}</li>
        @endif
        @foreach ($menus->where('parent_id', $item->id)->where('level', 1) as $menu)
            @if ($menus->where('parent_id', $menu->id)->where('level', 2)->count() > 0)
                {{-- <li class="sidebar-item has-sub">
                    <a href="#" class='menu-link'> <i class="bi bi-stack"></i> <span>{{ $menu->menu }}</span> </a>
                    <ul class="submenu">
                        @foreach ($menus->where('parent_id', $item->id)->where('level', 2) as $submenu)
                            <li class="submenu-item">
                                <a href="component-alert.html">{{ $submenu->menu }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li> --}}
                <li class="menu-item">
                    <a href="#menu{{ $menu->menu }}" data-bs-toggle="collapse" class="menu-link">
                        <span class="menu-icon"><i class="{{ $menu->icon }}"></i></span>
                        <span class="menu-text"> {{ $menu->menu }} </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="menu{{ $menu->menu }}">
                        <ul class="sub-menu">
                            @foreach ($menus->where('parent_id', $menu->id)->where('level', 2) as $submenu)
                                <li class="menu-item">
                                    <a href="{{ route($submenu->routing) }}" class="menu-link">
                                        <span class="menu-text">{{ $submenu->menu }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @else
                <li class="menu-item {{ $menu->routing == $route ? 'active' : '' }}">
                    <a href="{{ route($menu->routing) }}" class="menu-link">
                        <span class="menu-icon"><i class="{{ $menu->icon }}"></i></span>
                        <span class="menu-text"> {{ $menu->menu }} </span>
                    </a>
                </li>
            @endif
        @endforeach
    @endforeach

    
</ul>
<!--- End Menu -->
