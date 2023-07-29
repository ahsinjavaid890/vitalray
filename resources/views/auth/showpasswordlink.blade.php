@extends('auth.authlayout')

@section('content')
<style type="text/css">
.valid {
  color: green;
}
.invalid {
  color: red;
}
</style>
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
                            <a class="nav-link"  href="{{ url('signin') }}"><i class="icofont-users-alt-4"></i> Sign In </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="{{ url('signup') }}"><i class="icofont-download"></i> Registration</a>
                        </li>
                    </ul>
                    <div style="min-height: 400px;" class="tab-content">
                        <div class="tab-pane login-tab fade show active" id="login-tab" role="tabpanel">
                            <h3 class="item-title">Reset your Password</h3>
                            @if(session()->has('activeerror'))
                            <div style="text-align: center;color: red;" id="result">{{ session()->get('activeerror') }}</div>
                            @endif
                            
                            @if(session()->has('error'))
                                <div style="text-align: center;color: red;" id="result">{{ session()->get('error') }}</div>
                             @endif

                             
                            <form action="{{ route('reset.password.post') }}" method="POST">
                              @csrf
                              <input type="hidden" name="token" value="{{ $token }}">
      
                              <div class="form-group">
                                <input type="hidden" value="{{ $email }}" id="email_address" class="form-control" name="email" required autofocus>
                              </div>
                              <div class="form-group">
                                <label>Password <small style="color: red;">*</small></label>
                                <input class="form-control" type="password" id="psw" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                @if ($errors->has('password'))
                                  <span class="text-danger">{{ $errors->first('password') }}</span>
                              @endif
                              </div>
                              <div class="form-group">
                                <label>Confirm Password <small style="color: red;">*</small></label>
                                <input onkeyup="checkconfermpass(this.value)" id="confermpassword" type="password" class="form-control" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                      <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                  @endif
                              </div>
                              <ul id="message">
                                  <li id="letter" class="invalid"><i class="icofont-tick-mark"></i> Lowercase Letter</li>
                                  <li id="capital" class="invalid"><i class="icofont-tick-mark"></i> One Capital Letter</li>
                                  <li id="number" class="invalid"><i class="icofont-tick-mark"></i> One Numeric Digit</li>
                                  <li id="length" class="invalid"><i class="icofont-tick-mark"></i> Minimum 8 characters</li>
                                  <li id="cpassword" class="invalid"><i class="icofont-tick-mark"></i> Conferm Password</li>
                                </ul>
      
                              <div style="margin-top: 20px;" class="form-group">
                                  <button type="submit" class="btn btn-primary">
                                      Reset Password
                                  </button>
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
    function checkconfermpass(id)
    {
        var myInput = document.getElementById("psw");
        if(id == myInput.value)
        {
            $('#cpassword').removeClass('invalid');
            $('#cpassword').addClass('valid');

            $('#submitbutton').attr('disabled' , false)
        }else{
            $('#submitbutton').attr('disabled' , true)
            $('#cpassword').removeClass('valid');
            $('#cpassword').addClass('invalid');
        }



        if($('#message').find('li.invalid').length !== 0)
        {
            $('#submitbutton').attr('disabled' , true)
        }else{
            $('#submitbutton').attr('disabled' , false)
        }

    }
</script>
<script>
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");


// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
@endsection