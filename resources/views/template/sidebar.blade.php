{{-- <div class="sidebar-wrapper sidebar-theme"> --}}
    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            @foreach ($menu as $menuItem)
                @if (isset($menuItem['text']))
                    <li class="menu">
                        @if (isset($menuItem['submenu']))
                            <a href="#{{ Str::slug($menuItem['text']) }}" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle">
                                <div class="">
                                    @if (isset($menuItem['icon']))
                                        <i class="{{ $menuItem['icon'] }}"></i>
                                    @endif
                                    <span>{{ $menuItem['text'] }}</span>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                </div>
                            </a>
                            <ul class="submenu list-unstyled collapse" id="{{ Str::slug($menuItem['text']) }}"
                                data-parent="#accordionExample">
                                @foreach ($menuItem['submenu'] as $subItem)
                                    <li class="active">
                                        <a
                                            href="{{ $subItem['route'] ?? 'javascript:void(0);' }}">{{ $subItem['text'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <a href="{{ $menuItem['route'] ?? 'javascript:void(0);' }}" aria-expanded="false" class="dropdown-toggle">
                                <div class="">
                                    @if (isset($menuItem['icon']))
                                        <i class="{{ $menuItem['icon'] }}"></i>
                                    @endif
                                    <span>{{ $menuItem['text'] }}</span>
                                </div>
                            </a>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>
{{-- </div> --}}
