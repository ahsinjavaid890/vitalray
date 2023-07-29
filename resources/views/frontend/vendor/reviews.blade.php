@extends('layouts.vendor-app')
@section('title')
<title>Ratings & Reviews</title>
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
                                <li>Ratings & Reviews</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Dashboard breadcrumb ends-->
<!--Dashboard content starts-->
<div class="dash-content">
    <div class="container-fluid">
        <div class="row">
            <div class="dash-review-wrap">
                <div class="act-title">
                    <h5><i class="ion-ios-star-outline"></i> Received Reviews</h5>
                </div>
                <div class="db-review-item-wrap">
                    <div class="single-review-item">
                        <div class="customer-review_wrap">
                            <div class="reviewer-img">
                                <img src="images/clients/reviewer-1.png" class="img-fluid" alt="...">
                                <p>Frank Jane</p>
                                <div class="list-ratings">
                                    <i class="ion-android-star"></i>
                                    <i class="ion-android-star"></i>
                                    <i class="ion-android-star"></i>
                                    <i class="ion-android-star"></i>
                                    <i class="ion-android-star-half"></i>
                                </div>
                            </div>
                            <div class="customer-content-wrap">
                                <div class="customer-content">
                                    <div class="customer-review">
                                        <h6>Hotel Ocean Paradise</h6>
                                        <p>Posted 2 days ago</p>
                                    </div>
                                </div>
                                <p class="customer-text">I love the hotel here but it is so rare that I get to come here. Tasty Hand-Pulled hotel is the best type of whole in the wall restaurant. The staff are really nice, and you should be seated quickly.
                                </p>
                                

                                <div class="like-btn mar-top-40">
                                    <a href="#" data-toggle="modal" data-target="#reply-review" class="rate-review"><i class="icofont-reply"></i>Reply</a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal fade" id="reply-review">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Reply To Review</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="ion-ios-close-empty"></i></span></button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-reply-review">
                                    <textarea class="reply-review__textarea p-3" rows="5"></textarea>

                                </div>
                                <div class="mar-top-30"><a href="javascript:void(0)" class="btn v1">Reply</a></div>
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
