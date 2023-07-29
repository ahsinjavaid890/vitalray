<header class="fixed-header">
    <div class="header-menu" style="background: #242424;">
        <div class="navbar">
            <div class="nav-item d-none d-sm-block">
                <div class="header-logo">
                    <a href="{{ url('profile') }}"><img width="140px" src="{{ asset('public/images/') }}/{{ Cmf::get_store_value('header_logo') }}" alt="Logo"></a>
                </div>
            </div>
            <div class="nav-item nav-top-menu">
                <nav id="dropdown" class="template-main-menu">
                    <ul class="menu-content">
                        <li class="header-nav-item">
                            <a href="{{ url('') }}" class="menu-link active"><span class="transparent-text-head">.</span></a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="nav-item header-control">
                <div class="inline-item d-none d-md-block">
                    <div class="input-group">
                        <input onkeyup="searchheaderpeoples(this.value)" type="text" class="form-control" placeholder="Search here.......">
                        <div class="input-group-append">
                            <button class="submit-btn" type="button"><i class="icofont-search"></i></button>
                        </div>
                    </div>
                    <div id="myInputautocomplete-list" class="autocomplete-items">
                       
                    </div>
                </div>
                <div class="inline-item d-flex align-items-center">
                    
                    <div class="dropdown dropdown-friend">
                        <button onclick="getfriendrequest()" class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="icofont-users-alt-4"></i><span style="display:none;" class="notify-count frinedlistcount" id="frinedlistcount"></span>
                        </button>
                        <div  class="dropdown-menu dropdown-menu-right">
                            <div class="item-heading">
                                <h6 class="heading-title">Friend Requests</h6>
                                <div class="heading-btn">
                                    <a href="{{ url('profile/friend/allfriends') }}">My Friends</a>
                                </div>
                            </div>
                            <div id="friendrequests" class="item-body">
                                <div class="media">
                                    <img src="https://cdn.shopify.com/s/files/1/0222/7018/1472/t/17/assets/shopify_logo.gif?v=7646194843727540658">
                                </div>
                            </div>
                            <div class="item-footer">
                                <a href="{{ url('profile/friend/requests') }}" class="view-btn">View All Friend Request</a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown dropdown-message">
                      <a href="{{ url('chatroom') }}">  <button class="dropdown-toggle" type="button" >
                            <i class="icofont-speech-comments"></i><span style="display:none;" class="notify-count chat" id="chat">1</span>
                        </button>
                        </a>
                    </div>
                    <div class="dropdown dropdown-notification">
                        <button onclick="getallnotifications()" class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="icofont-notification"></i><span style="display:none;" class="notify-count notification" id="notification"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-heading">
                                <h6 class="heading-title">Notifications</h6>
                            </div>
                            <div id="allnotifications" style="max-height: 300px; overflow: auto;" class="item-body">
                                <div class="media">
                                    <img src="https://cdn.shopify.com/s/files/1/0222/7018/1472/t/17/assets/shopify_logo.gif?v=7646194843727540658">
                                </div>
                            </div>
                            <div class="item-footer">
                                <a href="{{ url('profile/notifications') }}" class="view-btn">View All Notification</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="inline-item">
                    <div class="dropdown dropdown-admin">
                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            <span class="media">
                                <span class="item-img">
                                    @if(Auth::user()->profileimage)
                                    <img  style=" width: 44px; height: 44px;"  src="{{ asset('public/images') }}/{{ Auth::user()->profileimage }}" alt="User" >
                                    @elseif(Auth::user()->profileimage_social)
                                    <img  style=" width: 44px; height: 44px;"  src="{{ Auth::user()->profileimage_social }}" alt="User" >
                                    @else
                                    <img  style=" width: 44px; height: 44px;"  src="{{ asset('public/front/media/profileavatar.png') }}" alt="User" >
                                    @endif
                                    @if(Auth::user()->approve_status == 'approved')
                                    <span class="acc-verified"><i class="icofont-check"></i></span>
                                    @endif
                                </span>
                                <span class="media-body">
                                    <span class="item-title text-white">{{ Auth::user()->name }}</span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="admin-options">
                                <li><a href="{{ url('profile') }}">My Profile</a></li>
                                <li><a href="{{ url('profile/details/invitations') }}">Invitations</a></li>
                                <li><a href="{{ url('profile/friend/allfriends') }}">My Friends</a></li>
                                <li><a href="{{ url('profile/settings/subscribe') }}">Subscription Plans</a></li>
                                <li><a href="{{ url('profile/settings/general') }}">General Settings</a></li>
                                <li><a href="{{ url('profile/settings/security') }}">Security Settings</a></li>
                                <li><a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>


<script type="text/javascript">
    function changenotistatus(id)
    {
        var mainurl = '{{ url("") }}';
        $.ajax({
          type: "GET",
          url: mainurl+"/profile/statuschange/"+id,
          success: function(resp) {                
            
          }
      });
    }
    $( document ).ready(function() {
        getcompletenotification();
    });
    function getcompletenotification()
    {
        $.ajax({
            type: "GET",
            url: '{{ url("/profile/details/getcompletenotifications") }}',
            success: function(resp) {
                if(resp.friendrequests > 0)
                {
                    $('.frinedlistcount').css('display' , 'block');
                    $('#frinedlistcount').html(resp.friendrequests);
                }else{
                    $('.frinedlistcount').css('display' , 'none');
                    $('#frinedlistcount').html(resp.friendrequests);
                }
                if(resp.notification > 0)
                {
                    $('.notification').css('display' , 'block');
                    $('#notification').html(resp.notification);
                }else{
                    $('.notification').css('display' , 'none');
                    $('#notification').html(resp.notification);
                }
                if(resp.chat > 0)
                {
                    $('.chat').css('display' , 'block');
                    $('#chat').html(resp.chat);
                }else{
                    $('.chat').css('display' , 'none');
                    $('#chat').html(resp.chat);
                }
                setTimeout(function() { 
                    getcompletenotification();
                }, 1000);               
            }
        });
    }
</script>