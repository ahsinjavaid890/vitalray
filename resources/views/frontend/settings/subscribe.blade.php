@extends('frontend.layouts.front-app')
@section('content')
<div class="container">
    <div class="row">
    	<div class="col-lg-8 widget-block widget-break-lg">
            <div class="widget widget-user-about">
                <div class="widget-heading">
                    <h3 class="widget-title">Subscription Settings</h3>
                </div>
                <div class="user-info">
                    <div class="block-box">
                        <div class="row">
                            @foreach(DB::table('subscriptionplans')->where('status' , 1)->get() as $r)
                            <div style="margin-bottom: 20px;" class="col-lg-6">
                                <div class="card bg-success mb-5 mb-lg-0 rounded-lg shadow">
                                    <div class="card-header">
                                        <h5 class="card-title text-white-50 text-uppercase text-center">{{ $r->name }}</h5>
                                        <h6 class="h1 text-white text-center">${{ $r->price }}<span class="h6 text-white-50">/{{ $r->duration }} Days</span></h6>
                                    </div>
                                    <div class="card-body bg-light rounded-bottom">
                                        <ul class="list-unstyled mb-4">
                                            <li class="text-muted mb-3">{{ $r->places_allowed }} Images Upload</li>
                                            <li class="text-muted mb-3">{{ $r->feature1 }}</li>
                                            <li class="text-muted mb-3">{{ $r->feature2 }}</li>
                                            <li class="text-muted mb-3">{{ $r->feature3 }}</li>
                                            <li class="text-muted mb-3">{{ $r->feature4 }}</li>
                                            <li class="text-muted mb-3">{{ $r->feature5 }}</li>
                                            <li class="text-muted mb-3">{{ $r->feature6 }}</li>
                                        </ul>
                                        <a href="{{ url('profile/settings/subscribe') }}/{{ $r->id }}" class="btn btn-block btn-primary">Select Plan</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection