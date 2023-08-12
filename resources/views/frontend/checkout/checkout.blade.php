@extends('frontend.layouts.front-app-home')
@section('meta-tags')
<title>Vital Ray</title>
@endsection
@section('content')
<div class="container">
    @if(Auth::check())
    <a class="btn btn-primary"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    @else
    <a class="btn btn-primary" href="{{ url('signin') }}">Sign In</a>
    <a class="btn btn-primary" href="{{ url('signup') }}">Sign Up</a>
    @endif
    @foreach(DB::table('dynamicpages')->where('visible_status' , 'Published')->get() as $r)
    <a class="btn btn-primary" href="{{ url('page') }}/{{ $r->slug }}">{{ $r->name }}</a>
    @endforeach
</div>
@php
$url = request()->segment(count(request()->segments()));
$product = DB::table('products')->where('url',$url)->first();
@endphp
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<div class="container">
    @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        </button>
    </div>
    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        </button>
    </div>
    @endif
</div>
<section class="mt-3">
    <div style="background: #386bc0;border-radius:10px" class="container  p-4">
        <div class="row">
            <div class="col-6">
                <h3 class="head">Information</h3>
                <form role="form" action="{{ url('stripepayment') }}" method="post" class="require-validation"
                    data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col">
                                    <label for="">Name</label>
                                    <input type="text" name="name" required class="form-control" placeholder="">
                                </div>
                                <div class="col">
                                    <label for="">Email</label>
                                    <input type="email" name="email" required class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="phonenumber" required class="form-control" placeholder="">
                                </div>
                                <div class="col">
                                    <label for="">Zipcode</label>
                                    <input type="text" name="zipcode" required class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">State</label>
                                    <input type="text" name="state" required class="form-control" placeholder="">
                                </div>
                                <div class="col">
                                    <label for="">City</label>
                                    <input type="text" name="city" required class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Address</label>
                                    <textarea name="address" class="form-control" cols="30" rows="3"></textarea>
                                </div>

                            </div>
                            <div class='form-row row'>
                                <div class='col-md-12 form-group required'>
                                    <label class='control-label'>Name on Card</label>
                                    <input class='form-control' size='4' type='text'>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-md-12 form-group required'>
                                    <label class='control-label'>Card Number</label>
                                    <input autocomplete='off' id="cc" class='form-control card-number' size='20'
                                        type='text'>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                    <label class='control-label'>CVC</label>
                                    <input id="cvv" autocomplete='off' class='form-control card-cvc'
                                        placeholder='ex. 311' maxlength="4" type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Month</label>
                                    <input class='form-control card-expiry-month' maxlength="2" id="month"
                                        placeholder='MM' size='2' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Year</label>
                                    <input class='form-control card-expiry-year' maxlength="4" id="year"
                                        placeholder='YYYY' size='4' type='text'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 text-right">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="price" value="{{$product->price}}">
                            <button type="submit" style="font-size: 18px"
                                class="btn-block mt-4 btn btn-warning text-white"> Pay With Credit Card</button>
                        </div>
                    </div>
                </form>


                <style type="text/css">
                    .selectedplan {
                        background-color: #F88F96 !important;
                    }

                    .hide {
                        display: none;
                    }
                </style>

                <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
                <script type="text/javascript" src="{{ asset('public/front/assets/payement.js') }}"></script>




            </div>
            @php
            $url = request()->segment(count(request()->segments()));
            $product = DB::table('products')->where('url',$url)->first();
            @endphp
            <div class="col-6">
                <div class="row px-3 ">

<<<<<<< Updated upstream
=======












                    </form>
                    <h4 class="my-2 text-center">OR</h4>

                    <form action="{{route('data')}}" method="post">
                        @csrf
                        <input type="hidden" required id="name_hidden" name="name">
                        <input type="hidden" required id="email_hidden" name="email">
                        <input type="hidden" required id="phonenumber_hidden" name="phonenumber">
                        <input type="hidden" required id="zipcode_hidden" name="zipcode">
                        <input type="hidden" required id="city_hidden" name="city">
                        <input type="hidden" required id="state_hidden" name="state">
                        <input type="hidden" required id="address_hidden" name="address">
                        <input type="hidden" required name="product_id" value="{{$product->id}}">
                        <input type="hidden" required name="price" value="{{$product->price}}">

                        <button type="submit" style="font-size: 18px" class=" btn-block btn btn-info text-white">
                            Pay With
                            Paypal</button>

                    </form>

>>>>>>> Stashed changes
                    @include('frontend.layouts.include.googlepay')


                </div>
            </div>


        </div>
    </div>
</section>
@endsection