@extends('frontend.layouts.front-app')


@section('content')
<style type="text/css">
    .user-info p{
        color: white !important;
    }
    .breadcrumb.wizard {
    padding: 0px;
    background: #242424;
    list-style: none;
    overflow: hidden;
    margin-top: 20px;
  font-size: 10px;
}
.breadcrumb.wizard>li+li:before {
    padding: 0;
}
.breadcrumb.wizard li {
    float: left;
}
.breadcrumb.wizard li.active a {
    background: brown;                   /* fallback color */
    background: #ffc107 ;
}
.breadcrumb.wizard li.completed a {
    background: brown;                   /* fallback color */
    background: #f08089;
}
.breadcrumb.wizard li.active a:after {
    border-left: 30px solid #ffc107 ;
}
.breadcrumb.wizard li.completed a:after {
    border-left: 30px solid #f08089;
}

.breadcrumb.wizard li a {
    color: white;
    text-decoration: none;
    padding: 10px 0 10px 45px;
    position: relative;
    display: block;
    float: left;
}
.breadcrumb.wizard li a:after {
    content: " ";
    display: block;
    width: 0;
    height: 0;
    border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
    border-bottom: 50px solid transparent;
    border-left: 30px solid #242424;
    position: absolute;
    top: 50%;
    margin-top: -50px;
    left: 100%;
    z-index: 2;
}
.breadcrumb.wizard li a:before {
    content: " ";
    display: block;
    width: 0;
    height: 0;
    border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
    border-bottom: 50px solid transparent;
    border-left: 30px solid white;
    position: absolute;
    top: 50%;
    margin-top: -50px;
    margin-left: 1px;
    left: 100%;
    z-index: 1;
}
.breadcrumb.wizard li:first-child a {
    padding-left: 15px;
}
.breadcrumb.wizard li a:hover { background: #13151B  ; }
.breadcrumb.wizard li a:hover:after { border-left-color: #13151B   !important; }

</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb wizard">
                <li class="completed"><a href="{{ url('') }}">Baeecay</a></li>
                <li class="completed"><a href="{{ url('goondate') }}">Go On Date</a></li>
                <li class="completed"><a href="{{ url('searchcountry') }}/{{ $data->countries }}">{{ DB::table('countries')->where('id' , $data->countries)->get()->first()->name }}</a></li>
                <li class=""><a href="javascript:void(0);">Lahore</a></li>
            </ul>
        </div>
        
    </div>
    <div class="product-page">
        <div class="row mt-3">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="widget widget-user-about">
                        <div class="widget-heading">
                            <h3 class="widget-title"> {{ $data->name }}</h3>
                        </div>
                        <img src="{{ url('')  }}/public/images/{{ $data->image  }}" alt="Blog">
                    </div>                
                </div>
                <div class="col-md-6">
                    <div class="widget widget-user-about">
                        <div class="widget-heading">
                            <h3 class="widget-title">Details About {{ $data->name }}</h3>
                        </div>
                        <div class="user-info">
                            @if($data->details)
                                {!! $data->details !!}
                            @else
                                {{ $data->name }} is the City of {{ DB::table('countries')->where('id' , $data->countries)->get()->first()->name }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 20px;margin-bottom: 20px;">
                <h3>These Peoples are intrested for date in {{ $data->name }}</h3>
            </div>
            <div id="user-view" class="user-grid-view">
                <div class="row gutters-20">
                	@foreach($users as $r)
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
                    {!! $users->links('frontend.pagination') !!}
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection