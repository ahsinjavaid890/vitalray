@extends('frontend.layouts.front-app')
@section('meta-tags')
<title>Places in {{ $country->name }} | Baeecay</title>
@endsection

@section('content')

<div class="container">
    <div class="product-page">
        <div class="product-breadcrumb block-box" style="background-image: url('{{ url('')  }}/public/images/{{ $country->image  }}');">
            <div class="breadcrumb-area">
                <h1 class="item-title">{{ $country->name }}</h1>
            </div>
        </div>
        @if($places->count() > 0)
         <div id="user-view" class="user-grid-view">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h4>Places in {{ $country->name }}</h4>
                    </div>
                </div>
                <div class="row gutters-20" id="countries">
                @foreach($places as $r)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="widget-author user-group">
                        <div class="author-heading">
                            <div class="cover-img">
                                <img class="city-height" src="{{ asset('public/images') }}/{{ $r->image }}" alt="cover">
                            </div>
                            
                            <div class="profile-name city-thumb">
                                <h4 class="author-name"><a href="{{ url('place') }}/{{ $r->id }}">{{ $r->name }}</a></h4>
                            </div>
                        </div>                
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        <div class="row mt-3">
        <div class="col-md-12">
            <div id="user-view" class="user-grid-view">
                <div class="row gutters-20">
                	@foreach($data as $r)
                    <div class="col-xl-3 col-lg-4 col-md-6" style="opacity: 1;">
                        <div class="widget-author">
                            <div class="author-heading">
                                @if(!empty($r->coverimage))
                                <div class="cover-img">
                                    <img src="{{ asset('public/images')  }}/{{ $r->coverimage  }}" alt="cover">
                                </div>
                                @endif
                                <div class="profile-img">
                                    <a href="{{ url('profile') }}/{{ $r->username }}">

                                    	@if($r->profileimage)
					                    <img style="width: 98px;height: 98px;" src="{{ asset('public/images') }}/{{ $r->profileimage }}" alt="{{ $r->name }}">
					                    @else
					                    <img style="width: 98px;" src="{{ asset('front/media/profileavatar.png') }}">
					                    @endif

                                    </a>
                                </div>
                                <div class="profile-name mb-3">
                                    <h4 class="author-name"><a href="{{ url('profile') }}/{{ $r->username }}">{{ $r->name }}</a></h4>
                                </div>
                                
                            </div>
                            <ul class="author-badge">
                                <li><a href="user-profile.html" class="bg-salmon-gradient"><i class="icofont-google-plus"></i></a></li>
                                <li><a href="user-profile.html" class="bg-amethyst-gradient"><i class="icofont-facebook"></i></a></li>
                                <li><a href="user-profile.html" class="bg-sun-gradient"><i class="icofont-instagram"></i></a></li>
                                <li><a href="user-profile.html" class="bg-jungle-gradient"><i class="icofont-twitter"></i></a></li>
                            </ul>
                            <ul class="author-statistics">
                                <li>
                                    <a href="{{ url('profile') }}/{{ $r->username }}"><span class="item-number">4.5</span> <span class="item-text">Overall Ratings</span></a>
                                </li>
                                <li>
                                    <a href="{{ url('profile') }}/{{ $r->username }}"><span class="item-number">12</span> <span class="item-text">Places Visiting</span></a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="pagination">
                    {!! $data->links('frontend.pagination') !!}
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection