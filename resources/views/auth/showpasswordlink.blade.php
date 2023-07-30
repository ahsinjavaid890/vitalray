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
                    <a href="{{ url('') }}"><img width="130" src="https://www.goomlandscapes.co.nz/wp-content/uploads/2018/08/logo-placeholder.png" alt="logo"></a>
                </div>
                <div class="login-form-wrap">
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
                                <input class="form-control" type="password" id="psw" name="password"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
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
        </div>
    </div>
</div>
@endsection