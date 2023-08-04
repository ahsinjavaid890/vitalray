@extends('frontend.layouts.front-app-home')

@section('meta-tags')
<title>Security Settings | {{ $data->name }}</title>
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
                  <div class="row">
                      <div class="col-md-12">
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
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Change Password</h4>
                                <form method="POST" action="{{ url('profile/securetycredentials') }}" class="mt-4">
                                    {{ csrf_field() }}
                                    <div class="form-outline form-black mb-4">
                                        <input type="password" class="form-control form-control-lg" placeholder="Current Password" name="oldpassword">
                                        <label class="form-label">Current Password</label>
                                    </div>
                                    <div class="form-outline form-black mb-4">
                                        <input type="password" class="form-control form-control-lg" placeholder="New Password" name="newpassword">
                                        <label class="form-label">New Password</label>
                                    </div>
                                    <div class="form-outline form-black mb-4">
                                        <input type="password" class="form-control form-control-lg" placeholder="Repeat Password" name="password_confirmed">
                                        <label class="form-label">Repeat Password</label>
                                    </div>
                                   
                                    <div class="form-outline form-black mb-4">
                                        <input type="submit" class="btn primary-button w-30" name="btn-add" value="Update Password">
                                    </div>
                                </form>
                            </div>
                        </div>

                      </div>
                  </div>

                </div>
            </div>
            
          </div>
      </main>
    </div>
</section>
@endsection