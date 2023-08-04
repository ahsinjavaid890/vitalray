@extends('auth.authlayout')
@section('title')
<title>Forgot Password</title>
<meta name="DC.Title" content="Forgot Password">
<meta name="rating" content="general">
<meta name="description" content="Forgot Password">
<meta property="og:type" content="website">
<meta property="og:image" content="">
<meta property="og:title" content="Forgot Password">
<meta property="og:description" content="Forgot Password">
<meta property="og:site_name" content="Baeecay">
<meta property="og:url" content="{{ url('') }}">
<meta property="og:locale" content="it_IT">
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
                  <h4 class="mt-1 mb-1 pb-1">Forgot your password ?</h4>
                  <p>Don't worry we'll handle this for you, Please enter your email address and we'll send you a link</p>
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

                <form class="mt-4" action="{{ route('forget.password.post') }}" method="POST" id="form">
                    @csrf
                    <div class="form-outline form-black mb-4">
                        <input id="email" autocomplete="off" value="@if(session()->has('email')){{ session()->get('email') }}  @endif" type="text" class="form-control form-control-lg" name="email" placeholder="Your E-mail">
                        <label class="form-label" for="email">Email</label>
                        @if($errors->has('email'))
                        <div style="color: red">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                  <div class="text-center pt-1 mb-2 pb-1">
                    <button type="submit" name="login-btn" class="btn primary-button btn-block mb-3" type="button">Send Link</button>
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