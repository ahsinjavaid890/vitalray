@extends('layouts.vendor-app')
@section('title')
<title>Bookings</title>
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
                                <li>Bookings</li>
                            </ul>
                        </div>
                    </div>
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
                        <h5><i class="ion-social-buffer-outline"></i> My Bookings</h5>
                    </div>

                    <div class="db-booking-wrap">
                        <div class="db-booking-item">
                            <div class="booking-img">
                                <img src="images/single-listing/restaurant-6.jpg" alt="...">
                            </div>
                            <h4>La Quo Vadis<span class="book-pending">Pending</span></h4>

                            <div class="booking-info">
                                <h6>Booking date: </h6>
                                <ul class="booking_list">
                                    <li><span>13 June 2019</span> - <span>16 June 2019</span></li>
                                </ul>
                            </div>
                            <div class="booking-info">
                                <h6>Booking Details: </h6>
                                <ul class="booking_list">
                                    <li><span>3 Adults</span></li>
                                </ul>
                            </div>
                            <div class="booking-info">
                                <h6>Client: </h6>
                                <ul class="booking_list transparent">
                                    <li><span>Frank Jane</span></li>
                                </ul>
                            </div>
                            <div class="booking-info">
                                <h6>Phone Number: </h6>
                                <ul class="booking_list transparent">
                                    <li><span>+92340771223</span></li>
                                </ul>
                            </div>
                            <a href="#" class="btn v5 mt-4"><i class="ion-android-mail"></i> Send Message</a>
                            <ul class="buttons">
                                <li><a href="#0" class="btn v2"><i class="ion-ios-checkmark-outline"></i> Approve</a></li>
                                <li><a href="#0" class="btn v5"><i class="ion-ios-close-outline"></i> Reject</a></li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Dashboard Content ends-->

@endsection
