@extends('frontend.layouts.front-app-home')
@section('meta-tags')
<title>Vital Ray</title>
@endsection
@section('content')

<style>
    / @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');/ * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
        / font-family: 'Open Sans', sans-serif;/
    }

    body {
        line-height: 1;
    }
    .card{
        /* background: linear-gradient(180deg, #4192DD 0%, #B45DE6 100%); */
        background: #386bc0;
    }

    .card-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 10px;
    }

    img {
        width: 100%;
        display: block;
    }

    .img-display {
        overflow: hidden;
    }

    .img-showcase {
        display: flex;
        width: 100%;
        transition: all 0.5s ease;
    }

    .img-showcase img {
        min-width: 100%;
    }

    .img-select {
        display: flex;
    }

    .img-item {
        margin: 0.3rem;
    }

    .img-item:nth-child(1),
    .img-item:nth-child(2),
    .img-item:nth-child(3) {
        margin-right: 0;
    }

    .img-item:hover {
        opacity: 0.8;
    }

    .product-content {
        padding: 2rem 1rem;
    }

    .product-title {
        font-size: 3rem;
        text-transform: capitalize;
        font-weight: 700;
        position: relative;
        color: #12263a;
        margin: 1rem 0;
    }

    /* .product-title::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 4px;
        width: 80px;
        background: #12263a;
    } */

    .product-link {
        text-decoration: none;
        text-transform: uppercase;
        font-weight: 400;
        font-size: 0.9rem;
        display: inline-block;
        margin-bottom: 0.5rem;
        background: #256eff;
        color: #fff;
        padding: 0 0.3rem;
        transition: all 0.5s ease;
    }

    .product-link:hover {
        opacity: 0.9;
    }

    .product-rating {
        color: #ffc107;
    }

    .product-rating span {
        font-weight: 600;
        color: #252525;
    }

    .product-price {
        margin: 1rem 0;
        font-size: 1rem;
        font-weight: 700;
    }

    .product-price span {
        font-weight: 400;
    }

    .last-price span {
        color: #f64749;
        text-decoration: line-through;
    }

    .new-price span {
        color: #256eff;
    }

    .product-detail h2 {
        text-transform: capitalize;
        color: #12263a;
        padding-bottom: 0.6rem;
    }

    .product-detail p {
        font-size: 0.9rem;
        padding: 0.3rem;
        opacity: 0.8;
    }

    .product-detail ul {
        margin: 1rem 0;
        font-size: 0.9rem;
    }

    .product-detail ul li {
        margin: 0;
        list-style: none;
        background-size: 18px;
        margin: 0.4rem 0;
        font-weight: 600;
        opacity: 0.9;
    }

    .product-detail ul li span {
        font-weight: 400;
    }

    .purchase-info {
        margin: 1.5rem 0;
    }

    .purchase-info input,
    .purchase-info .btn {
        border: 1.5px solid #ddd;
        border-radius: 25px;
        text-align: center;
        padding: 0.45rem 0.8rem;
        outline: 0;
        margin-right: 0.2rem;
        margin-bottom: 1rem;
    }

    .purchase-info input {
        width: 60px;
    }

    .purchase-info .btn {
        cursor: pointer;
        color: #fff;
    }

    .purchase-info .btn:first-of-type {
        background: #256eff;
    }

    .purchase-info .btn:last-of-type {
        background: #01d28e;
    }

    .purchase-info .btn:hover {
        opacity: 0.9;
    }

    @media screen and (min-width: 992px) {
        .card {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 1.5rem;
        }

        .card-wrapper {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product-imgs {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .product-content {
            padding-top: 0;
        }
    }
</style>


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

<div class="container mt-4">

    <div class="card-wrapper ">
        <div class="card px-2 ">
            <!-- card left -->
            <div class="product-imgs">
                <div class="img-display py-2">
                    <div class="img-showcase">

                        <img class="rounded" src="{{url('public/images')}}/{{$product->image}}" alt="">

                    </div>
                </div>
                <div class="img-select">
                    @php
                         $product_image = DB::table('products_images')->where('product_id',$product->id)->get()
                         ;
                    @endphp
                    @foreach ($product_image as $image)
                    <div class="img-item">
                        <a href="javascript:void(0)" data-id="1">
                            <img src="{{url('public/images')}}/{{$image->image}}" alt="">
                        </a>
                    </div>
                    @endforeach
                   
                    
                </div>
            </div>
            <!-- card right -->
            <div class="product-content py-3">
                <h3 class="product-title text-white">{{$product->name}}</h3>


                <div class="product-price">
                    <p class="new-price mb-0">New Price: Rs {{$product->price}}</p>
                </div>

                <div class="product-detail">
                    <h5 class="pb-0 bolder">About this item: </h5>
                    <p>{{$product->short_description}}</p>
                    <p>{{$product->description}}</p>


                 
                </div>

                <div class="purchase-info">
                    {{-- <input type="number" min="0" value="1"> --}}
                    <a class="btn" href="{{url('checkout')}}/{{$product->url}}">Buy Now</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection