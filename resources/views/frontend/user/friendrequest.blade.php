@extends('frontend.layouts.front-app')
@section('meta-tags')
<title>Friend Requests</title>
@endsection

@section('content')
<div class="container">
    <!-- Banner Area Start -->
    <div class="block-box user-top-header">
        @if($data->id == Auth::user()->id)
        <ul class="menu-list">
            <li ><a href="{{ url('profile') }}">Timeline</a></li>
            <li  ><a href="{{ url('profile/details/about') }}">About</a></li>
            <li ><a href="{{ url('profile/details/gallery') }}">Photos</a></li>
            <li><a href="{{ url('profile/details/loveplaces') }}">Love Places</a></li>
            <li class="active"><a href="{{ url('profile/settings/general') }}">Friends</a></li>
            <li><a href="{{ url('profile/settings/general') }}">Settings</a></li>
        </ul>
        @else
        <ul class="menu-list">
            <li><a href="{{ url('profile') }}/{{ $data->username }}">Timeline</a></li>
            <li ><a href="{{ url('profile/details/gallery') }}/{{ $data->username }}">Photos</a></li>
            <li class="active"><a href="{{ url('profile/details/about') }}/{{ $data->username }}">About </a></li>
        </ul>
        @endif
    </div>
    <div class="row">
    	<div class="col-md-3">
    		<div class="widget widget-memebers">
    			<a style="padding:9px;border-radius: 8px;width: 100%;margin-bottom: 10px;" href="{{ url('profile/friend/allfriends') }}" class="btn btn-primary">All Friends</a>
                <a style="padding:9px;border-radius: 8px;width: 100%;margin-bottom: 10px;" href="{{ url('profile/friend/requests') }}" class="btn btn-success">Friend Requests</a>
                <a style="padding:9px;border-radius: 8px;width: 100%;" href="{{ url('profile/friend/sentrequests') }}" class="btn btn-primary">Sent Requests</a>
            </div>
    	</div>
        <div class="col-md-9">
            <div id="user-view" class="user-grid-view">
                <div class="row gutters-20">
                	@if($friendrequest)
                	@php
                		$user1 = App\Models\User::find(Auth::user()->id);
                	@endphp
                	@foreach($friendrequest as $r)
                	@php
                		$userrequest = App\Models\user::find($r->sender_id);
                		$mutualfriendcount  = $user1->getMutualFriendsCount($userrequest);
                	@endphp
                    <div class="col-xl-4 col-lg-4 col-md-6" style="opacity: 1;">
                        <div class="widget-author">
                            <div class="author-heading">
                                @if(!empty($userrequest->coverimage))
                                <div class="cover-img">
                                    <img src="{{ asset('public/images')  }}/{{ $userrequest->coverimage  }}" alt="cover">
                                </div>
                                @endif
                                <div class="profile-img">
                                    <a href="{{ url('profile') }}/{{ $userrequest->username }}">

                                    	@if($userrequest->profileimage)
					                    <img style="width: 98px;height: 98px;" src="{{ asset('public/images') }}/{{ $userrequest->profileimage }}" alt="{{ $userrequest->name }}">
					                    @else
					                    <img style="width: 98px;" src="{{ asset('public/front/media/profileavatar.png') }}">
					                    @endif

                                    </a>
                                </div>
                                <div class="profile-name mb-3">
                                    <h4 class="author-name"><a href="{{ url('profile') }}/{{ $userrequest->username }}">{{ $userrequest->name }}</a></h4>
                                </div>
                                
                            </div>
                            <ul class="author-statistics">
                                <li>
                                    <a style="padding:9px;border-radius: 8px;" href="{{ url('profile/acceptreuqqest') }}/{{ $userrequest->id }}" class="btn btn-success"><i class="icofont-plus"></i> Accept </a>
                                </li>
                                <li>
                                    <a style="padding:10px;" href="{{ url('profile/rejectreuqqest') }}/{{ $userrequest->id }}" class="btn btn-primary"><i class="icofont-minus"></i> Reject </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                    @else
                    	<h3>There is No Friend Requests</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection