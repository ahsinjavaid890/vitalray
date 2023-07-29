@extends('frontend.layouts.front-app')
@section('meta-tags')
<title>Timeline | {{ $data->name }}</title>
@endsection

@section('content')
@include('admin.alerts')
<div class="container">
    <!-- Banner Area Start -->
    @include('frontend.user.profileheader')
    <div class="block-box user-top-header">
        @if($data->id == Auth::user()->id)
        <ul class="menu-list">
            <li class="active"><a href="{{ url('profile') }}">Timeline</a></li>
            <li><a href="{{ url('profile/details/about') }}">About</a></li>
            <li><a href="{{ url('profile/details/gallery') }}">Photos</a></li>
            <li><a href="{{ url('profile/details/loveplaces') }}">Love Places</a></li>
            <li><a href="{{ url('profile/settings/general') }}">Settings</a></li>
        </ul>
        @else
        <ul class="menu-list">
            <li class="active"><a href="{{ url('profile') }}/{{ $data->username }}">Timeline</a></li>
            <li><a href="{{ url('profile/details/gallery') }}/{{ $data->username }}">Photos</a></li>
            <li><a href="{{ url('profile/details/about') }}/{{ $data->username }}">About </a></li>
        </ul>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-8 widget-block widget-break-lg">

            <div class="widget widget-user-about">
                <div class="widget-heading">
                    <h3 class="widget-title">About Me</h3>
                </div>
                <div class="user-info">
                    <p>{{ $data->about }}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="info-list">
                                <li><span>Joined:</span>{{ Cmf::date_format($data->created_at) }}</li>
                                <li><span>E-mail:</span>{{ $data->email }}</li>
                                @if($data->phonenumber)
                                <li><span>Phone:</span>{{ $data->phonenumber }}</li>
                                @endif
                                <li><span>Age:</span>{{ $data->age }} Years</li>
                                <li><span>Height:</span>{{ $data->height }} Feet</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="info-list">
                                @php
                                    $fields = DB::table('signupfields')->where('published_status' , 'published')->where('delete_Status' , 'active')->orderby('order' , 'asc')->get();
                                @endphp
                                @foreach($fields as $r)
                                @if(DB::Table('userfields')->where('signup_parent' , $r->id)->where('user_id' , $data->id)->count() > 0)
                                <li><span>{{ $r->name }}:</span> {{ DB::Table('userfields')->where('signup_parent' , $r->id)->where('user_id' , $data->id)->get()->first()->value }}</li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="widget widget-user-about">
                <div class="widget-heading">
                    <h3 class="widget-title">People Reviews</h3>
                </div>
                <div class="user-info">
                    <div class="single-product-info">
                        
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="reviews" role="tabpanel">
                                <div class="product-review">
                                    @foreach(DB::table('peoplereviews')->where('user_id' , $data->id)->orderby('id' , 'desc')->get() as $r)

                                    @php

                                        $user = DB::table('users')->where('id' , $r->from_id)->get()->first();

                                    @endphp

                                    <div class="media">
                                        <div class="item-img">
                                            @if($user->profileimage)
                                            <img style="width: 60px;height: 60px;" src="{{ asset('public/images')  }}/{{ $user->profileimage }}" alt="{{ $data->name }}">
                                            @else
                                            <img src="{{ asset('public/front/media/profileavatar.png') }}">
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <div class="item-date">{{ Cmf::date_format($r->created_at) }}</div>
                                            <div class="author-name">
                                                <h5 class="item-title">{{ $user->name }}</h5>
                                                <div class="item-rating">
                                                    @if($r->rattings == 1)
                                                    <i class="icofont-star"></i>
                                                    @elseif($r->rattings == 2)
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    @elseif($r->rattings == 3)
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    @elseif($r->rattings == 4)
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    @elseif($r->rattings == 5)
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <p>{{ $r->review }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @if(Auth::user()->id != $data->id)
                                <div class="review-form">
                                    <h3 class="heading-title">Write a Review</h3>
                                    <form method="POST" action="{{ url('profile/submitreview') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $data->id }}" name="user_id">
                                        <div class="row gutters-15">
                                            <div class="col-lg-12 form-group">
                                                <div class="item-rating">
                                                    <i onclick="starpick(1)" id="star1" class="icofont-star"></i>
                                                    <i onclick="starpick(2)" id="star2" class="icofont-star"></i>
                                                    <i onclick="starpick(3)" id="star3" class="icofont-star"></i>
                                                    <i onclick="starpick(4)" id="star4" class="icofont-star"></i>
                                                    <i onclick="starpick(5)" id="star5" class="icofont-star"></i>
                                                </div>
                                            </div>
                                            <input type="hidden" name="star" id="rattings">
                                            <div class="col-12 form-group">
                                                <textarea required class="form-control textarea" placeholder="Comment Here *" name="message" id="message" cols="30" rows="6"></textarea>
                                            </div>
                                            <div class="col-12 form-group">
                                                <button class="submit-btn">SUBMIT</button>
                                            </div>
                                        </div>
                                        <div class="form-response"></div>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 widget-block widget-break-lg">
            <div class="widget widget-gallery">
                <div class="widget-heading">
                    <h3 class="widget-title">Photo Gallery</h3>
                    @if(DB::table('mediaimages')->where('user_id' , $data->id)->count() > 4)
                    <div class="dropdown">
                        <a href="{{ url('profile/details/gallery') }}">View All</a>
                    </div>
                    @endif
                </div>
                <ul class="photo-list gutters-20 zoom-gallery">
                    @foreach(DB::table('mediaimages')->where('user_id' , $data->id)->limit(6)->get() as $r)
                    <li>
                        <div class="user-group-photo">
                            <a href="{{ asset('public/images') }}/{{ $r->images }}" class="popup-zoom">
                                <img class="img-thumbnail" src="{{ asset('public/images') }}/{{ $r->images }}" alt="{{ $data->name }}">
                            </a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="widget widget-comment">
                <div class="widget-heading">
                    <h3 class="widget-title">Places I Want to go</h3>
                </div>
                <div class="group-list">
                    @foreach($placesselected as $r)
                    @if(App\Models\userplaces::where('send_id' , Auth::user()->id)->where('place_id' , $r->places)->where('reciever_id' , $data->id)->where('status' , 'approved')->count() > 0)

                    @else
                    <div class="media">
                        <div class="item-img">
                            <a href="{{ url('place') }}/{{ $r->places }}">
                                <img src="{{ asset('public/images') }}/{{ $r->image }}" alt="post">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="post-date">{{ Cmf::date_format($r->created_at) }} @if(Auth::user()->id == $data->id) <a style="color: #f08089; margin-left: 20px;" href="{{ url('profile/removeplace') }}/{{ $r->id }}"><i class="icofont-trash"></i></a> @endif</div>
                            <h4 class="item-title"><a href="{{ url('place') }}/{{ $r->places }}">{{ $r->name }}</a></h4>
                        </div>
                        @php
                            $user1 = App\Models\User::find(Auth::user()->id);
                            $user2 = App\Models\User::find($data->id);
                            $checkfriend = $user1->isFriendWith($user2);
                        @endphp
                        @if(Auth::user()->id != $data->id)
                        @if($checkfriend)
                        <div style="text-align: right;  " class="media-body">
                            <a href="{{ url('profile/sentplaceinvite') }}/{{ $r->places }}/{{ $data->id }}" class="btn btn-primary">Invite</a>
                        </div>
                        @else
                        <div style="text-align: right;color: #f08089;" class="media-body">
                            <i data-toggle="tooltip" title="To go on a date with {{ $data->name }}, send him a friend request."></i>
                        </div>
                        @endif
                        @endif
                    </div>
                    @endif
                    @endforeach
                </div>
                @if(Auth::user()->id == $data->id)
                <span>@if($placesselected->count() == 0) No Places @endif<a data-toggle="modal" data-target="#addnewplace" style="color:#f08089;" href="javascript:void(0)">@if($placesselected->count() == 0) Click to Add Place @else Add More Place @endif</a></span>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addnewplace">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Place</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <form id="saveplaces" method="POST" action="{{ url('profile/saveplaces') }}">
        {{ csrf_field() }}
      <div class="modal-body">
            <div class="form-group">
                <label>Select Country</label>
                <select style="padding: 10px;height: 55px;background-color: black;" class="form-control" onchange="selectcountry(this.value)">
                    <option value="all">All Countries</option>
                    @foreach(DB::table('countries')->where('published_status' , 'published')->where('delete_status' , 'active')->get() as $r)
                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                    @endforeach
                </select>
            </div>
            <p>Click Place for Select</p>
            <div class="row button-boxes">
                @foreach(DB::table('places')->get() as $r)
                <div onclick="selectplace({{$r->id}})" class="mb-3 col-md-3 allbuttons place{{ $r->countries }}">
                <div  data-toggle="tooltip" title="{{$r->name}}" class="form-control btn btn-primary place placeid{{$r->id}} @if($placesselected->where('places' , $r->id)->count() > 0) placeactive @endif">
                    {{ Str::limit($r->name, 15) }}
                </div>
                <input @if($placesselected->where('places' , $r->id)->count() > 0) checked @endif style="display: none;" id="checkbox{{ $r->id }}" type="checkbox" value="{{ $r->id }}" name="selectedplaces[]">
                </div>
                @endforeach
            </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <span onclick="addplacebutton()" class="btn btn-primary">Save Place</span>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
function selectcountry(id)
{
    $('.allbuttons').hide();
    $('.place'+id).show();
    if(id == 'all')
    {
        $('.allbuttons').show();
    }
}
function addplacebutton()
{
    var numberOfChecked = $('input:checkbox:checked').length;
    if(numberOfChecked > 0)
    {
        $('#saveplaces').submit();
    }else{
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Please Select Any Place',
            showConfirmButton: true,
            timer: 3500
          })
    }
}
function selectplace(id)
{
    $('.placeid'+id).toggleClass('placeactive');
    if ($('#checkbox'+id).is(':checked')) {
        $('#checkbox'+id).prop("checked" , false)
    }else{
        $('#checkbox'+id).prop("checked" , true)
    }
}
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
@endsection