@extends('auth.authlayout')
@section('title')
<title>Sign Up</title>
@endsection
@section('content')
@include('admin.alerts')
<style type="text/css">
    input{
        height: 60px !important;
    }
</style>
    <!-- <div id="preloader"></div> -->
    <div id="wrapper" class="wrapper overflow-hidden">
        <div class="login-page-wrap">
    <div class="content-wrap">
        <div class="login-content">
            <div class="login-form-wrap">
                <style type="text/css">
                    .google-signin a{
                        border: 1px solid #585858;
                        border-radius: 4px;
                        padding: 12px;
                        color: #fff;
                        font-size: 15px;
                        font-weight: 700;
                        display: -webkit-box;
                        display: -webkit-flex;
                        display: -ms-flexbox;
                        display: flex;
                        -webkit-box-align: center;
                        -webkit-align-items: center;
                        -ms-flex-align: center;
                        align-items: center;
                        -webkit-box-pack: center;
                        -webkit-justify-content: center;
                        -ms-flex-pack: center;
                        justify-content: center;
                        margin-bottom: 20px;
                    }
                    .google-signin a img {
                        margin-right: 8px;
                    }
                </style>
                <div class="tab-content">
                        <h3 class="item-title">Create an Account</h3>
                        
                        <div class="row">
                           <div class="col-md-6">
                               <div class="google-signin">
                                    <a href="{{ url('auth/google') }}"><img src="{{ asset('public/front/media/figure/google-icon.png') }}" alt="Google">Google Sign in</a>
                                </div>
                           </div> 
                           <div class="col-md-6">
                               <div class="google-signin">
                                    <a href="{{ url('auth/facebook') }}"><img src="{{ asset('public/front/media/figure/facebook.png') }}" alt="Google">Facebook Sign in</a>
                                </div>
                           </div> 
                        </div>
                    
                        <form id="regForm" method="POST" action="{{ route('user.register') }}">
                         @csrf
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                    <label>First Name</label>
                                    <input autocomplete="off" value="{{ old('first_name') }}" type="text" name="first_name" class="form-control" placeholder="First Name">
                                    @if($errors->has('first_name'))
                                        <div style="color: red">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Last Name</label>
                                    <input autocomplete="off" value="{{ old('last_name') }}" type="text" name="last_name" class="form-control" placeholder="Last Name">
                                    @if($errors->has('last_name'))
                                        <div style="color: red">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                             </div>
                             <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Email</label>
                                    <input autocomplete="off" value="{{ old('email') }}" type="text" name="email" class="form-control" placeholder="E-mail">
                                    @if($errors->has('email'))
                                        <div style="color: red">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                             </div>
                             <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Password</label>
                                    <input autocomplete="off" value="{{ old('password') }}" type="password" name="password" class="form-control" placeholder="Password">
                                    @if($errors->has('password'))
                                        <div style="color: red">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                             </div>
                             <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input autocomplete="off" value="" type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                    @if($errors->has('password_confirmation'))
                                        <div style="color: red">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>
                             </div>
                         </div>
                         
                         <div style="margin-top: 20px;" class="row">
                            <div class="col-lg-6 text-left">
                            </div>
                            <div class="col-lg-6 text-right">
                                <button type="submit" class="btn btn-primary">Sign Up</button>
                            </div>
                        </div>  
                    </form>
                    <div class="row mt-2">
                        <div class="col-md-12 text-center">
                            <a href="{{ url('signin') }}">Already have an Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
@endsection