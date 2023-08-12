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
<div class="container mt-3">
    @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong> {{ Session::get('success') }}</strong>
        {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"> --}}
        </button>
    </div>
    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ Session::get('error') }} </strong>
        {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"> --}}
        </button>
    </div>
    @endif
</div>
<section class="mt-3">
    <div style="background: #386bc0;border-radius:10px;" class="container text-white p-4">
        <h3>Your Order has been placed Succesfully</h3>
    </div>
</section>
@endsection