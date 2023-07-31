<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Admin | Login</title>
  <!-- Stylesheets -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,900&amp;display=swap" rel="stylesheet" />
  <link href="{{ asset('/public/admin/assets/css/icons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('/public/admin/assets/css/app.min.css') }}" rel="stylesheet" />
  <input type="hidden" value="{{ url('') }}" id="mainurl">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="{{ asset('/public/admin/assets/js/vendor.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/public/admin/assets/js/app.min.js') }}" type="text/javascript"></script>
<style>
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3498db;
      width: 180px;
      height: 180px;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
      margin: 0 auto;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
</style>

</head>
  <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header pt-4 pb-4 text-center bg-white">
                                <a href="{{ url('') }}"><img width="130" src="https://www.goomlandscapes.co.nz/wp-content/uploads/2018/08/logo-placeholder.png" alt="logo"></a>
                            </div>

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Admin Login</h4>
                                    <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
                                </div>
                                @if(session()->has('error'))
                                    <div style="text-align: center;color: red;" id="result">{{ session()->get('error') }}</div>
                                @endif
                                <div class="text-center">
                                    <div id="loader" class=""></div>
                                </div>
                                <form action="{{ route('adminlogin') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="emailaddress">Email address</label>
                                    <!-- <input value="@if(session()->has('email')){{ session()->get('email') }}  @endif" class="form-control" type="email" name="email" required="" placeholder="Enter your email"> -->
                                    <input type="email"  name="email" class="form-control">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <!-- <a href="{{url('forgot-password')}}" class="text-muted float-right"><small>Forgot your password?</small></a> -->
                                    <label for="password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input  type="password" name="password" class="form-control" placeholder="Enter your password">
                                        
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <a href="{{ url('forgot-password') }}">Forgot Password</a>
                                <br> <br>
                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" href="index.php" type="submit"> Log In </button>
                                </div>
                            </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->


                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
        
    </body>

</html>