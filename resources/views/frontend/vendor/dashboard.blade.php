@extends('layouts.vendor-app')
@section('title')
<title>Dashboard</title>
<meta name="DC.Title" content="Dashboard">
<meta name="rating" content="general">
<meta name="description" content="Dashboard">
@section('content')


<!--Dashboard breadcrumb starts-->
<div class="dash-breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="dash-breadcrumb-content">
                    <div class="dash-breadcrumb-left">
                        <div class="breadcrumb-menu text-right sm-left">
                            <ul>
                                <li class="active"><a href="#">Home</a></li>
                                <li>Dashboard</li>
                            </ul>
                        </div>
                    </div>
                    <a class="btn v3" href="{{url('vendor/add-listing')}}"><i class="ion-plus-round"></i>Add Listing </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Dashboard breadcrumb ends-->

<!-- Dashboard Statistics starts-->
<div class="statistic-wrap">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6 col-12">
                <div class="statistic__item item--green">
                    <h2 class="counter-value">18</h2>
                    <span class="desc">Published Listings</span>
                    <div class="icon">
                        <img src="{{asset('public/front/images/dashboard/map-of-roads.png')}}" alt="...">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="statistic__item item--orange">
                    <h2 class="counter-value">115</h2>
                    <span class="desc">Total Reviews</span>
                    <div class="icon">
                        <img src="{{asset('public/front/images/dashboard/review.png')}}" alt="...">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="statistic__item item--blue">
                    <h2 class="counter-value">800</h2>
                    <span class="desc">Total Views</span>
                    <div class="icon">
                        <img src="{{asset('public/front/images/dashboard/bar-chart.png')}}" alt="...">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="statistic__item item--red">
                    <h2 class="counter-value">15</h2>
                    <span class="desc">times Bookmarked</span>
                    <div class="icon">
                        <img src="{{asset('public/front/images/dashboard/like.png')}}" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Dashboard Statistics ends-->

<!--Dashboard content starts-->
<div class="dash-content">
    <div class="container-fluid">
        <div class="row pb-5">
            <div class="col-xl-6 col-md-12">
                <div class="popular-listing">
                    <div class="act-title">
                        <h5>Rceent Bookings</h5>
                    </div>
                    <div class="viewd-item-wrap">
                        <div class="most-viewed-item">
                            <div class="most-viewed-img">
                                <a href="#"><img src="{{asset('public/front/images/single-listing/gallery-6.jpg')}}" alt="..."></a>
                            </div>
                            <div class="most-viewed-detail">
                                
                                <h3><a href="#">Four Seasons Resort</a></h3>
                                From : 12 Jun 
                                <div class="views">To : <span>15 Jun 2021</span></div>
                                <p class="date">2 Adults, 2 Children </p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--Dashboard content ends-->

@endsection
