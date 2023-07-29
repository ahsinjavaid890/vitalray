
<div class="fixed-sidebar">
    <div class="fixed-sidebar-left small-sidebar">
        <div class="sidebar-toggle">
            <button class="toggle-btn toggler-open">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <div class="sidebar-menu-wrap">
            <div class="mCustomScrollbar" data-mcs-theme="dark" data-mcs-axis="y">
                <ul class="side-menu">
                    

                    <li>
                        <a href="{{ url('findpeople') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Find People"><i class="icofont-people"></i></a>
                    </li>

                    <li>
                        <a href="{{ url('goondate') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Go on a Date"><i class="icofont-heart-eyes"></i></a>
                    </li>

                    <li>
                        <a href="{{ url('mydates') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="My Dates"><i class="icofont-heart"></i></a>
                    </li>
                    <li>
                        <a href="{{ url('profile') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="My Profile"><i class="icofont-user-alt-3"></i></a>
                    </li>
                    <li>
                        <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link" data-toggle="tooltip" data-placement="right" title="Logout"><i class="icofont-logout"></i></a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div class="fixed-sidebar-left large-sidebar">
        <div class="sidebar-toggle">
            <div class="sidebar-logo">
                <a href="{{ url('profile') }}"><img src="{{ asset('public/front/media/logo.png') }}" alt="Logo"></a>
            </div>
            <button class="toggle-btn toggler-close">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <div class="sidebar-menu-wrap">
            <div class="mCustomScrollbar" data-mcs-theme="dark" data-mcs-axis="y">
                <ul class="side-menu">
                    

                    <li>
                        <a href="{{ url('findpeople') }}" class="menu-link"><i class="icofont-people"></i><span class="menu-title">Find People</span></a>
                    </li>

                    <li>
                        <a href="{{ url('goondate') }}" class="menu-link"><i class="icofont-heart-eyes"></i><span class="menu-title">Go on a Date</span></a>
                    </li>

                    <li>
                        <a href="{{ url('mydates') }}" class="menu-link"><i class="icofont-heart"></i><span class="menu-title">My Dates</span></a>
                    </li>

                    <li>
                        <a href="{{ url('profile') }}" class="menu-link"><i class="icofont-user-alt-3"></i><span class="menu-title">My Profile</span></a>
                    </li>

                    <li>
                        <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link"><i class="icofont-logout"></i><span class="menu-title">Logout</span></a>
                    </li>

                </ul>
                
            </div>
        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
  {{ csrf_field() }}
</form>
<div class="fixed-sidebar right">
    <div class="fixed-sidebar-right small-sidebar">
        <div class="sidebar-toggle" id="chat-head-toggle">
            <button class="chat-icon">
                <i class="icofont-speech-comments"></i>
            </button>
        </div>
        <div class="sidebar-menu-wrap">
            <div class="mCustomScrollbar" data-mcs-theme="dark" data-mcs-axis="y">
                <ul class="user-chat-list">
                   @php
                        $user1 = App\Models\User::find(Auth::user()->id);
                        $data  = $user1->getAcceptedFriendships();
                   @endphp
                   @foreach($data as $r)

                   @if($r->sender_id == Auth::user()->id)
                    @php
                    $id = $r->recipient_id
                    @endphp
                   @else

                    @php
                    $id = $r->sender_id;

                    @endphp
                    @endif

                   @php
                     $userrequest = App\Models\User::find($id);
                   @endphp
                   <a style="margin-top: 25px;" href="{{ url('chat') }}/{{ $userrequest->username }}">
                     <li class="chat-item chat-open">
                        <div class="author-img">
                            @if($userrequest->profileimage)
                            <img  style="width: 43px;height: 43px;" src="{{ asset('public/images') }}/{{ $userrequest->profileimage }}" alt="{{ $userrequest->name }}">
                            @else
                            <img style="width: 43px;" src="{{ asset('public/front/media/profileavatar.png') }}">
                            @endif
                            <span class="chat-status @if($userrequest->online == 1) online @else offline @endif"></span>
                        </div>
                    </li>
                    </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>