@extends('frontend.layouts.front-app-home')
@section('meta-tags')
<title>Profile</title>
@endsection

@section('content')
	<section class="gradient-form background-radial-gradient">
    @include('includes.sidebar')

    <div class="col-md-9 col-lg-10 ml-md-auto px-0 ms-md-auto">
      <!-- main content -->
      <main class="p-4 min-vh-100" style="overflow-y:auto !important; height: 100vh;">
        <div class="container">
          <div class="row section-header">
            <div class="col-md-12">
              <h3>Profile Settings</h3>
              <p>Update your personal and security Information</p>
            </div>
          </div>
            <div class="row">
            	@include('includes.profile-sidebar')
	            <div class="col-md-8">
	              <div class="card">
	                <div class="card-body">
	                    <h4>Change Password</h4>
	                  </div>
	               </div>
	            </div>
            </div>
          </div>
      </main>
    </div>
</section>
@endsection