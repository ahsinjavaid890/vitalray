@extends('frontend.layouts.front-app')
@section('meta-tags')
<title>Profile</title>
@endsection

@section('content')


<div class="container">

	<div class="row mt-5">
		<div class="col-md-2">
			<a class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
			<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
			    {{ csrf_field() }}
			</form>
		</div>
	</div>
	

	<div class="row mt-4">
		<div class="col-md-4">
			<div class="card" style="width: 18rem;">
			  @if(Auth::user()->profileimage)
			  
			  <img src="{{ url('public/images') }}/{{ Auth::user()->profileimage }}" class="card-img-top" alt="...">
			  @else
			  <img src="https://cdn1.vectorstock.com/i/1000x1000/26/40/profile-placeholder-image-gray-silhouette-vector-22122640.jpg" class="card-img-top" alt="...">
			  @endif
			  <div class="card-body">
			    <a href="{{ url('profile/settings') }}" class="btn btn-primary">Personal Information</a><br><br>
			    <a href="{{ url('profile/changepassword') }}" class="btn btn-primary">Change Password</a><br><br>
			    <a href="{{ url('profile/plans') }}" class="btn btn-primary">Subscription Plans</a><br><br>
			    <a href="{{ url('profile/frequencies') }}" class="btn btn-primary">Frequencies</a><br><br>
			  </div>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				Subscription Successfull
			</div>
			<div class="card-body">
				<a href="{{ url('profile') }}">Profile</a>
			</div>
		</div>
	</div>



</div>





@endsection