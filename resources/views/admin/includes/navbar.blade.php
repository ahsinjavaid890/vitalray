<!-- Topbar Start -->
<div class="navbar-custom topnav-navbar topnav-navbar-dark">
    <div class="container-fluid">

        <!-- LOGO -->
        <a href="{{ url('admin/dashboard') }}" class="topnav-logo">
            <span class="topnav-logo-lg">
                <img src="{{asset('public/admin/images/logo.png')}}" alt="" height="40">
            </span>
            <span class="topnav-logo-sm">
                <img src="{{asset('public/admin/images/logo.png')}}" alt="" height="30">
            </span>
        </a>

        <ul class="list-unstyled topbar-right-menu float-right mb-0">
            <li  class="dropdown notification-list">
<a onclick="shownotification()" class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
<i class="dripicons-bell noti-icon"></i>
<span class="noti-icon-badge">{{ DB::table('adminnotification')->where('status' , 1)->count() }}</span>
</a>
<div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg">

<!-- item-->
<div class="dropdown-item noti-title">
    <h5 class="m-0">
        <span class="float-right">
            <a href="javascript: void(0);" class="text-dark">
                <small>Clear All</small>
            </a>
        </span>Notification
    </h5>
</div>

<div id="showadminnotification" style="max-height: 230px;overflow: auto;" data-simplebar>
    <div>
        <img style="width: 100%;height: 100%;" src="{{ asset('public/preloader/preloader1.gif') }}">
    </div>
    
</div>

<!-- All-->
<a href="{{ url('admin/notifications') }}" class="dropdown-item text-center text-primary notify-item notify-all">
    View All
</a>

</div>
</li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="account-user-avatar"> 
                        <img src="{{asset('public/images')}}/{{ Auth::user()->profileimage }}" alt="user-image" class="rounded-circle">
                    </span>
                    <span>
                        <span class="account-user-name text-primary">{{Auth::user()->name}}</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown" aria-labelledby="topbar-userdrop">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="{{url('admin/profile')}}" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-edit mr-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="mdi mdi-logout mr-1"></i>
                        <span>Logout</span>
                    </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>

                </div>
            </li>

        </ul>
        <a class="button-menu-mobile disable-btn">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>
        
    </div>
</div>
<!-- end Topbar -->     



<script type="text/javascript">
    function shownotification()
    {
        $.ajax({
          type: "GET",
          url: "{{url('admin/shownotification')}}",
          success: function(resp) {                
            $('#showadminnotification').html(resp);
          }
      });
    }
</script>