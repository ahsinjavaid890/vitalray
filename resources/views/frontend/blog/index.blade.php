@extends('frontend.layouts.front-app-home')
@section('title')
<title>{{ $data->name }}</title>
<meta name="DC.Title" content="{{ $data->name }}">
<meta name="rating" content="general">
<meta name="description" content="{{ $data->name }}">
<meta property="og:type" content="website">
<meta property="og:image" content="{{ url('public/images') }}/{{ $data->image }}">
<meta property="og:title" content="{{ $data->name }}">
<meta property="og:description" content="{{ $data->name }}">
<meta property="og:site_name" content="{{ $data->name }}">
<meta property="og:url" content="{{ URL::current() }}">
<meta property="og:locale" content="it_IT">
@endsection
@section('content')
@include('admin.alerts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<style type="text/css">
    p{
        color: white !important;
    }
    li{
        color: white !important;
    }
    h1{
        color: white !important;
    }
    h2{
        color: white !important;
    }
    h3{
        color: white !important;
    }
    h4{
        color: white !important;
    }
    h5{
        color: white !important;
    }
</style>
<section class="contact-page">
    <div class="contact-box-wrap mt-100">
        <div class="container">
        <div class="block-box user-single-blog">
            <div class="blog-thumbnail">
                <img style="width: 100%;height: 400px;" src="{{ url('public/images') }}/{{ $data->image }}" alt="Blog">
            </div>
            <div class="blog-content-wrap">
                <div class="blog-entry-header">
                    <h2 class="entry-title">{{ $data->name }}</h2>
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <ul class="entry-meta">
                                <li><i class="icofont-calendar"></i> {{ date('M d, Y', strtotime($data->created_at)) }}</li>
                                <li><i class="icofont-comment"></i> Comments: {{ DB::table('blogcoments')->where('blogs' , $data->id)->where('visible_status' , 'Published')->where('delete_status' , 'Active')->count() }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="blog-content">
                    {!! $data->blog !!}
                </div>
                @if(DB::table('blogcoments')->where('blogs' , $data->id)->where('visible_status' , 'Published')->where('delete_status' , 'Active')->count() > 0)
                <div class="comentssection">
                    <h2>Comments ({{ DB::table('blogcoments')->where('blogs' , $data->id)->where('visible_status' , 'Published')->where('delete_status' , 'Active')->count() }})</h2>
                    @foreach(DB::table('blogcoments')->where('blogs' , $data->id)->where('visible_status' , 'Published')->where('delete_status' , 'Active')->get() as $r)
                    <div class="row">
                        <div class="col-md-12">
                            <h4>{{ $r->name }}</h4>
                        </div>
                        <div class="col-md-12">
                            <p>{{ $r->coment }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                <div class="blog-comment-form">
                    <h3 class="item-title">Leave a Comment</h3>
                    <form id="blogcomentform" class="blog-form" method="POST" action="{{ url('saveblogcoment') }}">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $data->id }}" name="blogid">
                        <div class="row gutters-20">
                            <div class="col-lg-6 form-group">
                                <input required="" name="name" @if(Auth::check()) value="{{ Auth::user()->name }}" @endif type="text" class="form-control" placeholder="Enter Your Full Name" required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <input required="" name="email" @if(Auth::check()) value="{{ Auth::user()->email }}" @endif type="email" class="form-control" placeholder="Enter Your Email Address" required>
                            </div>
                            <div class="col-lg-12 form-group">
                                <textarea cols="30" rows="7" id="comment" name="coment" placeholder="Write A Message" class="textarea  form-control" required></textarea>
                            </div>
                            <div class="col-12 form-group">
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="6Ldnm4gaAAAAALukYm-bJQ7jdDehj5_hwf0VKUqE"></div>
                                </div>
                                @error('g-recaptcha-response')
                                <div style="color: red">The Captcha is Required.</div>
                                @enderror
                            </div>
                            <div class="col-lg-12 form-group">
                                <input type="submit" class="submit-btn" name="post-comment" value="Post Comment">
                            </div>
                        </div>
                    </form>
                </div>

                


            </div>
        </div>
        
    </div>
    </div>
</section>
@include('includes.newsletter')
@endsection