@extends('frontend.layouts.front-app-home')
@section('title')
<title>BAEECAY | Home</title>
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
<section class="hero-banner">
    <div class="container">
        <div class="hero-content" data-sal="zoom-out" data-sal-duration="1000">
            <h1 class="item-title">Baeecay Community</h1>
            <p>Having real social contacts can sometimes be difficult FUN, everything becomes much simpler!</p>
            <div class="item-number">10,95,219</div>
            <div class="conn-people">Dates world wide</div>
            <a href="{{ url('signin') }}" class="button-slide">
                <span class="btn-text">Discover Now</span>
                <span class="btn-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                        <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                    </svg>
                </span>
            </a>
        </div>
    </div>
    <div class="leftside-image">
        <div class="cartoon-image" data-sal="slide-down" data-sal-duration="1000" data-sal-delay="100">
            <img src="{{ asset('public/front/media/banner/people_1.png')}}" alt="People">
        </div>
        <div class="shape-image" data-sal="slide-down" data-sal-duration="500" data-sal-delay="700">
            <img src="{{ asset('public/front/media/banner/shape_1.png')}}" alt="shape">
        </div>
    </div>
    <div class="map-line">
        <img src="{{ asset('public/front/media/banner/map_line.png')}}" alt="map" data-sal="slide-up" data-sal-duration="500" data-sal-delay="800">
        <ul class="map-marker">
            <li data-sal="slide-up" data-sal-duration="700" data-sal-delay="1000"><img src="{{ asset('public/front/media/banner/marker_1.png')}}" alt="marker"></li>
            <li data-sal="slide-up" data-sal-duration="800" data-sal-delay="1000"><img src="{{ asset('public/front/media/banner/marker_2.png')}}" alt="marker"></li>
            <li data-sal="slide-up" data-sal-duration="900" data-sal-delay="1000"><img src="{{ asset('public/front/media/banner/marker_3.png')}}" alt="marker"></li>
            <li data-sal="slide-up" data-sal-duration="1000" data-sal-delay="1000"><img src="{{ asset('public/front/media/banner/marker_4.png')}}" alt="marker"></li>
        </ul>
    </div>
</section>
<!--=====================================-->
<!--=         Why Choose Start          =-->
<!--=====================================-->
<section class="why-choose-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="why-choose-box">
                    <div class="item-subtitle">What We Do</div>
                    <h2 class="item-title"><span>Why Join Our</span> Baeecay from Social Network ?</h2>
                    <p>Social hen an unknown printer took a galley of type and scrambled make type specimen book. It has survived not only five centuries but also the leap into electronic typesetting, remaining essentialunchanged they popularised with release.</p>
                    <a href="{{ url('signin') }}" class="button-slide">
                        <span class="btn-text">Join Our Community</span>
                        <span class="btn-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                                <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="why-choose-box">
                    <ul class="features-list">
                        <li>
                            <div class="media">
                                <div class="item-icon">
                                    <i class="icofont-wechat"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="item-title">Meet Great People</h3>
                                    <p>when an unknown printer took a galley of scrambled it to make a type specimen It has survived not only.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="media">
                                <div class="item-icon">
                                    <i class="icofont-users"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="item-title">Forum Discussion</h3>
                                    <p>when an unknown printer took a galley of scrambled it to make a type specimen It has survived not only.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="media">
                                <div class="item-icon">
                                    <i class="icofont-paper"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="item-title">Active Groups</h3>
                                    <p>when an unknown printer took a galley of scrambled it to make a type specimen It has survived not only.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=         Community Start           =-->
<!--=====================================-->
<section class="community-network">
    <ul class="map-marker">
        <li><img src="{{ asset('public/front/media/banner/marker_1.png')}}" alt="marker"></li>
        <li><img src="{{ asset('public/front/media/banner/marker_2.png')}}" alt="marker"></li>
        <li><img src="{{ asset('public/front/media/banner/marker_3.png')}}" alt="marker"></li>
        <li><img src="{{ asset('public/front/media/banner/marker_4.png')}}" alt="marker"></li>
        <li><img src="{{ asset('public/front/media/banner/marker_5.png')}}" alt="marker"></li>
    </ul>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-6">
                <div class="community-content">
                    <h2 class="item-title">129 Countries We Build Our Largest Community in <span>Baeecay Network</span></h2>
                    <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also leap electronic typesetting, remaining essentially.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-shape" data-sal="slide-left" data-sal-duration="500" data-sal-delay="500">
        <img src="{{ asset('public/front/media/figure/shape_7.png')}}" alt="bg">
    </div>
</section>
<!--=====================================-->
<!--=         Team Area  Start          =-->
<!--=====================================-->
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
                                    <img src="{{ asset('public/front/media/team/team_1.jpg')}}" alt="team">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#team2" role="tab" aria-selected="false">
                                    <img src="{{ asset('public/front/media/team/team_5.jpg')}}" alt="team">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#team3" role="tab" aria-selected="false">
                                    <img src="{{ asset('public/front/media/team/team_6.jpg')}}" alt="team">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-sm-6 order-lg-3">
                        <ul class="nav nav-tabs nav-tabs-right" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#team4" role="tab" aria-selected="false">
                                    <img src="{{ asset('public/front/media/team/team_3.jpg')}}" alt="team">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#team5" role="tab" aria-selected="false">
                                    <img src="{{ asset('public/front/media/team/team_4.jpg')}}" alt="team">
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#team6" role="tab" aria-selected="false">
                                    <img src="{{ asset('public/front/media/team/team_7.jpg')}}" alt="team">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 order-lg-2">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="team1" role="tabpanel">
                                <div class="team-box">
                                    <div class="item-img">
                                        <img src="{{ asset('public/front/media/team/team_1.jpg')}}" alt="team">
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="{{ url('signin') }}">Ketty Rio</a></h3>
                                        <div class="group-count"><span>25</span> - Fashion</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="team2" role="tabpanel">
                                <div class="team-box">
                                    <div class="item-img">
                                        <img src="{{ asset('public/front/media/team/team_5.jpg')}}" alt="team">
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="{{ url('signin') }}">Johnson John</a></h3>
                                        <div class="group-count"><span>25</span> - Fashion</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="team3" role="tabpanel">
                                <div class="team-box">
                                    <div class="item-img">
                                        <img src="{{ asset('public/front/media/team/team_6.jpg')}}" alt="team">
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="{{ url('signin') }}">Fahim Rahman</a></h3>
                                        <div class="group-count"><span>25</span> - Fashion</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="team4" role="tabpanel">
                                <div class="team-box">
                                    <div class="item-img">
                                        <img src="{{ asset('public/front/media/team/team_3.jpg')}}" alt="team">
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="{{ url('signin') }}">Mamunur Rashid</a></h3>
                                        <div class="group-count"><span>25</span> - Fashion</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="team5" role="tabpanel">
                                <div class="team-box">
                                    <div class="item-img">
                                        <img src="{{ asset('public/front/media/team/team_4.jpg')}}" alt="team">
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="{{ url('signin') }}">Ketty Rio</a></h3>
                                        <div class="group-count"><span>25</span> - Fashion</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="team6" role="tabpanel">
                                <div class="team-box">
                                    <div class="item-img">
                                        <img src="{{ asset('public/front/media/team/team_7.jpg')}}" alt="team">
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="{{ url('signin') }}">Ketty Rio</a></h3>
                                        <div class="group-count"><span>25</span> - Fashion</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="shape-wrap">
                    <li><img src="{{ asset('public/front/media/figure/shape_9.png')}}" alt="shape"></li>
                    <li><img src="{{ asset('public/front/media/team/shape_1.png')}}" alt="shape"></li>
                    <li><img src="{{ asset('public/front/media/team/shape_2.png')}}" alt="shape"></li>
                    <li><img src="{{ asset('public/front/media/team/shape_circle_1.png')}}" alt="shape"></li>
                    <li><img src="{{ asset('public/front/media/team/shape_circle_2.png')}}" alt="shape"></li>
                    <li><img src="{{ asset('public/front/media/team/shape_circle_3.png')}}" alt="shape"></li>
                    <li><img src="{{ asset('public/front/media/team/shape_3.png')}}" alt="shape"></li>
                    <li><img src="{{ asset('public/front/media/team/shape_4.png')}}" alt="shape"></li>
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
<!--=====================================-->
<!--=         Why Choose  Start         =-->
<!--=====================================-->
<section class="why-choose-fluid">
    <div class="container-fluid full-width">
        <div class="row no-gutters">
            <div class="col-lg-6">
                <div class="why-choose-content">
                    <div class="content-box">
                        <h2 class="item-title">Baeecay Makes Your Life Easier &amp; Simple</h2>
                        <p>Aliquam lorem ante dapibus in viverra quis feugiat atellu Peaselus vierra nullaut metus varius laoreet unknown printer took scrambled make.</p>
                        <a href="{{ url('about-us') }}" class="button-slide">
                            <span class="btn-text">Read More</span>
                            <span class="btn-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                                    <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="why-choose-img">
                    <div class="image-box">
                        <img src="{{ asset('public/front/media/figure/why_choose_1.jpg')}}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=         Location Find Start       =-->
<!--=====================================-->
<section class="section location-find">
    <div class="container">
        <div class="section-heading">
            <h2 class="heading-title">Find People Near You</h2>
            <p>when an unknown printer took a galley of type and meeting fari scrambled it to make a type specimen book. </p>
        </div>
        <div class="row gutters-20">
<!--             <div class="col-lg-6">
                <div class="location-box">
                    <div class="item-img">
                        <a href="{{ url('signin') }}">
                            <img src="{{ asset('public/front/media/location/location_1.jpg')}}" alt="Newyork City">
                        </a>
                    </div>
                    <div class="item-content">
                        <h3 class="item-title"><a href="{{ url('signin') }}">Newyork City</a></h3>
                    </div>
                </div>
            </div> -->
            @foreach(DB::Table('places')->where('published_status' , 'published')->where('show_on_homepage' , 'yes')->get() as $r)
            <div class="col-sm-3">
                <div class="location-box">
                    <div class="item-img">
                        <a href="{{ url('signin') }}">
                            <img src="{{ asset('public/images')}}/{{ $r->image }}" alt="Newyork City">
                        </a>
                    </div>
                    <div class="item-content">
                        <h3 class="item-title"><a href="{{ url('signin') }}">{{ $r->name }}</a></h3>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=         Banner Apps  Start        =-->
<!--=====================================-->
<section class="banner-apps">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex align-items-center">
                <div class="banner-content">
                    <h2 class="item-title">We help you to find your next date all over the World</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                    <a href="https://themeforest.net/user/radiustheme/portfolio" class="button-slide">
                        <span class="btn-text">Purchase Now</span>
                        <span class="btn-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                                <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-img">
                    <div class="apps-view">
                        <img src="{{ asset('public/front/media/banner/apps.png')}}" alt="Apps">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section blog-grid">
    <div class="container">
        <div class="section-heading flex-heading">
            <div class="row">
                <div class="col-lg-5">
                    <h2 class="heading-title">Discover Our Awesome Blogs &amp; Stories</h2>
                </div>
                <div class="col-lg-7">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elitsed do eiusmod tempor utlabore et dolore magna aliqua enim miniectetur adipisicing eliteiusmod dolore magna aliqua Ut enim ad minim veniam.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($blogs as $r)
            <div class="col-lg-4 col-md-6">
                    <div class="block-box user-blog">
                        <div class="blog-img">
                            <a href="{{ url('blog') }}/{{ $r->url }}">
                                <img src="{{ url('public/images/') }}/{{ $r->image }}" alt="Blog">
                            </a>
                        </div>
                        <div class="blog-content">
                            <div class="blog-category">
                                <a href="{{ url('blog-category') }}/{{ DB::table('blogcategories')->where('id' , $r->cat_id)->get()->first()->slug }}">{{ DB::table('blogcategories')->where('id' , $r->cat_id)->get()->first()->name }}</a>
                            </div>
                            <h3 class="blog-title"><a href="{{ url('blog') }}/{{ $r->url }}">{{$r->name }}</a></h3>
                            <div class="blog-date"><i class="icofont-calendar"></i>{{ date('d M Y', strtotime($r->created_at)) }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!--=====================================-->
<!--=          NewsLetter Start             =-->
<!--=====================================-->
<section class="banner-newsletter">
    <ul class="section-cloud">
        <li><img src="{{ asset('public/front/media/figure/cloud_1.png')}}" alt="shape"></li>
        <li><img src="{{ asset('public/front/media/figure/cloud_2.png')}}" alt="shape"></li>
        <li><img src="{{ asset('public/front/media/figure/cloud_2.png')}}" alt="shape"></li>
        <li><img src="{{ asset('public/front/media/figure/cloud_1.png')}}" alt="shape"></li>
    </ul>
    <div class="container">
        <ul class="section-shape">
            <li><img src="{{ asset('public/front/media/figure/shape_1.png')}}" alt="shape"></li>
            <li><img src="{{ asset('public/front/media/figure/shape_2.png')}}" alt="shape"></li>
            <li><img src="{{ asset('public/front/media/figure/shape_3.png')}}" alt="shape"></li>
            <li><img src="{{ asset('public/front/media/figure/shape_4.png')}}" alt="shape"></li>
            <li><img src="{{ asset('public/front/media/figure/shape_5.png')}}" alt="shape"></li>
        </ul>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="newsletter-box">
                    <h2 class="item-title">Subscribe Baeecay Newsletter</h2>
                    <p>Subscribe to be the first one to know about updates, new features and much more! Enter your email</p>
                    <form action="{{ url('submitnewsletter') }}" method="POST">
                        {{ csrf_field() }}
                    <div class="input-group">
                        <input required type="text" name="email" class="form-control" placeholder="Enter your e-mail">
                        <div class="input-group-append">
                            <button class="button-slide" type="submit">
                                <span class="btn-text">Subscribe Now</span>
                                <span class="btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="10px">
                                        <path fill-rule="evenodd" fill="#ffffff" d="M16.671,9.998 L12.997,9.998 L16.462,6.000 L5.000,6.000 L5.000,4.000 L16.462,4.000 L12.997,0.002 L16.671,0.002 L21.003,5.000 L16.671,9.998 ZM17.000,5.379 L17.328,5.000 L17.000,4.621 L17.000,5.379 ZM-0.000,4.000 L3.000,4.000 L3.000,6.000 L-0.000,6.000 L-0.000,4.000 Z" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page-scripts')
    
@endsection