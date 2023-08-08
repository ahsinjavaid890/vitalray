@extends('auth.authlayout')
@section('title')
<title>Sign In</title>
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<section class="h-100 gradient-form background-radial-gradient overflow-hidden">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-5 text-black">
          <div class="row g-0">
            <div class="col-lg-6 login-left-section">
              <div class="card-body p-md-4 mx-md-4">
                <div class="row">
                    <div class="col-md-12">
                         @if(session()->has('activeerror'))
                            <div style="text-align: center;color: red;" id="result">{{ session()->get('activeerror') }}</div>
                         @endif
                    </div>
                </div>
                <div class="text-left">
                    <a href="{{ url('') }}">
                        <img class="mb-2" src="{{ asset('public/front/media/logo.png') }}" style="width: 105px;" alt="logo">
                    </a>
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

                <form class="mt-4" id="loginform" action="{{ route('user.login') }}" method="POST" id="form">
                    @csrf
                    <div class="mt-2 mb-3 alert alert-danger print-error-msg-login" style="list-style:noen;display:none; color: #a94442;background-color: #f2dede;border-color: #ebccd1;">
                        <ul style="text-transform:capitalize;"></ul>
                    </div>

                    <div class="form-outline form-black mb-4">
                        <input id="email" autocomplete="off" value="@if(session()->has('email')){{ session()->get('email') }}  @endif" type="text" class="form-control form-control-lg" name="email" placeholder="Your E-mail">
                        <label class="form-label" for="email">Email</label>
                        @if($errors->has('email'))
                            <div style="color: red">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="form-outline form-black mb-4">
                        <input id="password" type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                        <label class="form-label" for="password">Password</label>
                        @if($errors->has('password'))
                            <div style="color: red">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                  <div class="text-center pt-1 mb-2 pb-1">
                    <button id="submit-button-login" type="submit" name="login-btn" class="btn primary-button btn-block mb-3" type="button">Log
                      in</button>

                      
                    <a class="text-muted" href="{{url('forgot-password')}}">Forgot password?</a>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <a href="{{ url('signup') }}" class="text-primary">Signup</a>
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

<script type="text/javascript">
    $('#loginform').on('submit',(function(e) {
    $('#submit-button-login').html('<i style="font-size:22px;" class="fa fa-spin fa-spinner"></i>');
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type:'POST',
        url: $(this).attr('action'),
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data){
         if($.isEmptyObject(data.error)){
            console.log(data)
            if(data == 1)
            {
                var value = 'Your Account is Banned Due to Some Reasons. If you want to Reopen your Account Please';
                $(".print-error-msg-login").find("ul").html('');
                $(".print-error-msg-login").css('display','block');
                $(".print-error-msg-login").find("ul").append('<li>'+value+' <a href="{{ url("contactus") }}">Contact US</a></li>');
                $('#submit-button-login').html('Login ');
            }
            if(data == 2)
            {
                location.reload();
            }
            if(data == 3)
            {
                var value = 'Email or Password is Wrong';
                $(".print-error-msg-login").find("ul").html('');
                $(".print-error-msg-login").css('display','block');
                $(".print-error-msg-login").find("ul").append('<li>'+value+'</li>');
                $('#submit-button-login').html('Login');
            }
        }else{
            $('#submit-button-login').html('Login');
            printErrorMsglogin(data.error);
        }
            
        }
    });
}));
function printErrorMsglogin (msg) {
    $(".print-error-msg-login").find("ul").html('');
    $(".print-error-msg-login").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg-login").find("ul").append('<li>'+value+'</li>');
    });
}
</script>
@endsection