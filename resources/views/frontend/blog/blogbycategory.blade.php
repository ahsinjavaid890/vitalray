@extends('frontend.layouts.front-app-home')
@section('title')
<title>Blogs | BAEECAY</title>
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
            <h1>{{ $category->name }}</h1>
            <ul>
                <li>
                    <a href="{{ url('') }}">Home</a>
                </li>
                <li>{{ $category->name }}</li>
            </ul>
        </div>
    </div>
    <div class="breadcrumb-animate-img" data-sal="slide-up" data-sal-duration="1000">
        <img src="{{ asset('public/front/media/figure/breadcrumb_img.png')}}" alt="img">
    </div>
</section>

<!--=====================================-->
<!--=          Contact Page Start       =-->
<!--=====================================-->
<section class="contact-page">
    
    <div class="contact-box-wrap mt-100">
        <div class="container">
            <div class="row gutters-20">
            	@foreach($data as $r)
                <div class="col-lg-4 col-md-6">
                    <div class="block-box user-blog">
                        <div class="blog-img">
                            <a href="{{ url('blog') }}/{{ $r->url }}">
                            	<img src="{{ url('public/images/') }}/{{ $r->image }}" alt="{{ $r->name }}">
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
            <!-- <div class="load-more-post">
                <a href="javascript:void(0)" class="item-btn"><i class="icofont-refresh"></i>Load More Posts</a>
            </div> -->
        </div>
    </div>
</section>

@include('includes.newsletter')
@endsection