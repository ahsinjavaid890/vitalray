@extends('auth.authlayout')
@section('title')
<title>Sign Up</title>
@endsection
@section('content')
@include('admin.alerts')
    <section class="h-100 gradient-form background-radial-gradient overflow-hidden">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-5 text-black">
          <div class="row g-0">
            <div class="col-lg-6 login-left-section">
              <div class="card-body p-md-5 mx-md-4">
                
                <div class="text-left">
                  <!-- <img class="mb-5" src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                    style="width: 185px;" alt="logo"> -->
                  <h4 class="mt-1 mb-1 pb-1">Welcome Back,</h4>
                  <p>Enter your details and login</p>
                </div>

                <div class="row mt-4">
                   <div class="col-md-6">
                        <a href="{{ url('auth/google') }}" class="btn btn-default d-flex align-items-center justify-content-center">
                            <img src="{{ asset('public/front/media/figure/google-icon.png') }}" class="me-2" alt="Google">Google
                          </a>
                   </div> 
                   <div class="col-md-6">
                       <a href="{{ url('auth/facebook') }}" class="btn btn-default d-flex align-items-center justify-content-center">
                           <img src="{{ asset('public/front/media/figure/facebook.png') }}" class="me-2" alt="Facebook">Facebook
                        </a>
                   </div> 
                </div>

                <form class="mt-4" id="regForm" method="POST" action="{{ route('user.register') }}">
                    @csrf
                    <div class="mt-2 mb-3 alert alert-danger print-error-msg-login" style="list-style:noen;display:none; color: #a94442;background-color: #f2dede;border-color: #ebccd1;">
                        <ul style="text-transform:capitalize;"></ul>
                    </div>

                    <div class="row">
                         <div class="col-md-6">
                             <div class="form-outline form-black mb-4">
                                <input autocomplete="off" value="{{ old('first_name') }}" type="text" name="first_name" class="form-control form-control-lg" placeholder="First Name" id="Firstname">
                                <label class="form-label" for="Firstname">First Name</label>
                                @if($errors->has('first_name'))
                                    <div style="color: red">{{ $errors->first('first_name') }}</div>
                                @endif
                            </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-outline form-black mb-4">
                                <input autocomplete="off" value="{{ old('last_name') }}" type="text" name="last_name" class="form-control form-control-lg" placeholder="Last Name" id="LastName">
                                <label class="form-label" for="LastName">Last Name</label>
                                @if($errors->has('last_name'))
                                    <div style="color: red">{{ $errors->first('last_name') }}</div>
                                @endif
                            </div>
                         </div>
                         <div class="col-md-12">
                             <div class="form-outline form-black mb-4">
                                <input autocomplete="off" value="{{ old('email') }}" type="text" name="email" class="form-control form-control-lg" placeholder="E-mail" id="email">
                                <label class="form-label" for="email">Email</label>
                                @if($errors->has('email'))
                                    <div style="color: red">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-outline form-black mb-4">
                                <input autocomplete="off" value="{{ old('password') }}" type="password" name="password" class="form-control form-control-lg" placeholder="Password" id="password">
                                <label class="form-label" for="password">Password</label>
                                @if($errors->has('password'))
                                    <div style="color: red">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-outline form-black mb-4">
                                <input autocomplete="off" value="" type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Confirm Password" id="Cpassword">
                                <label class="form-label" for="Cpassword">Confirm Password</label>
                                @if($errors->has('password_confirmation'))
                                    <div style="color: red">{{ $errors->first('password_confirmation') }}</div>
                                @endif
                            </div>
                         </div>
                     </div>

                  <div class="text-center pt-1 mb-2 pb-1">
                    <button type="submit" class="btn primary-button btn-block mb-3" type="button">Signup</button>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Already have an account?</p>
                    <a href="{{ url('signin') }}" class="text-primary">Login</a>
                  </div>

                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2 login-right-section">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <img src="{{ asset('public/front/media/login-sidebar.png')}}" style="width: 221px; height: 282px;" class="mb-3">
                <h4 class="mb-2">Enhance your listing by Listening Frequencies</h4>
                <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection