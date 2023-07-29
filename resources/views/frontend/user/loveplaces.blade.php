@extends('frontend.layouts.front-app')
@section('meta-tags')
<title>Love Places | {{ $data->name }}</title>
@endsection

@section('content')
@include('admin.alerts')
<div class="container">
    <!-- Banner Area Start -->
    @include('frontend.user.profileheader')
    <div class="block-box user-top-header">
        @if($data->id == Auth::user()->id)
        <ul class="menu-list">
            <li ><a href="{{ url('profile') }}">Timeline</a></li>
            <li ><a href="{{ url('profile/details/about') }}">About</a></li>
            <li  ><a href="{{ url('profile/details/gallery') }}">Photos</a></li>
            <li class="active"><a href="{{ url('profile/details/loveplaces') }}">Love Places</a></li>

            <li><a href="{{ url('profile/settings/general') }}">Settings</a></li>
        </ul>
        @else
        <ul class="menu-list">
            <li><a href="{{ url('profile') }}/{{ $data->username }}">Timeline</a></li>
            <li  class="active"><a href="{{ url('profile/details/gallery') }}/{{ $data->username }}">Photos</a></li>
            <li><a href="{{ url('profile/details/loveplaces') }}/{{ $data->username }}">Love Places</a></li>
            <li><a href="{{ url('profile/details/about') }}/{{ $data->username }}">About </a></li>
        </ul>
        @endif
    </div>
    <div class="row gutters-20 zoom-gallery">
        <div class="col-md-12">
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
                            <a href="javascript:void(0)">
                                <img src="{{ asset('public/images') }}/{{ $r->image }}" alt="post">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="post-date">{{ Cmf::date_format($r->created_at) }} @if(Auth::user()->id == $data->id) <a style="color: #f08089; margin-left: 20px;" href="{{ url('profile/removeplace') }}/{{ $r->id }}"><i class="icofont-trash"></i></a> @endif</div>
                            <h4 class="item-title"><a href="javascript:void(0)">{{ $r->name }}</a></h4>
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
                            <i data-toggle="tooltip" title="To go on a date with {{ $data->name }}, send him a friend request." class="icofont-info"></i>
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
      <form method="POST" action="{{ url('profile/saveplaces') }}">
        {{ csrf_field() }}
      <div class="modal-body">
            <p>Click Place for Select</p>
            <div class="row">
                @foreach(DB::table('places')->where('countries' , Auth::user()->country)->get() as $r)
                <div onclick="selectplace({{$r->id}})" class="col-md-4">
                <div  class="place placeid{{$r->id}} @if($placesselected->where('places' , $r->id)->count() > 0) placeactive @endif">
                    <div class="placeimage">
                        <img src="{{ asset('public/images') }}/{{ $r->image }}">
                    </div>
                    <div class="placename">
                        {{ $r->name }}
                    </div>
                </div>
                <input @if($placesselected->where('places' , $r->id)->count() > 0) checked @endif style="display: none;" id="checkbox{{ $r->id }}" type="checkbox" value="{{ $r->id }}" name="selectedplaces[]">
                </div>
                @endforeach
            </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save Place</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
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