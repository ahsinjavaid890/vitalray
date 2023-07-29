@extends('auth.authlayout')
@section('title')
<title>Sign Up | Step 3</title>
@endsection
@section('content')
<!-- <div id="preloader"></div> -->
<div id="wrapper" class="wrapper overflow-hidden">
    <div class="login-page-wrap">
    <div class="content-wrap">
        <div class="login-content">
            <div class="item-logo">
                <a href="{{ url('') }}"><img src="{{ asset('public/images/') }}/{{ Cmf::get_store_value('footer_logo') }}" alt="logo" width="220px"></a>
            </div>
            <div class="login-form-wrap">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link"  href="{{ url('signin') }}"><i class="icofont-users-alt-4"></i> Sign In </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link active"  href="{{ url('signup') }}"><i class="icofont-download"></i> Registration</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <h3 class="item-title">Sign Up Your Account</h3>
                    <p></p>
                    <h5>Step 3 Out of 6 Steps</h5>
                    <form id="regForm" method="POST" action="{{ route('user.registerthree') }}">
                     @csrf
                     <div class="row">
                            @foreach(DB::table('subscriptionplans')->where('status' , 1)->get() as $r)
                            <div style="margin-bottom: 20px;" class="col-lg-4">
                                <div id="plan{{ $r->id }}" class="card mb-5 mb-lg-0 rounded-lg shadow" style="background-color: #16131c">
                                    <div class="card-header">
                                        <h5 class="card-title text-white text-uppercase text-center">{{ $r->name }}</h5>
                                        <h6 class="h1 text-white text-center">${{ $r->price }}</h6>
                                    </div>
                                    <div style="background-color: #16131c!important" class="card-body bg-light rounded-bottom">
                                        <ul  class="list-unstyled mb-4">
                                            <li class="text-white mb-3">{{ $r->places_allowed }} Images Upload</li>
                                            <li class="text-white mb-3">{{ $r->feature1 }}</li>
                                            <li class="text-white mb-3">{{ $r->feature2 }}</li>
                                            <li class="text-white mb-3">{{ $r->feature3 }}</li>
                                            <li class="text-white mb-3">{{ $r->feature4 }}</li>
                                            <li class="text-white mb-3">{{ $r->feature5 }}</li>
                                            <li class="text-white mb-3">{{ $r->feature6 }}</li>
                                        </ul>
                                        <a class="btn btn-primary btn-block" onclick="selectplan({{ $r->id }})"> Select Plan</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="selectedplan" id="planselect">
                        <div class="row">
                            <div class="col-lg-6 text-left">
                                <a style="text-align: center;" href="{{ route('user.steptwo') }}" class="btn btn-primary">Back</a>
                            </div>
                            <div class="col-lg-6 text-right">
                                <button disabled id="submitbutton" type="submit" class="btn btn-primary">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="map-line">
            <img src="{{ asset('public/front/media/banner/map_line2.png') }}" alt="map">
            <ul class="map-marker">
                <li><img src="{{ asset('public/front/media/banner/marker_1.png') }}" alt="marker"></li>
                <li><img src="{{ asset('public/front/media/banner/marker_2.png') }}" alt="marker"></li>
                <li><img src="{{ asset('public/front/media/banner/marker_3.png') }}" alt="marker"></li>
                <li><img src="{{ asset('public/front/media/banner/marker_4.png') }}" alt="marker"></li>
            </ul>
        </div>
    </div>
</div>
</div>
<style type="text/css">
    .selectedplan{
        background-color: #F88F96 !important;
    }
</style>
<script type="text/javascript">
    function selectplan(id)
    {
        $('#submitbutton').removeAttr('disabled')
        $('#planselect').val(id);
        $('.card').removeClass('selectedplan');
        $('#plan'+id).addClass('selectedplan')
    }
</script>
@endsection