@extends('frontend.layouts.front-app-home')
@section('meta-tags')
<title>Vital Ray</title>
@endsection
@section('content')
<div class="container">
    @if(Auth::check())
    <a class="btn btn-primary"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    @else
    <a class="btn btn-primary" href="{{ url('signin') }}">Sign In</a>
    <a class="btn btn-primary" href="{{ url('signup') }}">Sign Up</a>
    @endif
    @foreach(DB::table('dynamicpages')->where('visible_status' , 'Published')->get() as $r)
    <a class="btn btn-primary" href="{{ url('page') }}/{{ $r->slug }}">{{ $r->name }}</a>
    @endforeach
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div >
                <img width="200px" src="{{url('public/images')}}/{{$product->image}}" alt="">
            </div>
            <div>
                <h2> {{$product->name}}</h2>
               
            </div>
            <div>
                <p>Price:  {{$product->price}}</p>
              
            </div>
            <div>
                {{$product->short_description}}
            </div>
            <div>
                {{$product->description}}
            </div>

        </div>
    </div>
</div>
@endsection