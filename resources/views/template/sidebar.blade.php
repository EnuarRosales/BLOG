            <nav id="sidebar">

                <ul class="navbar-nav theme-brand flex-row  text-center">
                    <li class="nav-item theme-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('template/assets/img/SIAEWC.jpeg') }}" class="navbar-logo" alt="logo">
                        </a>
                    </li>
                    <li class="nav-item theme-text">
                        <a href="{{ route('home') }}" class="nav-link"> @yield('tittle-system', 'SistemaWC') </a>
                    </li>
                </ul>

                <ul class="list-unstyled menu-categories" id="accordionExample">

                    @foreach ($menu as $menuItem)
                        @if (isset($menuItem['text']) && (empty($menuItem['can']) || Gate::allows($menuItem['can'])))
                            <li class="menu">
                                @php
                                    $hasSubmenu = isset($menuItem['submenu']);
                                    $hasSubSubmenu = $hasSubmenu && collect($menuItem['submenu'])->contains('subsubmenu');
                                @endphp
                                @if ($hasSubmenu && !$hasSubSubmenu)
                                    <a href="#{{ Str::slug($menuItem['text']) }}" data-toggle="collapse"
                                        aria-expanded="false" class="dropdown-toggle">
                                        <div>
                                            @if (isset($menuItem['icon']))
                                                {!! $menuItem['icon'] !!}
                                            @endif
                                            <span>{{ $menuItem['text'] }}</span>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                                                        {{-- @if (isset($subItem['icon']))
                                                            {!! $subItem['icon'] !!}
                                                        @endif --}}
                                                        <a href="#{{ Str::slug($subItem['text']) }}"
                                                            data-toggle="collapse" aria-expanded="false"
                                                            class="dropdown-toggle">

                                                            {{ $subItem['text'] }}
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
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
                                                                        href="{{ isset($subSubMenu['route']) ? route($subSubMenu['route']) : 'javascript:void(0);' }}">{{ $subSubMenu['text'] }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li class="active">
                                                        {{-- @if (isset($subItem['icon']))
                                                            {!! $subItem['icon'] !!}
                                                        @endif --}}
                                                        <a
                                                            href="{{ isset($subItem['route']) ? route($subItem['route']) : 'javascript:void(0);' }}">{{ $subItem['text'] }}</a>
                                                    </li>
                                                @endif
                                            @endif
                                        @endforeach
                                    </ul>
                                @else
                                    <a href="{{ isset($menuItem['route']) ? route($menuItem['route']) : 'javascript:void(0);' }}"
                                        aria-expanded="false" class="dropdown-toggle">
                                        <div>
                                            @if (isset($menuItem['icon']))
                                                {!! $menuItem['icon'] !!}
                                            @endif
                                            <span>{{ $menuItem['text'] }}</span>
                                        </div>
                                    </a>
                                @endif
                            </li>
                        @endif
                    @endforeach




                    <li class="menu active d-none">
                        <a href="#starter-kit" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-terminal">
                                    <polyline points="4 17 10 11 4 5"></polyline>
                                    <line x1="12" y1="19" x2="20" y2="19"></line>
                                </svg>
                                <span>Starter Kit</span>
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
                        <ul class="collapse submenu recent-submenu mini-recent-submenu list-unstyled show"
                            id="starter-kit" data-parent="#accordionExample">
                            <li class="active">
                                <a href="starter_kit_blank_page.html"> Blank Page </a>
                            </li>
                            <li>
                                <a href="starter_kit_breadcrumb.html"> Breadcrumb </a>
                            </li>
                            <li>
                                <a href="starter_kit_boxed.html"> Boxed </a>
                            </li>
                            <li>
                                <a href="starter_kit_alt_menu.html"> Alternate Menu </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
