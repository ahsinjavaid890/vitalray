@extends('auth.authlayout')
@section('title')
<title>Verify Your Email</title>
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
                  <h4 class="mt-1 mb-1 pb-1">Verify Your Email</h4>
                  <p>Don't worry we'll handle this for you, Please enter your email address and we'll send you a link</p>
                </div>
                <form action="{{ route('email.verify.post') }}" method="POST" id="form">
                    @csrf
                    <input type="hidden" value="{{ Auth::user()->email }}" name="email">
                    <div class="form-group">
                        <button id="submit-button-login" type="submit" name="login-btn" class="btn primary-button btn-block mb-3" >Verify Email <i class="fa fa-arrow-right icon ml-1"></i></button>
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