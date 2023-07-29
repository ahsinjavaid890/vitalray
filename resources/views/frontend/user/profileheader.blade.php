@php 
$invitaions = DB::table('userplaces')->where('reciever_id' , Auth::user()->id)->where('status' , 'pending')->count();
@endphp
@if($data->id == Auth::user()->id)
@if($invitaions)
<div class="alert alert-info">
    <div class="row">
        <div class="col-md-9">
            you have {{ $invitaions }} Pending Invitation  
        </div>
        <div class="col-md-3 text-right">
            <a href="{{ url('profile/details/invitations') }}">Go To All Invitations</a>
        </div>
    </div>
</div>
@endif
@endif
<div @if($data->coverimage) style="background-image: url('{{ asset('public/images')  }}/{{ $data->coverimage  }}');" @endif class="banner-user">
    <div class="banner-content">
        <div class="media">
            <div onclick="choseprofilephoto()" class="item-img">
                @if($data->profileimage)
                <img src="{{ asset('public/images') }}/{{ $data->profileimage }}" alt="User" style="width: 115px; height: 115px; object-fit: cover;">
                @if(Auth::user()->id == $data->id)
                <i  class="icofont-camera profile-edit-style"></i>
                @endif
                @elseif($data->profileimage_social)
                <img src="{{ $data->profileimage_social }}" alt="User" style="width: 115px; height: 115px; object-fit: cover;">
                @if(Auth::user()->id == $data->id)
                <i  class="icofont-camera profile-edit-style"></i>
                @endif
                @else
                <img src="{{ asset('public/front/media/profileavatar.png') }}" alt="User" style="width: 115px; height: 115px; object-fit: cover;">
                @if(Auth::user()->id == $data->id)
                <i  class="icofont-camera profile-edit-style"></i>
                @endif
                @endif
            </div>
            <div class="media-body">
                @if(Auth::user()->id == $data->id)
                <a href="{{ url('profile') }}">
                @else
                <a href="{{ url('profile') }}/{{ $data->username }}">
                @endif

                    <h3 @if(Auth::user()->approve_status != 'notapproved') class="item-title" @endif>{{ $data->name }}</h3>
                </a>
                <div class="item-subtitle">@if($data->state){{ $data->state }} ,@endif {{ $data->city }}</div>
                <ul class="item-social">

                    @if($data->facebook)
                    <li><a href="{{ $data->facebook }}" class="bg-fb"><i class="icofont-facebook"></i></a></li>
                    @endif
                    @if($data->instagram)
                    <li><a href="{{ $data->instagram }}" class="bg-sun-gradient"><i class="icofont-instagram"></i></a></li>
                    @endif
                    @if($data->twitter)
                    <li><a href="{{ $data->twitter }}" class="bg-twitter"><i class="icofont-twitter"></i></a></li>
                    @endif
                    @if($data->youtube)
                    <li><a href="{{ $data->youtube }}" class="bg-youtube"><i class="icofont-brand-youtube"></i></a></li>
                    @endif
                </ul>
                <ul style="top: 10px;" class="user-meta mb-5">
                    @if(Auth::user()->id != $data->id)
                        @php
                            $user1 = App\Models\User::find(Auth::user()->id);
                            $user2 = App\Models\User::find($data->id);
                            $checkfriend = $user1->isFriendWith($user2);
                            $hasSentFriendRequestTo = $user1->hasSentFriendRequestTo($user2);
                            $hasFriendRequestFrom = $user1->hasFriendRequestFrom($user2);
                        @endphp

                        @if($checkfriend)
                        <li class="send-love-button" class="ml-0"><a href="{{ url('profile/unfriend') }}/{{ $data->id }}"><button class="btn btn-primary"> Unfriend</button></a></li>
                        <li class="mr-1"><button onclick="showchatpopup({{ $data->id }} , '{{ $data->name }}')" class="btn btn-secondary chat-open">Message</button></li>
                        @else

                        @if($hasSentFriendRequestTo == 1)
                        <li class="send-love-button" class="ml-0"><a href="{{ url('profile/cancel') }}/{{ $data->id }}"><button  class="btn btn-primary"><i class="icofont-people"></i> Cancel Request</button></a></li>
                        @else 

                        @if($hasFriendRequestFrom == 1)
                        <li class="send-love-button" class="ml-0"><a href="{{ url('profile/acceptreuqqest') }}/{{ $data->id }}"><button  class="btn btn-primary"><i class="icofont-people"></i> Accept Request</button></a></li>
                        @else
                        <li class="send-love-button" class="ml-0"><a href="{{ url('profile/sendlove') }}/{{ $data->id }}"><button  class="btn btn-primary"><i class="icofont-people"></i> Add Friend</button></a></li>
                        @endif

                        @endif
                        @endif

                    @endif
                    @if(Auth::user()->id == $data->id)
                    <li class="mr-1"><button onclick="chosecoverphoto()" class="btn btn-secondary"><i class="icofont-camera"></i> Update Cover Photo</button></li>
                    <form id="updatecoverform" style="display: none;" enctype="multipart/form-data" method="POST" action="{{ url('profile/changecoverphoto') }}">
                        {{ csrf_field() }}
                        <input type="file" id="updatecoverinput" name="coverphoto">
                    </form>
                    <form id="updateprofileform" style="display: none;" enctype="multipart/form-data" method="POST" action="{{ url('profile/changeprofilephoto') }}">
                        {{ csrf_field() }}
                        <input type="file" id="updateprofileinput" name="profilephoto">
                    </form>
                    <script type="text/javascript">
                        function chosecoverphoto()
                        {
                            $('#updatecoverinput').click();
                        }
                        $("#updatecoverinput").change(function(){   
                            $('#updatecoverform').submit();
                        });
                        function choseprofilephoto()
                        {
                            $('#updateprofileinput').click();
                        }
                        $("#updateprofileinput").change(function(){   
                            $('#updateprofileform').submit();
                        });
                    </script>
                     @endif
                </ul>
                <!-- <ul class="user-meta">
                    <li><i class="icofont-injection-syringe"></i> Vaccinated</li>
                    <li><i class="icofont-glass"></i> Drinking</li>
                    <li><i class="icofont-user"></i> White</li>
                    <li><i class="icofont-no-smoking"></i> Smoking</li>
                </ul> -->
            </div>
        </div>
    </div>
</div>