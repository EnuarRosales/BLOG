<nav id="sidebar">
    <div class="shadow-bottom"></div>
    <ul class="list-unstyled menu-categories" id="accordionExample">
        @foreach ($menu as $menuItem)
            @if (isset($menuItem['text']) && (empty($menuItem['can']) || Gate::allows($menuItem['can'])))
                <li class="menu">
                    @php
                        $hasSubmenu = isset($menuItem['submenu']);
                        $hasSubSubmenu = $hasSubmenu && collect($menuItem['submenu'])->contains('subsubmenu');
                    @endphp
                    @if ($hasSubmenu && !$hasSubSubmenu)
                        <a href="#{{ Str::slug($menuItem['text']) }}" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">
                            <div>
                                @if (isset($menuItem['icon']))
                                    <i class="{{ $menuItem['icon'] }}"></i>
                                @endif
                                <span>{{ $menuItem['text'] }}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="submenu list-unstyled collapse" id="{{ Str::slug($menuItem['text']) }}"
                            data-parent="#accordionExample">
                            @foreach ($menuItem['submenu'] as $subItem)
                                @if (empty($subItem['can']) || Gate::allows($subItem['can']))
                                    @if (isset($subItem['subsubmenu']))
                                        <li>
                                            <a href="#{{ Str::slug($subItem['text']) }}" data-toggle="collapse"
                                                aria-expanded="false" class="dropdown-toggle">
                                                {{ $subItem['text'] }}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-chevron-right">
                                                    <polyline points="9 18 15 12 9 6"></polyline>
                                                </svg>
                                            </a>
                                            <ul class="collapse list-unstyled sub-submenu"
                                                id="{{ Str::slug($subItem['text']) }}"
                                                data-parent="#{{ Str::slug($menuItem['text']) }}">
                                                @foreach ($subItem['subsubmenu'] as $subSubMenu)
                                                    <li>
                                                        <a
                                                            href="{{ $subSubMenu['route'] ?? 'javascript:void(0);' }}">{{ $subSubMenu['text'] }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li class="active">
                                            <a
                                                href="{{ $subItem['route'] ?? 'javascript:void(0);' }}">{{ $subItem['text'] }}</a>
                                        </li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <a href="{{ $menuItem['route'] ?? 'javascript:void(0);' }}" aria-expanded="false"
                            class="dropdown-toggle">
                            <div>
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
