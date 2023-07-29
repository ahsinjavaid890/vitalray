@extends('auth.authlayout')
@section('title')
<title>Sign Up | Step 1</title>
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
                        <h3 class="item-title">Sign Up Your Account</h3>
                        
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
                        
                        

                        <h5>Step 1 Out of 6 Steps</h5>
                        <form id="regForm" method="POST" action="{{ route('user.register') }}">
                         @csrf
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Full Name</label>
                                    <input autocomplete="off" value="@if(Cmf::get_uservalue('name')) {{ Cmf::get_uservalue('name') }} @else {{ old('name') }} @endif" type="text" name="name" class="form-control" placeholder="Full Name">
                                    @if($errors->has('name'))
                                        <div style="color: red">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Email</label>
                                    <input autocomplete="off" value="@if(Cmf::get_uservalue('email')) {{ Cmf::get_uservalue('email') }} @else {{ old('email') }} @endif" type="text" name="email" class="form-control" placeholder="E-mail">
                                    @if($errors->has('email'))
                                        <div style="color: red">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                             </div>
                         </div>
                         <div style="margin-top: 20px;" class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="number" value="@if(Cmf::get_uservalue('phonenumber')){{Cmf::get_uservalue('phonenumber')}}@else{{ old('phonenumber') }}@endif" name="phonenumber" class="form-control" placeholder="Phone Number">
                                    @if($errors->has('phonenumber'))
                                        <div class="text-danger" style="text-transform: capitalize;">{{ $errors->first('phonenumber') }}</div>
                                    @endif
                                </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Age</label>
                                    <input id="age" type="text" value="@if(Cmf::get_uservalue('age')) {{ Cmf::get_uservalue('age') }} @else {{ old('age') }} @endif" name="age" class="form-control" placeholder="Age">
                                    @if($errors->has('age'))
                                        <div class="text-danger" style="text-transform: capitalize;">{{ $errors->first('age') }}</div>
                                    @endif
                                </div>
                             </div>
                         </div>
                         <div style="margin-top: 20px;" class="row">
                             <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Height <span><i data-toggle="tooltip" title="Height should be in Feets (eg:5.6)" class="icofont-info-circle"></i></span></label>
                                    <input required type="text" value="@if(Cmf::get_uservalue('height')) {{ Cmf::get_uservalue('height') }} @else {{ old('height') }} @endif" id="height" name="height" class="form-control" placeholder="Height">
                                    @if($errors->has('height'))
                                        <div class="text-danger" style="text-transform: capitalize;">{{ $errors->first('height') }}</div>
                                    @endif
                                </div>
                             </div>
                             <script type="text/javascript">
                                 $(document).ready(function () {    
    
                                        $('#height').keypress(function (e) {    
                                
                                            var charCode = (e.which) ? e.which : event.keyCode    
                                
                                            if (String.fromCharCode(charCode).match(/[^0-9\.]/g,''))    
                                
                                                return false;                        
                                
                                        });  
                                        $('#age').keypress(function (e) {    
                                
                                            var charCode = (e.which) ? e.which : event.keyCode    
                                
                                            if (String.fromCharCode(charCode).match(/[^0-9\.]/g,''))    
                                
                                                return false;                        
                                
                                        });   
                                
                                    }); 
                             </script>
                             <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Gender</label>
                                    <select required style="height:60px;" class="form-control" name="gender" data-placeholder="Select Gender">
                                        <option style="background: #242424;" value="">Select Gender</option>
                                        <option @if(Cmf::get_uservalue('gender'))  @if(Cmf::get_uservalue('gender') == 'Male') selected @endif   @endif style="background: #242424;" value="Male">Male</option>
                                        <option @if(Cmf::get_uservalue('gender'))  @if(Cmf::get_uservalue('gender') == 'Female') selected @endif   @endif  style="background: #242424;" value="Female">Female</option>
                                        <option @if(Cmf::get_uservalue('gender'))  @if(Cmf::get_uservalue('gender') == 'Transgender') selected @endif   @endif  style="background: #242424;" value="Transgender">Transgender</option>
                                        <option @if(Cmf::get_uservalue('gender'))  @if(Cmf::get_uservalue('gender') == 'Prefer not to Answer') selected @endif   @endif  style="background: #242424;" value="Prefer not to Answer">Prefer not to Answer</option>
                                    </select>
                                    @if($errors->has('gender'))
                                        <div class="text-danger" style="text-transform: capitalize;">{{ $errors->first('gender') }}</div>
                                    @endif
                                </div>
                             </div>
                         </div>
  <!--                       <div style="margin-top: 20px;" class="row">
                             <div class="col-md-9 text-right">
                                 
                             </div>
                             <div class="col-md-3">
                                 <div class="form-group">
                                    <input type="submit" name="registration" class="submit-btn" value="Next">
                                </div>
                             </div>
                         </div>  --> 

                         <div style="margin-top: 20px;" class="row">
                            <div class="col-lg-6 text-left">
                                <!-- <a  href="{{ route('user.signup') }}" class="btn btn-primary">Back</a> -->
                            </div>
                            <div class="col-lg-6 text-right">
                                <button type="submit" class="btn btn-primary">Next</button>
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
@endsection