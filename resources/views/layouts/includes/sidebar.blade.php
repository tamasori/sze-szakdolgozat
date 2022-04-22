<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route("dashboard") }}" class="brand-link text-center">
        <span class="brand-text font-weight-light"><strong>Bontó</strong>Manager</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex text-center">
            <div class="info">
                <a href="#" class="d-block text-center"><i class="fas fa-user-circle"></i><span class="ml-2">{{ auth()->user()->name }}</span></a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("dashboard") }}" class="nav-link @if(Request::routeIs("dashboard")) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang("misc.dashboard")
                        </p>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <li class="nav-item">
                    <a href="{{ route("car.index") }}" class="nav-link @if(Request::routeIs("car.*")) active @endif">
                        <i class="nav-icon fas fa-car"></i>
                        <p>
                            @lang("cars.menu")
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("sales.index") }}" class="nav-link @if(Request::routeIs("sales.*")) active @endif">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            @lang("sales.menu")
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("logbook-entry.index") }}" class="nav-link @if(Request::routeIs("logbook-entry.*")) active @endif">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            @lang("logbook-entries.menu")
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("ewc-code.index") }}" class="nav-link @if(Request::routeIs("ewc-code.*")) active @endif">
                        <i class="nav-icon fas fa-atom"></i>
                        <p>
                            @lang("ewc-codes.menu")
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("customers.index") }}" class="nav-link @if(Request::routeIs("customers.*")) active @endif">
                        <i class="nav-icon fas fa-user-astronaut"></i>
                        <p>
                            @lang("customers.menu")
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("enquiries.index") }}" class="nav-link @if(Request::routeIs("enquiries.*")) active @endif">
                        <i class="nav-icon fas fa-question"></i>
                        <p>
                            @lang("enquiries.menu")
                        </p>
                    </a>
                </li>
                <hr class="sidebar-divider">
                @foreach(\App\Services\MenuService::getMenuArray() as $year => $items)
                    <li class="nav-item @if(\Route::current() && \Route::current()->parameter('year') == $year ) menu-open @endif">
                        <a href="#" class="nav-link @if(\Route::current() && \Route::current()->parameter('year') == $year ) active @endif">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                {{ $year }}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @foreach($items as $item)
                                <li class="nav-item ">
                                    <a href="{{ $item["url"] }}" class="nav-link">
                                        <i class="{{ $item["icon"] }} nav-icon"></i>
                                        <p>{{ $item["title"] }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
                <hr class="sidebar-divider">
                <li class="nav-item">
                    <a href="{{ route("inspector.index") }}" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            @lang("inspectors.menu")
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("machines.index") }}" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            @lang("machines.menu")
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("inspection-record.index") }}" class="nav-link">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>
                            @lang("inspection-records.menu")
                        </p>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            @lang("menu.settings.title")
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route("preset.index") }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang("presets.menu")</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <hr class="sidebar-divider">
                <li class="nav-item">
                    <a href="{{ route("predefined-answer.index") }}" class="nav-link">
                        <i class="nav-icon fas fa-comment-alt"></i>
                        <p>
                            @lang("predefined-answers.menu")
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("user.index") }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            @lang("users.menu")
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("logout") }}" class="nav-link danger">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            @lang("auth.logout")
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
