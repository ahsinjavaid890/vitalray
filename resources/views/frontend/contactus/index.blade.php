@extends('frontend.layouts.front-app-home')
@section('title')
<title>Contact Us | BAEECAY</title>
<meta name="DC.Title" content="BAEECAY | Home">
<meta name="rating" content="general">
<meta name="description" content="BAEECAY | Home">
<meta property="og:type" content="website">
<meta property="og:image" content="">
<meta property="og:title" content="BAEECAY | Home">
<meta property="og:description" content="BAEECAY | Home">
<meta property="og:site_name" content="BAEECAY | Home">
<meta property="og:url" content="{{ url('') }}">
<meta property="og:locale" content="it_IT">
@endsection
@section('content')
@include('admin.alerts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<section class="breadcrumbs-banner">
    <div class="container">
        <div class="breadcrumbs-area">
            <h1>Contact Us</h1>
            <ul>
                <li>
                    <a href="{{ url('') }}">Home</a>
                </li>
                <li>Contact Us</li>
            </ul>
        </div>
    </div>
    <div class="breadcrumb-animate-img" data-sal="slide-up" data-sal-duration="1000">
        <img src="{{ asset('public/front/media/figure/breadcrumb_img.png')}}" alt="img">
    </div>
</section>
<section class="contact-page">    
    <div class="contact-box-wrap mt-100">
        <div class="container">
            <div class="contact-form">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="contact-box">
                            <h3 class="item-title">Get In Touch</h3>
                            <form action="{{ url('submitcontactusform') }}" method="POST">
                            {{ csrf_field() }}
                                <div class="row gutters-20">
                                    <div class="col-lg-12 form-group">
                                        <input required type="text" class="form-control" name="name" placeholder="First Name">
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <input required type="email" class="form-control" name="email" placeholder="E-mail">
                                    </div>
                                    <div class="col-12 form-group">
                                        <textarea required name="message" id="message" cols="30" rows="3" class="textarea form-control" placeholder="Message"></textarea>
                                    </div>
                                    <div class="col-12 form-group">
                                        <div class="form-group">
                                            <div class="g-recaptcha" data-sitekey="6Ldnm4gaAAAAALukYm-bJQ7jdDehj5_hwf0VKUqE"></div>
                                        </div>
                                        @error('g-recaptcha-response')
                                        <div style="color: red">The Captcha is Required.</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 form-group">
                                        <input type="submit" class="submit-btn" value="Send Us Message">
                                    </div>
                                    
                                </div>
                                <div class="form-response"></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="contact-box contact-method">
                            <h3 class="item-title">Contact Info.</h3>
                            <ul>
                                @if(Cmf::get_store_value('site_address'))
                                <li><i class="icofont-location-pin"></i>{{ Cmf::get_store_value('site_address') }}</li>
                                @endif
                                @if(Cmf::get_store_value('site_email'))
                                <li><i class="icofont-ui-message"></i>{{ Cmf::get_store_value('site_email') }}</li>
                                @endif
                                @if(Cmf::get_store_value('site_phonenumber'))
                                <li><i class="icofont-phone"></i>{{ Cmf::get_store_value('site_phonenumber') }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('includes.newsletter')
@endsection