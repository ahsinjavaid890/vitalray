<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('meta-tags')
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/front/media/favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('public/front/dependencies/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/front/dependencies/icofont/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/front/dependencies/slick-carousel/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('public/front/dependencies/slick-carousel/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('public/front/dependencies/magnific-popup/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('public/front/dependencies/sal.js/sal.css') }}">
    <link rel="stylesheet" href="{{ asset('public/front/dependencies/mcustomscrollbar/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/front/dependencies/select2/css/select2.min.css') }}">
    <script src="{{ asset('public/front/dependencies/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/front/assets/custom.js') }}"></script>
    <script src="{{ asset('public/front/assets/chat.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('public/front/assets/css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,400&amp;display=swap" rel="stylesheet">
    <input type="hidden" value="{{ url('') }}" id="app_url">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body class="bg-link-water">
  <a href="#wrapper" data-type="section-switch" class="scrollup">
      <i class="icofont-bubble-up"></i>
  </a>
  <!-- <div id="preloader"></div> -->
  <div id="wrapper" class="wrapper">
      @include('includes.front-header')
      @include('includes.front-sidebar')

        <div class="page-content">
          @if(DB::table('quiz_taken_users')->where('user_id' , Auth::user()->id)->where('status' , '!=' , 'done')->count() == 0)

          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-danger">Your Quiz is Pending <a href="{{ url('quiz') }}">Go To Quiz</a></div>
                  </div>
              </div>
          </div>

          @endif



          @if(Auth::user()->approve_status == 'notapproved')
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <div class="alert alert-danger">You will receive an email when your account is approved; we are currently reviewing your application. <a href="{{ url('contact-us') }}">Feel Free to Contact Us</a></div>
                  </div>
              </div>
          </div>
          @endif
          @yield('content')
        </div>
      @include('includes.chatmodal')
  </div>
</body>

<script src="{{ asset('public/front/dependencies/popper.js/js/popper.min.js') }}"></script>
<script src="{{ asset('public/front/dependencies/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/front/dependencies/imagesloaded/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('public/front/dependencies/isotope-layout/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('public/front/dependencies/slick-carousel/js/slick.min.js') }}"></script>
<script src="{{ asset('public/front/dependencies/sal.js/sal.js') }}"></script>
<script src="{{ asset('public/front/dependencies/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('public/front/dependencies/mcustomscrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('public/front/dependencies/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('public/front/dependencies/elevate-zoom/jquery.elevatezoom.js') }}"></script>
<script src="{{ asset('public/front/dependencies/bootstrap-validator/js/validator.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtmXSwv4YmAKtcZyyad9W7D4AC08z0Rb4"></script>

<!-- Site Scripts -->
<script src="{{ asset('public/front/assets/js/app.js') }}"></script>
@yield('page-scripts')
</html>
