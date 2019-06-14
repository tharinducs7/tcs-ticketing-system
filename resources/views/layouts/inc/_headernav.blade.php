<nav class="navbar header-navbar pcoded-header" header-theme="theme2">
        <div class="navbar-wrapper">
            <div class="navbar-logo">
                <a class="mobile-menu" id="mobile-collapse" href="#!">
                    <i class="ti-menu"></i>
                </a>
                <a href="/">
                    Ticketing System
                </a>
                <a class="mobile-options">
                    <i class="ti-more"></i>
                </a>
            </div>

            <div class="navbar-container container-fluid">
                <ul class="nav-left">
                    <li>
                        <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                    </li>
                
                    <li>
                        <a href="#!" onclick="javascript:toggleFullScreen()">
                            <i class="ti-fullscreen"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav-right">
                
                    <li class="user-profile header-notification">
                        <a href="#!">
                            @if(!empty(Auth::user()->image))
                            <img src="/{{ Auth::user()->image }}" class="img-radius" alt="User-Profile-Image">
@endif
                            <span>{{ Auth::user()->name }}</span>
                            <i class="ti-angle-down"></i>
                        </a>
                        <ul class="show-notification profile-notification">
                            <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"
                           > <i class="ti-layout-sidebar-left"></i> Logout</a>
                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>