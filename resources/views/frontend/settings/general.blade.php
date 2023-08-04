@extends('frontend.layouts.front-app-home')

@section('meta-tags')
<title>Personal Information</title>
@endsection
@section('content')
@include('admin.alerts')
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
                        <h4>Update Personal Information</h4>
                        <form enctype="multipart/form-data" class="mt-4" method="POST" action="{{ url('profile/updategeneraldetails') }}">
                            {{ csrf_field() }}
                            <div class="mt-3">
                                <div class="form-outline form-black mb-4">
                                    <input accept="image/png, image/gif, image/jpeg"  type="file"  name="profileimage" class="form-control form-control-lg" >
                                    <label class="form-label">Profile Image</label>
                                </div>

                                <div class="form-outline form-black mb-4">
                                    <input type="text" value="{{ $data->first_name }}" name="first_name" class="form-control form-control-lg" value="">
                                    <label class="form-label">First Name</label>
                                </div>
                                <div class="form-outline form-black mb-4">
                                    <input type="text" value="{{ $data->last_name }}" name="last_name" class="form-control form-control-lg" value="">
                                    <label class="form-label">Last Name</label>
                                </div>

                                <div class="form-outline form-black mb-4">
                                    <input readonly type="text" value="{{ $data->email }}" name="email" class="form-control form-control-lg" value="">
                                    <label class="form-label">Email</label>
                                </div>
                                <div class="form-outline form-black mb-4">
                                    <input type="text" value="{{ $data->phonenumber }}" name="phonenumber" class="form-control form-control-lg" value="">
                                    <label class="form-label">Phone number</label>
                                </div>

                                <div class="form-outline form-black mb-4">
                                    <button class="btn primary-button w-30">Update</button>
                                </div>
                            </div>
                        </form>
                      </div>
                   </div>
                </div>
            </div>
          </div>
      </main>
    </div>
</section>
@endsection