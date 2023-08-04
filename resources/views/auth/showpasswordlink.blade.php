@extends('auth.authlayout')
@section('title')
<title>Reset your Password</title>
@endsection
@section('content')
<!-- <div id="preloader"></div> -->
<section class="h-100 gradient-form background-radial-gradient overflow-hidden">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-5 text-black">
          <div class="row g-0">
            <div class="col-lg-6 login-left-section">
              <div class="card-body p-md-4 mx-md-4">
                <div class="text-left">
                  <img class="mb-2" src="{{ asset('public/front/media/logo.png') }}"
                    style="width: 105px;" alt="logo">
                  <h4 class="mt-1 mb-1 pb-1">Reset your Password</h4>
                </div>

                <div class="row mt-4">
                   <div class="col-md-12">
                        @if(session()->has('activeerror'))
                        <small style="text-align: center;color: white;" id="result">{{ session()->get('activeerror') }}</small>
                        @endif
                        
                        @if(session()->has('error'))
                            <small style="text-align: center;color: white;" id="result">{{ session()->get('error') }}</small>
                         @endif
                   </div> 
                </div>

                <form action="{{ route('reset.password.post') }}" method="POST">
                  @csrf
                  <input type="hidden" name="token" value="{{ $token }}">
                  <input type="hidden" value="{{ $email }}" id="email_address" class="form-control" name="email" required autofocus>
                    <div class="form-outline form-black mb-4">
                        <input class="form-control form-control-lg" type="password" id="psw" name="password"  required>
                        @if ($errors->has('password'))
                          <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                        <label class="form-label" for="email">Password</label>
                    </div>
                    <div class="form-outline form-black mb-4">
                        <input type="password" class="form-control form-control-lg" name="password_confirmation">
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                        <label class="form-label" for="email">Confirm Password</label>
                    </div>

                  <div class="text-center pt-1 mb-2 pb-1">
                    <button type="submit" name="login-btn" class="btn primary-button btn-block mb-3" type="button">Reset Password</button>
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