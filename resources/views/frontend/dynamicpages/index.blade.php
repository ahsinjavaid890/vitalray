@extends('frontend.layouts.front-app-home')
@section('title')
<title>{{ $data->name }} | BAEECAY</title>
<meta name="DC.Title" content="Privacy Policy | BAEECAY">
<meta name="rating" content="general">
<meta name="description" content="Privacy Policy | BAEECAY">
<meta property="og:type" content="website">
<meta property="og:image" content="">
<meta property="og:title" content="Privacy Policy | BAEECAY">
<meta property="og:description" content="Privacy Policy | BAEECAY">
<meta property="og:site_name" content="BAEECAY">
<meta property="og:url" content="{{ url('privacy-policy') }}">
<meta property="og:locale" content="it_IT">
@endsection
@section('content')
<style type="text/css">
    p{
        color: white !important;
    }
    li{
        color: white !important;
    }
</style>
<section class="breadcrumbs-banner">
    <div class="container">
        <div class="breadcrumbs-area">
            <h1>{{ $data->name }}</h1>
            <ul>
                <li>
                    <a href="{{ url('') }}">Home</a>
                </li>
                <li>{{ $data->name }}</li>
            </ul>
        </div>
    </div>
    <div class="breadcrumb-animate-img" data-sal="slide-up" data-sal-duration="1000">
        <img src="{{ asset('public/front/media/figure/breadcrumb_img.png') }}" alt="img">
    </div>
</section>
<section class="about-us">
<div class="about-us-area section-ptb">
    <div class="container">
        {!! $data->content  !!}
</div>
                
</div>
</section>
@endsection