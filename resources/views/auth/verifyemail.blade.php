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
                    <a href="{{ url('') }}"><img width="130" src="https://www.goomlandscapes.co.nz/wp-content/uploads/2018/08/logo-placeholder.png" alt="logo"></a>
                </div>
                <div class="login-form-wrap">
                    <div class="tab-content">
                        
                        <div class="tab-pane login-tab fade show active" id="login-tab" role="tabpanel">
                            <h3 class="item-title">Verify Your Email</h3>
                            @if(session()->has('message'))
                            <div style="text-align: center;color: red;" id="result">{{ session()->get('message') }}</div>
                            @endif                   

                             
                            <form action="{{ route('email.verify.post') }}" method="POST" id="form">
                                @csrf
                                <input type="hidden" value="{{ Auth::user()->email }}" name="email">
                                <div class="form-group">
                                    <button id="submit-button-login" type="submit" name="login-btn" class="submit-btn" >Verify Email <i class="fa fa-arrow-right icon ml-1"></i></button>
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