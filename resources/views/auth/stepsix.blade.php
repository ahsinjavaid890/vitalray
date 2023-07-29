@extends('auth.authlayout')
@section('title')
<title>Sign Up | Step 6</title>
@endsection
@section('content')
<style type="text/css">
.valid {
  color: green;
}
.invalid {
  color: #e05a66;
}
</style>
<!-- <div id="preloader"></div> -->
    <div id="wrapper" class="wrapper overflow-hidden">
        <div class="login-page-wrap">
    <div class="content-wrap">
        <div style="width:600px;" class="login-content">
            <div class="item-logo">
                <a href="{{ url('') }}"><img src="{{ asset('public/images/') }}/{{ Cmf::get_store_value('footer_logo') }}" alt="logo" width="220px"></a>
            </div>
            <div class="login-form-wrap">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link"  href="{{ url('signin') }}"><i class="icofont-users-alt-4"></i> Sign In </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link active"  href="{{ url('signup') }}"><i class="icofont-download"></i> Registration</a>
                    </li>
                </ul>
                <div class="tab-content">
                <h3 class="item-title">Verification Step</h3>
                <h5>Step 6 Out of 6 Steps</h5>
                <form enctype="multipart/form-data" id="regForm" method="POST" action="{{ route('user.registersix') }}">
                 @csrf
                    

                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" id="psw" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input onkeyup="checkconfermpass(this.value)" id="confermpassword" type="password" class="form-control" name="">
                    </div>
                    <ul id="message">
                      <li id="letter" class="invalid"><i class="icofont-tick-mark"></i> Lowercase Letter</li>
                      <li id="capital" class="invalid"><i class="icofont-tick-mark"></i> One Capital Letter</li>
                      <li id="number" class="invalid"><i class="icofont-tick-mark"></i> One Numeric Digit</li>
                      <li id="length" class="invalid"><i class="icofont-tick-mark"></i> Minimum 8 characters</li>
                      <li id="cpassword" class="invalid"><i class="icofont-tick-mark"></i> Confirm Password</li>
                    </ul>
                    <div style="margin-top: 20px;" class="row">
                        <div class="col-lg-6 text-left">
                            <a  href="{{ route('user.stepfive') }}" class="btn btn-primary">Back</a>
                        </div>
                        <div class="col-lg-6 text-right">
                            <button disabled type="submit" id="submitbutton" class="btn btn-primary">Next</button>
                        </div>
                    </div>  
                </form>
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