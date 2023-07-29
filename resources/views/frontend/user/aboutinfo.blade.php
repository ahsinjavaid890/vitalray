@extends('frontend.layouts.front-app')
@section('meta-tags')
<title>About | {{ $data->name }}</title>
@endsection
@section('title')
<title>{{ $data->name }} | {{ Cmf::get_store_value('site_name') }}</title>
<meta name="DC.Title" content="{{ $data->name }} | {{ Cmf::get_store_value('site_name') }}">
<meta name="rating" content="general">
<meta name="description" content="UPSC Singles">
<meta property="og:type" content="website">
<meta property="og:image" content="">
<meta property="og:title" content="{{ $data->name }} | {{ Cmf::get_store_value('site_name') }}">
<meta property="og:description" content="{{ $data->name }} | {{ Cmf::get_store_value('site_name') }}">
<meta property="og:site_name" content="{{ Cmf::get_store_value('site_name') }}">
<meta property="og:url" content="{{ url('') }}">
<meta property="og:locale" content="it_IT">
@endsection

@section('content')
<div class="container">
    <!-- Banner Area Start -->
    @include('frontend.user.profileheader')
    <div class="block-box user-top-header">
        @if($data->id == Auth::user()->id)
        <ul class="menu-list">
            <li ><a href="{{ url('profile') }}">Timeline</a></li>
            <li  class="active"><a href="{{ url('profile/details/about') }}">About</a></li>
            <li ><a href="{{ url('profile/details/gallery') }}">Photos</a></li>
            <li><a href="{{ url('profile/details/loveplaces') }}">Love Places</a></li>
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
        <div class="col-lg-12">
            <div class="block-box user-about">
                <div class="widget-heading">
                    <h3 class="widget-title">More Info About {{ $data->name }}</h3>
                    @if($data->id == Auth::user()->id)
                    <div class="dropdown">
                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">...</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ url('profile/settings/general') }}">Edit</a>
                        </div>
                    </div>
                    @endif
                </div>
                <ul class="user-info">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name:</label>
                            <b>{{ $data->name }}</b>
                            <br>
                            @if($data->show_phone == 1)
                            <label>Phone Number:</label>
                            <b>{{ $data->phonenumber }}</b>
                            <br>
                            @endif
                            @if($data->show_email == 1)
                            <label>Email:</label>
                            <b>{{ $data->email }}</b>
                            <br>
                            @endif
                            <label>Age:</label>
                            <b>{{ $data->age }} Years</b>
                            <br>
                            <label>Height:</label>
                            <b>{{ $data->height }} Feet</b>
                        </div>
                        
                        <div class="col-md-6 text-left">
                            
                            @php
                                $fields = DB::table('signupfields')->where('published_status' , 'published')->where('delete_Status' , 'active')->orderby('order' , 'asc')->get();
                            @endphp
                            @foreach($fields as $r)
                            <label>{{ $r->name }}:</label> <b> 
                                @if(DB::Table('userfields')->where('signup_parent' , $r->id)->where('user_id' , $data->id)->get()->count() > 0)

                                {{ DB::Table('userfields')->where('signup_parent' , $r->id)->where('user_id' , $data->id)->get()->first()->value }}
                                @endif

                            </b></br>
                            @endforeach
                            {{ $data->age_group }}</b><br>
                            
                        </div>
                    </div>
                </ul>
            </div>
        </div>
        
    </div>
</div>
@endsection