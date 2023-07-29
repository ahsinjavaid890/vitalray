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
                                <li>Listings</li>
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

<!-- Dashboard Content starts-->
            <div class="dash-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="recent-activity my-listing">
                                <div class="act-title">
                                    <h5><i class="ion-social-buffer-outline"></i> My Listings</h5>
                                </div>

                                <div class="viewd-item-wrap">
                                    <div class="most-viewed-item">
                                        <div class="most-viewed-img">
                                            <a href="#"><img src="{{asset('public/front/images/images/single-listing/gallery-6.jpg')}}" alt="..."></a>
                                        </div>
                                        <div class="most-viewed-detail">
                                            
                                            <h3><a href="{{url('hotel/detail')}}">Hilton Moorea</a></h3>
                                            <p class="list-address"><i class="icofont-google-map"></i>4210 Khale Street, Florence, USA</p>

                                            <div class="ratings">
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star-half"></i>
                                            </div>
                                            <div class="views">Ratings : <span>325</span></div>
                                        </div>
                                        <div class="listing-button">
                                            <a href="#" class="btn v2"><i class="ion-edit"></i> Edit</a>
                                            <a href="#" class="btn v5"><i class="ion-android-delete"></i> Delete</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Dashboard Content ends-->

@endsection
