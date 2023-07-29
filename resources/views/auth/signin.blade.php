@extends('auth.authlayout')
@section('title')
<title>Sign In</title>
<meta name="DC.Title" content="Sign In">
<meta name="rating" content="general">
<meta name="description" content="Sign In">
<meta property="og:type" content="website">
<meta property="og:image" content="">
<meta property="og:title" content="Sign In">
<meta property="og:description" content="Sign In">
<meta property="og:site_name" content="Sign In">
<meta property="og:url" content="{{ url('') }}">
<meta property="og:locale" content="it_IT">
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- <div id="preloader"></div> -->
<div id="wrapper" class="wrapper overflow-hidden">
    <div class="login-page-wrap">
        <div class="content-wrap">
            <div class="login-content">
                <div class="item-logo">
                    <a href="{{ url('') }}"><img src="{{ asset('public/images/') }}/{{ Cmf::get_store_value('footer_logo') }}" alt="logo"></a>
                </div>
                <div class="login-form-wrap">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active"  href="{{ url('signin') }}"><i class="icofont-users-alt-4"></i> Sign In </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="{{ url('signup') }}"><i class="icofont-download"></i> Registration</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        
                        <div class="tab-pane login-tab fade show active" id="login-tab" role="tabpanel">
                            <h3 class="item-title">Sign Into Your Account</h3>
                            @if(session()->has('activeerror'))
                            <div style="text-align: center;color: red;" id="result">{{ session()->get('activeerror') }}</div>
                            @endif
                            <div class="google-signin">
                                <a href="{{ url('auth/google') }}"><img src="{{ asset('public/front/media/figure/google-icon.png') }}" alt="Google">Google Sign in</a>
                            </div>
                            <div class="google-signin">
                                <a href="{{ url('auth/facebook') }}"><img src="{{ asset('public/front/media/figure/facebook.png') }}" alt="Google">Facebook Sign in</a>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12 text-center">
                                    <span>Or</span>
                                </div>
                            </div>
                            

                             
                            <form id="loginform" action="{{ route('user.login') }}" method="POST" id="form">
                                @csrf
                                <div class="mt-2 mb-3 alert alert-danger print-error-msg-login" style="max-width: 70rem; margin: auto;display:none; color: #a94442;background-color: #f2dede;border-color: #ebccd1;">
                                    <ul style="text-transform:capitalize;"></ul>
                                </div>
                                <div class="form-group">
                                    <input id="email" autocomplete="off" value="@if(session()->has('email')){{ session()->get('email') }}  @endif" type="text" class="form-control" name="email" placeholder="Your E-mail">
                                    @if($errors->has('email'))
                                        <div style="color: red">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    @if($errors->has('password'))
                                        <div style="color: red">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>

                                <div class="form-group reset-password">
                                    <a href="{{url('forgot-password')}}">* Reset Password</a>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="validationFormCheck2">
                                        <label class="form-check-label" for="validationFormCheck2">Keep me as signed in</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button id="submit-button-login" type="submit" name="login-btn" class="submit-btn" >Login To Account <i class="fa fa-arrow-right icon ml-1"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="map-line">
                    <img src="{{ asset('public/front/media/banner/map_line2.png') }}" alt="map">
                    <ul class="map-marker">
                        <li><img src="{{ asset('public/front/media/banner/marker_1.png') }}" alt="marker"></li>
                        <li><img src="{{ asset('public/front/media/banner/marker_2.png') }}" alt="marker"></li>
                        <li><img src="{{ asset('public/front/media/banner/marker_3.png') }}" alt="marker"></li>
                        <li><img src="{{ asset('public/front/media/banner/marker_4.png') }}" alt="marker"></li>
                    </ul>
                </div>
        </div>
    </div>
</div>
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
                $('#submit-button-login').html('Login To Account <i class="fa fa-arrow-right icon ml-1"></i>');
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
                $('#submit-button-login').html('Login To Account <i class="la la-arrow-right icon ml-1"></i>');
            }
        }else{
            $('#submit-button-login').html('Login To Account <i class="fa fa-arrow-right icon ml-1"></i>');
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