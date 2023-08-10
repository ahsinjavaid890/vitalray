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

@foreach (['danger', 'success'] as $status)
@if(Session::has($status))
    <p class="alert alert-{{$status}}">{{ Session::get($status) }}</p>
@endif
@endforeach

<section class="mt-3">
    <div style="background: #386bc0;border-radius:10px" class="container  p-4">
        <div class="row">
            <div class="col-6">
                <h3 class="head">Information</h3>
                <div class="row">
                    <div class="col">
                        <label for="">Name</label>
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="col">
                        <label for="">Email</label>
                        <input type="email" class="form-control" placeholder="demo@gmail.com">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Address</label>
                        <input type="text" class="form-control" placeholder="Address">
                    </div>

                </div>
                <hr>
                <div>
                    <form role="form" method="POST" id="paymentForm" action="{{ url('/stripepayment')}}">
                        @csrf
                    <h3 class="head">Payment Information</h3>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" required name="fullName" placeholder="Fullname">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" required maxlength="16" name="cardNumber" placeholder="Card Number">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <select class="form-control" required name="month">
                                <option value="">MM</option>
                                @foreach(range(1, 12) as $month)
                                    <option value="{{$month}}">{{$month}}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" placeholder="MM"> --}}
                        </div>
                        <div class="col">
                            <select class="form-control" required name="year">
                                <option value="">YYYY</option>
                                @foreach(range(date('Y'), date('Y') + 10) as $year)
                                    <option value="{{$year}}">{{$year}}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" placeholder="YYYY"> --}}
                        </div>
                        <div class="col">
                            <input type="text" name="cvv" maxlength="3" class="form-control" placeholder="CVV">
                        </div>
                    </div>
                
                </div>
            </div>
            @php
            $url = request()->segment(count(request()->segments()));
            $product = DB::table('products')->where('url',$url)->first();
            @endphp
            <div class="col-6">
                <div class="row px-3 ">
                    <h3 class="head">Billing</h3>
                    <div class="bill-box ">
                        <ul class=" billing">
                            <li class="heading-with-action ">
                                <p class="">{{ $product->name }}
                                </p>
                            </li>
                            <li class="heading-with-action grand-total cart-total">
                                <strong class="total-bill">Total Price</strong>
                                <strong class="total-price">Rs: {{ $product->price }}</strong>
                            </li>
                        </ul>
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <input type="hidden" name="total" value="{{$product->price}}">
                    </div>
                    <button type="submit" class="mt-4 btn btn-warning text-dark"> Pay With Strip</button>
                    <h4 class="my-4 text-center">OR</h4>
                </div>
            </div>
        </form>

        </div>
    </div>
</section>



@endsection