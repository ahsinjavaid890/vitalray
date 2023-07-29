@extends('frontend.layouts.front-app')

@section('meta-tags')
<title>General Settings | {{ $data->name }}</title>
@endsection
@section('content')
@include('admin.alerts')
<style type="text/css">
    select {
        height: 60px !important;
        background-color: #242424 !important;
    }
</style>
<!--=====================================-->
<!--=        Newsfeed  Area Start       =-->
<!--=====================================-->
<div class="container">
    @include('frontend.user.profileheader')
    <div class="block-box user-top-header">
        @if($data->id == Auth::user()->id)
        <ul class="menu-list">
            <li ><a href="{{ url('profile') }}">Timeline</a></li>
            <li><a href="{{ url('profile/details/about') }}">About</a></li>
            <li><a href="{{ url('profile/details/gallery') }}">Photos</a></li>
            <li><a href="{{ url('profile/details/loveplaces') }}">Love Places</a></li>
            <li class="active"><a href="{{ url('profile/settings/general') }}">Settings</a></li>
            <li><a href="{{ url('profile/settings/general') }}"></a></li>
        </ul>
        @else
        <ul class="menu-list">
            <li class="active"><a href="{{ url('profile') }}/{{ $data->username }}">Timeline</a></li>
            <li><a href="{{ url('profile/details/gallery') }}/{{ $data->username }}">Photos</a></li>
            <li><a href="{{ url('profile/details/loveplaces') }}/{{ $data->username }}">Love Places</a></li>
            <li><a href="{{ url('profile/details/about') }}/{{ $data->username }}">About </a></li>
        </ul>
        @endif
    </div>

    <div style="margin-bottom: 50px;" class="row">         
                    
        <div class="col-md-6">
            
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">Edit Profile</h4>
                    <p class="mt-0">Change your profile information</p>
                    <form method="POST" action="{{ url('profile/updategeneraldetails') }}">
                        {{ csrf_field() }}
                    <div class="mt-3">
                        <div class="form-group">
                            <label class="lable-control">Full Name</label>
                            <input type="text" value="{{ $data->name }}" name="name" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label class="lable-control">Email</label>
                            <input readonly type="text" value="{{ $data->email }}" name="email" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label class="lable-control">Phone number</label>
                            <input readonly type="text" value="{{ $data->phonenumber }}" name="phonenumber" class="form-control" value="">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="lable-control">Age</label>
                                    <input value="{{ $data->age }}" type="text" name="age" class="form-control" value="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="lable-control">Height</label>
                                    <input value="{{ $data->height }}" type="text" name="height" class="form-control" value="">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="lable-control">Address</label>
                            <input value="{{ $data->address }}" type="text" name="address" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label class="lable-control">Choose Your Gender</label>
                            <select name="gender" class="form-control">
                                <option @if($data->gender == 'Male') selected @endif value="Male">Male</option>
                                <option @if($data->gender == 'Female') selected @endif value="Female">Female</option>
                                <option @if($data->gender == 'Prefer not to answer') selected @endif value="Prefer not to answer">Prefer not to answer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Update Information</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">More Information</h4>
                    <p class="mt-0">change the below information</p>
                    <form id="regForm" method="POST" action="{{ url('profile/updatemoreinformation') }}">
                     @csrf
                     @php
                        $user_id = Auth::user()->id;
                     @endphp
                         <div class="row">
                            @foreach(DB::table('signupfields')->where('published_status'  , 'published')->where('delete_status', 'active')->orderby('order' , 'Asc')->get() as $r)
                            @if($r->type == 'radio')
                            <style type="text/css">
                                .form-group input {
                                    height: unset;
                                }
                            </style>
                            <div class="form-group">
                                <label>{{ $r->name }}</label>
                                <div class="row">
                                    @foreach(DB::table('signupfieldschilds')->where('signup_parent' , $r->id)->get() as $c)
                                    <div class="col-md-6">
                                        <input type="radio" name="{{ $r->id }}" @if($r->isrequired == 'yes') required @endif>
                                        <label for="radio{{ $c->id }}" style="padding-left: 10px;"> {{ $c->name }} </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if($r->type == 'textarea')
                            <div class="form-group">
                                <label>{{ $r->name }}</label>
                                <textarea name="{{ $r->id }}" @if($r->isrequired == 'yes') required @endif  class="form-control"></textarea>
                            </div>
                            @endif
                            @if($r->type == 'text')
                            <div style="margin-bottom: 5px;" class="col-md-12">
                            <div class="form-group">
                                <label>{{ $r->name }}</label>
                                <input value="@if(DB::table('userfields')->where('signup_parent' , $r->id)->where('user_id' , $user_id)->get()->first()->value){{ DB::table('userfields')->where('signup_parent' , $r->id)->where('user_id' , $user_id)->get()->first()->value }}@endif" type="text" name="{{ $r->id }}" class="form-control"  @if($r->isrequired == 'yes') required @endif>
                            </div>
                            </div>
                            @endif
                            @if($r->type == 'select')
                            <div style="margin-bottom: 15px;"  class="col-md-6">
                                <div class="form-group">
                                    @php
                                     $data = DB::table('signupfieldschilds')->where('signup_parent' , $r->id)->get();
                                     $userfields = DB::table('userfields')->where('user_id',Auth::id())->get();
                                    @endphp
                                                                           
                                    
                                    <label>{{ $r->name }}</label>
                                    <select name="{{ $r->id }}" @if($r->isrequired == 'yes') required @endif style="height:62px;background-color: #242424;" class="form-control">
                                        @foreach($data as $c)
                                        
                                        <option
                                        @foreach($userfields as $f) @if($c->name == $f->value) selected @endif @endforeach
                                         value="{{ $c->name }}">{{ $c->name }}</option>
                                         
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif


                            @if($r->type == 'checkbox')
                            <style type="text/css">
                                .form-group input {
                                    height: unset;
                                }
                            </style>
                            <div style="margin-bottom: 15px;"  class="col-md-12">
                                <div class="form-group">
                                    <label>{{ $r->name }}</label>
                                    <div class="row">
                                        @foreach(DB::table('signupfieldschilds')->where('signup_parent' , $r->id)->get() as $c)
                                        <div style="display: flex;" class="col-md-6">
                                            <input @if(DB::table('userfields')->where('signup_parent' , $r->id)->where('user_id' , $user_id)->get()->first()->value == $c->name) checked @endif value="{{ $c->name }}" id="checkbox{{ $c->id }}" type="checkbox" name="{{ $r->id }}">
                                            <label for="checkbox{{ $c->id }}" style="padding-left: 10px;margin-top: 17px;"> {{ $c->name }} </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>    
                        <div class="form-group">
                            <label>Tell about yourself</label>
                            <textarea required name="about" class="form-control">@if(Auth::user()->about) {{ Auth::user()->about }} @endif</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Update Information</button>
                        </div>
                    </form>                      
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection