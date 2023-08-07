<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu left-side-menu-detached">

<div class="leftbar-user">
    <a href="javascript: void(0);">
        <span class="leftbar-user-name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
    </a>
</div>

<!--- Sidemenu -->
<ul class="metismenu side-nav">
    <li class="side-nav-item">
        <a href="{{url('admin/dashboard')}}" class="side-nav-link">
            <i class="uil-user"></i>
            <span> Dashboard </span>
        </a>
    </li>
    <li class="side-nav-item">
        <a href="javascript:void(0)" class="side-nav-link">
            <i class="uil-cog"></i>
            <span> Frequencies </span>
            <span class="menu-arrow"></span>
        </a>
        <ul class="side-nav-second-level" aria-expanded="false">
            <li>
                <a href="{{url('admin/freequency/add')}}">Add New</a>
            </li>
            <li>
                <a href="{{url('admin/freequency/all')}}">All Freequencies</a>
            </li>
        </ul>
    </li>
    <li class="side-nav-item">
        <a href="{{url('admin/allplans')}}" class="side-nav-link">
            <i class="uil-user"></i>
            <span> Plans </span>
        </a>
    </li>
    <!-- <li class="side-nav-item">
        <a href="javascript:void(0)" class="side-nav-link">
            <i class="uil-cog"></i>
            <span> Payements</span>
            <span class="menu-arrow"></span>
        </a>
        <ul class="side-nav-second-level" aria-expanded="false">
            <li>
                <a href="{{url('admin/subscriptions/userplans')}}">Subscription Plans</a>
            </li>
            <li>
                <a href="{{url('admin/earnings')}}">Earnings</a>
            </li>
        </ul>
    </li> -->
    <li class="side-nav-item">
        <a href="javascript:void(0)" class="side-nav-link">
            <i class="uil-cog"></i>
            <span> Pages</span>
            <span class="menu-arrow"></span>
        </a>
        <ul class="side-nav-second-level" aria-expanded="false">
            <li>
                <a href="{{url('admin/pages/allpages')}}">All Pages</a>
            </li>
            <li>
                <a href="{{url('admin/pages/addnewpage')}}">Add New Page</a>
            </li>
        </ul>
    </li>
    <li class="side-nav-item">
        <a href="{{url('admin/profile')}}" class="side-nav-link">
            <i class="uil-user"></i>
            <span> Profile Settings </span>
        </a>
    </li>
    <li class="side-nav-item">
        <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="cursor: pointer;" class="side-nav-link">
            <i class="uil-arrow-left"></i>
            <span> Logout </span>
        </a>
    </li>
</ul>
</div>