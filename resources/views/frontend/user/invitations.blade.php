@extends('frontend.layouts.front-app')

@section('meta-tags')
<title>Invitations | {{ Auth::user()->name }}</title>
@endsection

@section('content')
<div class="container">
    <div class="block-box user-about widget-comment">
        <div class="widget-heading">
            <h3 class="widget-title">All Recieved Invitations ({{DB::table('userplaces')->where('status' , 'pending')->where('reciever_id' , Auth::user()->id)->orderby('id' , 'desc')->count()}})</h3>
        </div>
        <div class="group-list">
        @foreach(DB::table('userplaces')->where('status' , 'pending')->where('reciever_id' , Auth::user()->id)->orderby('id' , 'desc')->get() as $r)
        <div class="media">
            <div class="item-img">
                <a href="javascript:void(0)">
                    <img src="{{ asset('public/images') }}/{{ DB::table('places')->where('id' , $r->place_id)->get()->first()->image }}" alt="post">
                </a>
            </div>
            <div class="media-body">
                <div class="post-date">{{ Cmf::date_format($r->created_at) }}</div>
                <h4 class="item-title"><a style="color: #ef8089;" href="{{ url('profile') }}/{{ DB::table('users')->where('id' , $r->send_id)->get()->first()->username }}">{{ DB::table('users')->where('id' , $r->send_id)->get()->first()->name }}</a> Sent you Invitation for Join in {{ DB::table('places')->where('id' , $r->place_id)->get()->first()->name }}</h4>
            </div>
            <div class="media-body text-right">
                <a href="{{ url('profile/acceptplaceinvitation') }}/{{ $r->id }}" class="btn btn-primary">Accetpt</a>
                <a href="{{ url('profile/rejectplaceinvitation') }}/{{ $r->id }}" style="background-image: linear-gradient(to right, #5c383f , #e86470);" class="btn btn-primary">Reject</a>
            </div>
        </div>
        @endforeach



    </div>
    </div>
    <div class="block-box user-about widget-comment">
        <div class="widget-heading">
            <h3 class="widget-title">All Sended Invitations ({{DB::table('userplaces')->where('status' , 'pending')->where('send_id' , Auth::user()->id)->orderby('id' , 'desc')->count()}})</h3>
        </div>
        <div class="group-list">
        @foreach(DB::table('userplaces')->where('send_id' , Auth::user()->id)->orderby('id' , 'desc')->get() as $r)
        <div class="media">
            <div class="item-img">
                <a href="javascript:void(0)">
                    <img src="{{ asset('public/images') }}/{{ DB::table('places')->where('id' , $r->place_id)->get()->first()->image }}" alt="post">
                </a>
            </div>
            <div class="media-body">
                <div class="post-date">{{ Cmf::date_format($r->created_at) }}</div>
                <h4 class="item-title"><a style="color: #ef8089;" href="{{ url('profile') }}/{{ DB::table('users')->where('id' , $r->send_id)->get()->first()->username }}">{{ DB::table('users')->where('id' , $r->send_id)->get()->first()->name }}</a> Sent you Invitation for Join in {{ DB::table('places')->where('id' , $r->place_id)->get()->first()->name }}</h4> <span style="text-transform: capitalize;">({{$r->status}})</span>
            </div>
        </div>
        @endforeach


        
    </div>
    </div>
</div>
@endsection