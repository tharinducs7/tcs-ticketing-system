<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="/">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Apps</div>
        <ul class="pcoded-item pcoded-left-item">

            @php

            $permissions =
            App\Models\UserRolePermissions::where('role_code',Auth::user()->role_code)->where('is_enable',1)->get();

            @endphp
            @foreach ($permissions as $item)
            @php

            $modules = App\Models\Modules::where('md_code',$item->module_code)->first();

            @endphp
            <li class="">
                <a href="{{$modules->url}}">
                    <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>S</b></span>
                    <span class="pcoded-mtext">{{$modules->md_name}}</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</nav>
