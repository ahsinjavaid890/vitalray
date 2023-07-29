@extends('frontend.layouts.front-app')
@section('meta-tags')
<title>Go On Date | BAEECAY</title>
@endsection
@section('content')

<div class="container">
   <div class="block-box user-search-bar">
        <div class="box-item search-box">
            <div class="input-group">
                <input id="searchcountry" onkeyup="searccountries(this.value)" type="text" class="form-control" placeholder="Search Country">
                <div class="input-group-append">
                    <button class="search-btn" type="button"><i class="icofont-search"></i></button>
                </div>
            </div>
        </div>
        <div class="box-item search-filter">
            <div class="dropdown">
                <label>Order By:</label>
                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Newest Dates</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">All</a>
                    <a class="dropdown-item" href="#">Newest Dates</a>
                    <a class="dropdown-item" href="#">Oldest Dates</a>
                </div>
            </div>
        </div>
        
    </div>
    <div id="user-view" class="user-grid-view">
        <div class="row mb-3">
            <div class="col-md-12">
                <h4>Top BAECAY Spots WorldWide</h4>
            </div>
        </div>
        <div class="row gutters-20" id="countries">
        	@foreach($data as $r)
            @php
            $dates = DB::table('users')->where('user_type' , 'customer')->where('country' , $r->id)->whereNotIn('id', [Auth::user()->id])->where('active' , 1)->count();
            @endphp
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="widget-author user-group">
                    <div class="author-heading">
                        <div class="cover-img">
                            <img class="city-height" src="{{ asset('public/images') }}/{{ $r->image }}" alt="cover">
                        </div>
                        
                        <div class="profile-name city-thumb">
                            <h4 class="author-name"><a href="{{ url('searchcountry') }}/{{ $r->id }}">{{ $r->name }}</a></h4>
                            <div class="author-location">{{ $dates }} Dates</div>
                        </div>
                    </div>
                    <ul class="member-thumb mb-0 mt-0">
                        @if($dates > 0)
                        @foreach(DB::table('users')->where('user_type' , 'customer')->where('country' , $r->id)->whereNotIn('id', [Auth::user()->id])->where('active' , 1)->limit(5)->get() as $u)
                        <a href="{{ url('profile') }}/{{ $u->username }}"><li><img src="{{ asset('public/images') }}/{{ $u->profileimage }}" alt="member"></li></a>
                        @endforeach
                        <li><i class="icofont-plus"></i></li>
                        @else
                        <a href="{{ url('searchcountry') }}/{{ $r->id }}">
                            <li><i class="icofont-plus"></i></li>
                        </a>
                        @endif
                    </ul>
                    
                </div>
            </div>
            @endforeach
       <!--  <div class="row mb-3">
            <div class="col-md-12">
                <h4>Other Places</h4>
            </div>
        </div> -->
    </div>
</div>
@endsection