@extends('frontend.layouts.front-app')

@section('meta-tags')
<title>Security Settings | {{ $data->name }}</title>
@endsection
@section('content')
<div class="container">
@include('frontend.user.profileheader')
<div class="block-box user-top-header">
@if($data->id == Auth::user()->id)
<ul class="menu-list">
    <li ><a href="{{ url('profile') }}">Timeline</a></li>
    <li><a href="{{ url('profile/details/about') }}">About</a></li>
    <li><a href="{{ url('profile/details/gallery') }}">Photos</a></li>
    <li><a href="{{ url('profile/details/loveplaces') }}">Love Places</a></li>
    <li class="active"><a href="{{ url('profile/settings/general') }}">Settings</a></li>
    <li><a href="{{ url('profile/settings/general') }}"></a></li>
</ul>
@else
<ul class="menu-list">
    <li class="active"><a href="{{ url('profile') }}/{{ $data->username }}">Timeline</a></li>
    <li><a href="{{ url('profile/details/gallery') }}/{{ $data->username }}">Photos</a></li>
    <li><a href="{{ url('profile/details/loveplaces') }}/{{ $data->username }}">Love Places</a></li>
    <li><a href="{{ url('profile/details/about') }}/{{ $data->username }}">About </a></li>
</ul>
@endif
</div>
<div class="row">
	<div class="col-lg-12 widget-block widget-break-lg">
        <div class="widget widget-user-about">
            <div class="widget-heading">
                <h3 class="widget-title">Security Settings</h3>
            </div>
            <div class="user-info">
                @include('admin.alerts')
                @if(session()->has('errorsecurity'))
                    <div class="alert alert-danger">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session()->get('errorsecurity') }}
                    </div>
                @endif
                @if ($errors->any())
                  <div  class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                          <li >{{ $error }}</li>
                        @endforeach
                    </ul>
                  </div><br />
                @endif
                <div class="block-box">
                    <form method="POST" action="{{ url('profile/securetycredentials') }}">
                    	{{ csrf_field() }}
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" class="form-control" placeholder="Current Password" name="oldpassword">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" placeholder="New Password" name="newpassword">
                        </div>
                        <div class="form-group">
                        	<label>Repeat Password</label>
                            <input type="password" class="form-control" placeholder="Repeat Password" name="password_confirmed">
                        </div>
                       
                        <div class="form-group">
                            <input type="submit" class="submit-btn" name="btn-add" value="Submit Now">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection