@extends('frontend.layouts.front-app-home')
@section('title')
<title>About Us | BAEECAY</title>
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

<section class="breadcrumbs-banner">
    <div class="container">
        <div class="breadcrumbs-area">
            <h1>About Us</h1>
            <ul>
                <li>
                    <a href="{{ url('') }}">Home</a>
                </li>
                <li>About Us</li>
            </ul>
        </div>
    </div>
    <div class="breadcrumb-animate-img" data-sal="slide-up" data-sal-duration="1000">
        <img src="{{ asset('public/front/media/figure/breadcrumb_img.png') }}" alt="img">
    </div>
</section>

<!--=====================================-->
<!--=         About Us Start       		=-->
<!--=====================================-->
<section class="about-us">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-6">
                <div class="about-us-content">
                    <div class="item-subtitle">Who We Are</div>
                    <h2 class="item-title">We Improve Your Experience Day by Day</h2>
                    <p>Social hen an unknown printer took a galley of type a scrambled make type specimen book. It has survived not only five centuries but also the leap into electronic typesetting, remaining essential unchanged they popularised with release.Social hen an unknown printer took galley type a scrambled.</p>
                    <p>it has survived not only five centuriesut also the leap into lectronic typesetting, remaining essentialunchanged they popularised with release.Social hen an unknown printer.it has survived not only five centuriesut also the leap into lectronic typesetting, remaining essentialunchanged they popularised with release.</p>
                    <div class="progress-box">
                        <div class="media">
                            <div class="item-icon">
                                <i class="icofont-users-social"></i>
                            </div>
                            <div class="media-body">
                                <div class="item-title">1500K+</div>
                                <div class="item-subtitle">Registered Members</div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="item-icon">
                                <i class="icofont-numbered"></i>
                            </div>
                            <div class="media-body">
                                <div class="item-title">121+</div>
                                <div class="item-subtitle">Features Available</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-us-img">
                    <div class="item-img" data-sal="slide-left" data-sal-duration="800">
                        <img src="{{ asset('public/front/media/about/about_1.png') }}" alt="about">
                    </div>
                    <div class="item-video" data-sal="slide-up" data-sal-duration="800" data-sal-delay="200">
                        <img src="{{ asset('public/front/media/about/about_2.png') }}" alt="about">
                        <div class="video-icon">
                            <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=1iIZeIy7TqM">
                                <i class="icofont-ui-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section team-circle">
    <div class="container position-relative">
        <div class="section-heading">
            <h2 class="item-title">Our Active Members</h2>
            <p>when an unknown printer took a galley of type and meeting fari scrambled it to make a type specimen book.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-11">
                <div class="row no-gutters">
                    <div class="col-lg-4 col-sm-6">
                        <ul class="nav nav-tabs nav-tabs-left" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#team1" role="tab" aria-selected="true">
                                    <img src="{{ asset('public/front/media/team/team_1.jpg') }}" alt="team">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#team2" role="tab" aria-selected="false">
                                    <img src="{{ asset('public/front/media/team/team_5.jpg') }}" alt="team">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#team3" role="tab" aria-selected="false">
                                    <img src="{{ asset('public/front/media/team/team_6.jpg') }}" alt="team">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-sm-6 order-lg-3">
                        <ul class="nav nav-tabs nav-tabs-right" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#team4" role="tab" aria-selected="false">
                                    <img src="{{ asset('public/front/media/team/team_3.jpg') }}" alt="team">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#team5" role="tab" aria-selected="false">
                                    <img src="{{ asset('public/front/media/team/team_4.jpg') }}" alt="team">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#team6" role="tab" aria-selected="false">
                                    <img src="{{ asset('public/front/media/team/team_7.jpg') }}" alt="team">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 order-lg-2">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="team1" role="tabpanel">
                                <div class="team-box">
                                    <div class="item-img">
                                        <img src="{{ asset('public/front/media/team/team_1.jpg') }}" alt="team">
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="user-timeline.html">Ketty Rio</a></h3>
                                        <div class="group-count"><span>25</span> - Fashion</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="team2" role="tabpanel">
                                <div class="team-box">
                                    <div class="item-img">
                                        <img src="{{ asset('public/front/media/team/team_5.jpg') }}" alt="team">
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="user-timeline.html">Johnson John</a></h3>
                                        <div class="group-count"><span>25</span> - Fashion</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="team3" role="tabpanel">
                                <div class="team-box">
                                    <div class="item-img">
                                        <img src="{{ asset('public/front/media/team/team_6.jpg') }}" alt="team">
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="user-timeline.html">Fahim Rahman</a></h3>
                                        <div class="group-count"><span>25</span> - Fashion</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="team4" role="tabpanel">
                                <div class="team-box">
                                    <div class="item-img">
                                        <img src="{{ asset('public/front/media/team/team_3.jpg') }}" alt="team">
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="user-timeline.html">Mamunur Rashid</a></h3>
                                        <div class="group-count"><span>25</span> - Fashion</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="team5" role="tabpanel">
                                <div class="team-box">
                                    <div class="item-img">
                                        <img src="{{ asset('public/front/media/team/team_4.jpg') }}" alt="team">
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="user-timeline.html">Ketty Rio</a></h3>
                                        <div class="group-count"><span>25</span> - Fashion</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="team6" role="tabpanel">
                                <div class="team-box">
                                    <div class="item-img">
                                        <img src="{{ asset('public/front/media/team/team_7.jpg') }}" alt="team">
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="user-timeline.html">Ketty Rio</a></h3>
                                        <div class="group-count"><span>25</span> - Fashion</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="shape-wrap">
                    <li><img src="{{ asset('public/front/media/figure/shape_9.png') }}" alt="shape"></li>
                    <li><img src="{{ asset('public/front/media/team/shape_1.png') }}" alt="shape"></li>
                    <li><img src="{{ asset('public/front/media/team/shape_2.png') }}" alt="shape"></li>
                    <li><img src="{{ asset('public/front/media/team/shape_circle_1.png') }}" alt="shape"></li>
                    <li><img src="{{ asset('public/front/media/team/shape_circle_2.png') }}" alt="shape"></li>
                    <li><img src="{{ asset('public/front/media/team/shape_circle_3.png') }}" alt="shape"></li>
                    <li><img src="{{ asset('public/front/media/team/shape_3.png') }}" alt="shape"></li>
                    <li><img src="{{ asset('public/front/media/team/shape_4.png') }}" alt="shape"></li>
                </ul>
            </div>
        </div>
        <div class="see-all-btn">
            <a href="{{ url('signin') }}" class="button-slide">
                <span class="btn-text">Discover All Member</span>
                <span class="btn-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                        <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                    </svg>
                </span>
            </a>
        </div>
    </div>
</section>
@include('includes.newsletter')
@endsection