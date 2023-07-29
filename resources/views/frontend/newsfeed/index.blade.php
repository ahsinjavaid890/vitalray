@extends('frontend.layouts.front-app')

@section('meta-tags')
<title>Find People | BAEECAY</title>
@endsection

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<div class="container">
    <!-- Banner Area Start -->
    
    <div class="newsfeed-search mt-2">
        <ul class="member-list">
            <li class="active-member">
                <a href="#">
                    <span class="member-icon">
                        <i class="icofont-users"></i>
                    </span>
                    <span class="member-text">
                        Total Members:
                    </span>
                    <span class="member-count">{{ DB::table('users')->where('user_type' , 'customer')->whereNotIn('id', [Auth::user()->id])->where('active' , 1)->where('is_admin' , 0)->count() }}</span>
                </a>
            </li>
        </ul>
        <ul class="search-list">
            <li class="search-filter">
                <button class="drop-btn" type="button">
                    <i class="icofont-abacus-alt"></i>
                </button>
                <div class="drop-menu">
                    <select class="select2">
                        <option>--Everything--</option>
                        <option>Status</option>
                        <option>Quotes</option>
                        <option>Photos</option>
                        <option>Videos</option>
                        <option>Audios</option>
                        <option>slideshows</option>
                        <option>files</option>
                        <option>Updates</option>
                        <option>New Members</option>
                        <option>Posts</option>
                        <option>New Groups</option>
                    </select>
                </div>
            </li>
            <li class="search-input">
                <button class="drop-btn" type="button">
                    <i class="icofont-search"></i>
                </button>
                <div class="drop-menu">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search....">
                        <div class="input-group-append">
                            <button class="search-btn" type="button"><i class="icofont-search-1"></i></button>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <style type="text/css">
        #mapid { height: 380px; border-radius: 10px; }

    </style>
    <style type="text/css">
          .pad-o {
            padding-bottom: 0px !important;
        }
        .item-pets {
            border-bottom: 1px solid #ebebeb;
        }
        .thumb-image {
            display: block;
            width: 100%;
            
            position: relative;
        }


        .leaflet-container a {
            color: #0078A8;
        }
        .star-ul {
            list-style: none;
            padding: 0px;
            margin: 0px;
        }

        .leaflet-popup-content
        {
          width: 273px;
        }

        .star-ul li {
            float: left;
            margin-right: 10px;
            color: #fdc600;
        }
        </style>
    <div class="row">
        <div class="col-md-12">
            <div id="mapid"></div>
        </div>
    </div>
    <script type="text/javascript">
            var membersnetwork = L.map('mapid').setView(['36.133106','-96.027611'],10 , 20);
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
          maxZoom: 18
        }).addTo(membersnetwork);
        var greenIcon = L.icon({
            iconUrl: 'https://freeiconshop.com/wp-content/uploads/edd/person-outline.png',
            iconSize:     [30, 60],
            shadowSize:   [25, 32],
            iconAnchor:   [11, 47],
            shadowAnchor: [4, 62],
            popupAnchor:  [-3, -76]
        }); 
        @foreach(DB::table('users')->whereNotIn('user_type', ['admin'])->whereNotIn('id', [Auth::user()->id])->wherenotNull('lattitude')->get() as $r)
          var marker = L.marker([{{ $r->lattitude }}, {{ $r->longitude }}]).addTo(membersnetwork).bindPopup('<div class="row item-pets"><div class="col-md-5 col-sm-6"><div class="item-loop pad-o"><div class="thumb-image img-cat-imp"><a href="{{ url("profile") }}/{{ $r->username }}"><img  class="img-responsive lazy error img-cover" data-src="{{ url("public/images") }}/{{ $r->profileimage }}" alt="{{ $r->name }}" src="{{ url("public/images") }}/{{ $r->profileimage }}" data-was-processed="true" /></a></div></div></div><div class="col-lg-7 col-md-6 col-sm-6 col-12"><div class="row"><div class="col-md-12"><div class="item-loop border-none"><div class="item-title f-20 pet-title"><a href="{{ url("") }}/{{ $r->username }}"><i class="fa fa-bolt d-none"></i>{{ $r->name }}</a></div><div class="location p-detail-location">{{ $r->about }}</div></div></div></div></div></div>');
        @endforeach
        </script>
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
					                    <img style="width: 98px;" src="{{ asset('public/front/media/profileavatar.png') }}">
					                    @endif

                                    </a>
                                </div>
                                <div class="profile-name mb-3">
                                    <h4 class="author-name"><a href="{{ url('profile') }}/{{ $r->username }}">{{ $r->name }}</a></h4>
                                </div>
                                
                            </div>
                            <ul class="author-statistics">
                                <li>
                                    <a href="{{ url('profile') }}/{{ $r->username }}"><span class="item-number">

                                        @php
                                            $reviews = DB::table('peoplereviews')->where('user_id' , $r->id);
                                        @endphp


                                        @if($reviews->count() > 0)

                                            

                                            {{ $reviews->sum('rattings')/$reviews->count() }}

                                        @else

                                            Nan

                                        @endif

                                    </span> <span class="item-text">Overall Ratings</span></a>
                                </li>
                                <li>
                                    <a href="{{ url('profile') }}/{{ $r->username }}"><span class="item-number">{{ DB::table('selectedplaces')->where('user_id' , $r->id)->count() }}</span> <span class="item-text">Loved Places</span></a>
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

@endsection