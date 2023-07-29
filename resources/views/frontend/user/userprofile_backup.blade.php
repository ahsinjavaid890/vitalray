@extends('frontend.layouts.front-app')


@section('content')
<div class="container">
    <!-- Banner Area Start -->
    @include('frontend.user.profileheader')
    <div class="row">
        <div class="col-lg-8 widget-block widget-break-lg">

            <div class="widget widget-user-about">
                <div class="widget-heading">
                    <h3 class="widget-title">About Me</h3>
                </div>
                <div class="user-info">
                    <p>{{ $data->about }}</p>
                    <ul class="info-list">
                        <li><span>Joined:</span>{{ Cmf::date_format($data->created_at) }}</li>
                        <li><span>E-mail:</span>{{ $data->email }}</li>
                        <li><span>Address:</span>59 Street Neworkcity</li>
                        @if($data->phonenumber)
                        <li><span>Phone:</span>{{ $data->phonenumber }}</li>
                        @endif
                        <li><span>Country:</span>USA</li>
                        <li><span>Web:</span><a href="#">www.rebeca.com</a></li>
                        <li><span>Sexual Fantasies </span>BDSM</li>
                        <li><span>Marijauna </span>Pills, Drugs</li>
                        <li><span>Pronoun Preferences </span>He</li>
                        <li><span>Sex Identification </span>Prefer not to answer</li>
                        <li><span>Annual Salary </span>40k plus</li>
                        
                    </ul>
                </div>
            </div>

            <div class="widget widget-user-about">
                <div class="widget-heading">
                    <h3 class="widget-title">People Reviews</h3>
                </div>
                <div class="user-info">
                    <div class="single-product-info">
                        
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="reviews" role="tabpanel">
                                <div class="product-review">
                                    @foreach(DB::table('peoplereviews')->where('user_id' , $data->id)->get() as $r)

                                    @php

                                        $user = DB::table('users')->where('id' , $r->from_id)->get()->first();

                                    @endphp

                                    <div class="media">
                                        <div class="item-img">
                                            @if($user->profileimage)
                                            <img style="width: 114px;height: 114px;" src="{{ asset('images')  }}/{{ $user->profileimage }}" alt="{{ $data->name }}">
                                            @else
                                            <img src="{{ asset('front/media/profileavatar.png') }}">
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <div class="item-date">{{ Cmf::date_format($r->created_at) }}</div>
                                            <div class="author-name">
                                                <h5 class="item-title">{{ $user->name }}</h5>
                                                <div class="item-rating">
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                </div>
                                            </div>
                                            <p>{{ $r->review }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @if(Auth::user()->id != $data->id)
                                <div class="review-form">
                                    <h3 class="heading-title">Write a Review</h3>
                                    <form method="POST" action="{{ url('profile/submitreview') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $data->id }}" name="user_id">
                                        <div class="row gutters-15">
                                            <div class="col-lg-12 form-group">
                                                <div class="item-rating">
                                                    <i onclick="starpick(1)" id="star1" class="icofont-star"></i>
                                                    <i onclick="starpick(2)" id="star2" class="icofont-star"></i>
                                                    <i onclick="starpick(3)" id="star3" class="icofont-star"></i>
                                                    <i onclick="starpick(4)" id="star4" class="icofont-star"></i>
                                                    <i onclick="starpick(5)" id="star5" class="icofont-star"></i>
                                                </div>
                                            </div>
                                            <input type="hidden" name="star" id="rattings">
                                            <div class="col-12 form-group">
                                                <textarea required class="form-control textarea" placeholder="Comment Here *" name="message" id="message" cols="30" rows="6"></textarea>
                                            </div>
                                            <div class="col-12 form-group">
                                                <button class="submit-btn">SUBMIT</button>
                                            </div>
                                        </div>
                                        <div class="form-response"></div>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 widget-block widget-break-lg">
            <div class="widget widget-gallery">
                <div class="widget-heading">
                    <h3 class="widget-title">Photo Gallery</h3>
                    <div class="dropdown">
                        <a href="{{ url('profile/details/gallery') }}">View All</a>
                    </div>
                </div>
                <ul class="photo-list gutters-20 zoom-gallery">
                    @foreach(DB::table('mediaimages')->where('user_id' , $data->id)->limit(6)->get() as $r)
                    <li>
                        <div class="user-group-photo">
                            <a href="{{ asset('images') }}/{{ $r->images }}" class="popup-zoom">
                                <img src="{{ asset('images') }}/{{ $r->images }}" alt="{{ $data->name }}">
                            </a>
                        </div>
                    </li>
                    @endforeach
                    

                    
                </ul>
            </div>
            <div class="widget widget-comment">
                <div class="widget-heading">
                    <h3 class="widget-title">Places I Want to go</h3>
                </div>
                <div class="group-list">
                    <div class="media">
                        <div class="item-img">
                            <a href="#">
                                <img src="{{ asset('front/media/figure/widget_comment1.jpg') }}" alt="post">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="post-date">JULY 24, 2020</div>
                            <h4 class="item-title"><a href="#">United States</a></h4>
                        </div>
                    </div>
                    <div class="media">
                        <div class="item-img">
                            <a href="#">
                                <img src="{{ asset('front/media/figure/widget_comment2.jpg') }}" alt="post">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="post-date">JULY 24, 2020</div>
                            <h4 class="item-title"><a href="#">United Arab Emirits</a></h4>
                        </div>
                    </div>
                    <div class="media">
                        <div class="item-img">
                            <a href="#">
                                <img src="{{ asset('front/media/figure/widget_comment3.jpg') }}" alt="post">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="post-date">JULY 24, 2020</div>
                            <h4 class="item-title"><a href="#">United Kingdom</a></h4>
                        </div>
                    </div>
                    <div class="media">
                        <div class="item-img">
                            <a href="#">
                                <img src="{{ asset('front/media/figure/widget_comment4.jpg') }}" alt="post">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="post-date">JULY 24, 2020</div>
                            <h4 class="item-title"><a href="#">Uganda</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection