@extends('auth.authlayout')
@section('title')
<title>Sign Up | Step 2</title>
@endsection
@section('content')
<style type="text/css">
    input{
        height: 60px !important;
    }
</style>
<!-- <div id="preloader"></div> -->
    <div id="wrapper" class="wrapper overflow-hidden">
        <div class="login-page-wrap">
    <div class="content-wrap">
        <div style="width:600px;" class="login-content">
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
                        <p>Tell More About yourself</p>
                        <h5>Step 2 Out of 6 Steps</h5>
                        <form id="regForm" method="POST" action="{{ route('user.registertwo') }}">
                         @csrf
                                @if(session()->get('user_id_temp'))

                                @php
                                    $user_id = session()->get('user_id_temp');
                                @endphp

                                @if(session()->get('seconddone'))
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
                                                    <input id="checkbox{{ $c->id }}" type="checkbox" name="{{ $r->id }}" @if($r->isrequired == 'yes') required @endif>
                                                    <label for="checkbox{{ $c->id }}" style="padding-left: 10px;margin-top: 17px;"> {{ $c->name }} </label>
                                                </div>
                                                @endforeach
                                            </div>
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
                                            <label>{{ $r->name }}</label>
                                            <select name="{{ $r->id }}" @if($r->isrequired == 'yes') required @endif style="height:62px;background-color: #242424;" class="form-control">
                                                <option value="">Choose option</option>
                                                @foreach(DB::table('signupfieldschilds')->where('signup_parent' , $r->id)->get() as $c)
                                                <option

                                                    @if(DB::table('userfields')->where('signup_parent' , $r->id)->where('user_id' , $user_id)->get()->first()->value == $c->name) selected @endif


                                                 value="{{ $c->name }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    </div>
                                    @else

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
                                        @foreach(DB::table('signupfieldschilds')->where('signup_parent',$r->id)->get() as $c)
                                        <div style="display: flex;" class="col-md-6">
                                            <input value="{{ $c->name }}" id="checkbox{{ $c->id }}" type="checkbox" name="{{ $r->id }}">
                                            <label for="checkbox{{ $c->id }}" style="padding-left: 10px;margin-top: 17px;"> {{ $c->name }} </label>
                                        </div>
                                        @endforeach
                                    </div>
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
                                <input type="text" name="{{ $r->id }}" class="form-control"  @if($r->isrequired == 'yes') required @endif>
                            </div>
                            </div>
                            @endif
                            @if($r->type == 'select')
                            <div style="margin-bottom: 15px;"  class="col-md-6">
                                <div class="form-group">
                                    <label>{{ $r->name }}</label>
                                    <select name="{{ $r->id }}" @if($r->isrequired == 'yes') required @endif style="height:62px;background-color: #242424;" class="form-control">
                                        <option value="">Choose option</option>
                                        @foreach(DB::table('signupfieldschilds')->where('signup_parent' , $r->id)->get() as $c)
                                        <option value="{{ $c->name }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            </div>

                            @endif                            
                            @endif
                            <div class="form-group">
                                <label>Tell about yourself</label>
                                <textarea required name="about" class="form-control">@if(Cmf::get_uservalue('about')) {{ Cmf::get_uservalue('about') }} @endif</textarea>
                            </div>
                            

                            <div class="row">
                                <div class="col-lg-6 text-left">
                                    <a  href="{{ route('user.signup') }}" class="btn btn-primary">Back</a>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <button type="submit" class="btn btn-primary">Next</button>
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

@endsection