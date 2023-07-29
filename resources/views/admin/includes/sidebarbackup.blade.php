
<div class="left-side-menu">

    <!-- LOGO -->
    <a href="{{url('admin/dashboard')}}" class="logo text-center logo-light">
        <span class="logo-lg">
            <!-- <img src="assets/images/logo.png" alt="" height="16"> -->
        </span>
        <span class="logo-sm">
            <!-- <img src="assets/images/logo_sm.png" alt="" height="16"> -->
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{url('admin/dashboard')}}" class="logo text-center logo-dark">
        <span class="logo-lg">
            <!-- <img src="assets/images/logo-dark.png" alt="" height="16"> -->
        </span>
        <span class="logo-sm">
            <!-- <img src="assets/images/logo_sm_dark.png" alt="" height="16"> -->
        </span>
    </a>

    <div class="h-100" id="left-side-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">

            @foreach(DB::table('adminmodules')->get() as $r)
                @php 
                    $child = DB::table('adminchildmodules')->where('adminparent' , $r->id);
                @endphp
                @if(Cmf::checkuserrolparent($r->id) > 0)
                    <li class="side-nav-item">
                        <a href="@if($child->count() > 0)javascript: void(0);@else {{url('admin')}}/{{ $r->url }}@endif" class="side-nav-link">
                            <i class="{{ $r->icon }}"></i>
                            @if(!empty($r->counter))
                            <span class="badge badge-info badge-pill float-right" style=" margin-right: 25px; ">{{ DB::table($r->counter)->where('new', 1)->count() }}</span>
                            @endif
                            <span> {{ $r->name }} </span>
                            @if($child->count() > 0)
                            <span class="menu-arrow"></span>
                            @endif
                        </a>
                        @if($child->count() > 0)
                        <ul class="side-nav-second-level" aria-expanded="false">
                            @foreach($child->get() as $c)
                                @if(Cmf::checkuserrolchild($c->id) > 0)
                                    @if(DB::table('checkcounter')->where('childid' , $c->id)->count() > 0)
                                        <li>
                                            <a href="{{url('admin')}}/{{ $c->url }}">{{ $c->name }}<span class="badge badge-info badge-pill float-right" style=" margin-right: -3px; ">{{ DB::table($c->counter)->where('newstatus', 'new')->count() }}</span></a>
                                            
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{url('admin')}}/{{ $c->url }}">{{ $c->name }}</a>
                                        </li>
                                    @endif
                                @endif
                                
                            @endforeach
                        </ul>
                        @endif
                    </li>    
                @endif
            @endforeach   
            <?php
   $currentUser=\Auth::user();
   $chatUsersNew=\DB::SELECT('WITH ranked_messages AS (
       SELECT m.*,users.name AS username,ROW_NUMBER() OVER (PARTITION BY sendBy ORDER BY id DESC) AS rn
    FROM chat AS m JOIN users ON users.id = m.sendBy
     )
     SELECT * FROM ranked_messages WHERE SendTo = '.$currentUser->id.' AND ranked_messages.read=0 ');
?>
        <li class="side-nav-item">
            <a href="{{ url('admin/chat/all') }}" class="side-nav-link">
                <i class="uil-comments-alt"></i>
                <span class="badge badge-info badge-pill float-right" id="sidebarCountChat">{{COUNT($chatUsersNew)}}</span>
                <span> Chat </span>
            </a>
        </li>
            <li class="side-nav-item">
                <a href="{{url('admin/profile')}}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Profile Settings </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="cursor: pointer;" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Logout </span>
                </a>
            </li>
        </ul>

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End