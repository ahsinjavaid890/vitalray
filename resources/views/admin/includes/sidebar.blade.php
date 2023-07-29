<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu left-side-menu-detached">

<div class="leftbar-user">
    <a href="javascript: void(0);">
        <img src="{{asset('public/images')}}/{{ Auth::user()->profileimage }}" alt="user-image" height="42" class="rounded-circle shadow-sm">
        <span class="leftbar-user-name">{{Auth::user()->name}}</span>
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
            <span> Requests @if(DB::table('users')->where('active' , 1)->where('steps' , 6)->where('user_type' , 'customer')->where('approve_status' , 'notapproved')->count() > 0)

                 <span class="badge badge-info badge-pill float-right" style=" margin-right: 25px; ">{{ DB::table('users')->where('steps' , 6)->where('new' , 1)->where('active' , 1)->where('user_type' , 'customer')->where('approve_status' , 'notapproved')->count() }}</span>
             @endif</span>
            <span class="menu-arrow"></span>
        </a>
        <ul class="side-nav-second-level" aria-expanded="false">
            <li>
                <a href="{{url('admin/new-users')}}">New Requests @if(DB::table('users')->where('active' , 1)->where('user_type' , 'customer')->where('new' , 1)->where('steps' , 6)->where('approve_status' , 'notapproved')->count() > 0)

                 <span class="badge badge-info badge-pill float-right" style=" margin-right: 25px; ">{{ DB::table('users')->where('steps' , 6)->where('new' , 1)->where('active' , 1)->where('user_type' , 'customer')->where('approve_status' , 'notapproved')->count() }}</span>
             @endif</a>
            </li>
            <li>
                <a href="{{url('admin/requests/declinerequests')}}">Decline Requests</a>
            </li>
        </ul>
    </li>
    <li class="side-nav-item">
        <a href="{{url('admin/users')}}" class="side-nav-link">
            <i class="uil-user"></i>
            <span> Users </span>
        </a>
    </li>
    <li class="side-nav-item">
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
    </li>
    <li class="side-nav-item">
        <a href="javascript:void(0)" class="side-nav-link">
            <i class="uil-cog"></i>
            <span> Blogs @if(DB::table('blogcoments')->where('newstatus' , 'new')->count() > 0)

                 <span class="badge badge-info badge-pill float-right" style=" margin-right: 25px; ">{{ DB::table('blogcoments')->where('newstatus' , 'new')->count() }}</span>
             @endif</span>
            <span class="menu-arrow"></span>
        </a>
        <ul class="side-nav-second-level" aria-expanded="false">
            <li>
                <a href="{{url('admin/add-blog')}}">Add Blog</a>
            </li>
            <li>
                <a href="{{url('admin/blogs')}}">All Blogs</a>
            </li>
            <li>
                <a href="{{url('admin/blog-categories')}}">Blog Categories</a>
            </li>
            <li>
                <a href="{{url('admin/blogs-coments')}}">Blog Comments @if(DB::table('blogcoments')->where('newstatus' , 'new')->count() > 0)

                 <span class="badge badge-info badge-pill float-right" style=" margin-right: 25px; ">{{ DB::table('blogcoments')->where('newstatus' , 'new')->count() }}</span>
             @endif</a>
            </li>
        </ul>
    </li>
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
        <a href="javascript:void(0)" class="side-nav-link">
            <i class="uil-cog"></i>
            <span> Quizes</span>
            <span class="menu-arrow"></span>
        </a>
        <ul class="side-nav-second-level" aria-expanded="false">
            <li>
                <a href="{{url('admin/quizes')}}">All Quizes</a>
            </li>
        </ul>
    </li>
    <li class="side-nav-item">
        <a href="{{url('admin/contact/allcontactmessages')}}" class="side-nav-link">
            <i class="uil-user"></i>
            <span> Contact Us @if(DB::table('contactuses')->where('status' , 1)->count() > 0)

                 <span class="badge badge-info badge-pill float-right" style=" margin-right: 25px; ">{{ DB::table('contactuses')->where('status' , '1')->count() }}</span>
             @endif</span>
        </a>
    </li>
    <li class="side-nav-item">
        <a href="javascript:void(0)" class="side-nav-link">
            <i class="uil-cog"></i>
            <span> Settings</span>
            <span class="menu-arrow"></span>
        </a>
        <ul class="side-nav-second-level" aria-expanded="false">
            <li>
                <a href="{{url('admin/settings/payementmethod')}}">Payement Methods</a>
            </li>
            <li>
                <a href="{{url('admin/settings/appearance')}}">Website Settings</a>
            </li>
            <li>
                <a href="{{url('admin/settings/signup')}}">Signup Fields</a>
            </li>
        </ul>
    </li> 
    <li class="side-nav-item">
        <a href="{{url('admin/countries')}}" class="side-nav-link">
            <i class="uil-user"></i>
            <span> Countries </span>
        </a>
    </li>
    <li class="side-nav-item">
        <a href="{{url('admin/places')}}" class="side-nav-link">
            <i class="uil-user"></i>
            <span> Places </span>
        </a>
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