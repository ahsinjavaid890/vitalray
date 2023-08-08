@extends('auth.authlayout')
@section('title')
<title>Sign In</title>
@endsection
@section('content')
<style type="text/css">
    body{
        height: 100vh !important;
    background-color: hsl(218, 41%, 15%);
    background-image: radial-gradient(650px circle at 0% 0%, hsl(218, 41%, 35%) 15%, hsl(218, 41%, 30%) 35%, hsl(218, 41%, 20%) 75%, hsl(218, 41%, 19%) 80%, transparent 100%), radial-gradient(1250px circle at 100% 100%, hsl(218, 41%, 45%) 15%, hsl(218, 41%, 30%) 35%, hsl(218, 41%, 20%) 75%, hsl(218, 41%, 19%) 80%, transparent 100%);

    }
    .card-header{
        border-bottom: 1px solid #ddd;
    }
</style>
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card" style="margin-top: 100px;">

                <!-- Logo -->
                <div class="card-header pt-4 pb-4 text-center">
                    <a href="{{ url('') }}">
                        <img class="mb-2" src="{{ asset('public/front/media/logo.png') }}" style="width: 105px;" alt="logo">
                    </a>
                </div>

                <div class="card-body p-4">
                    
                    <div class="text-center w-75 m-auto">
                        <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Admin Login</h4>
                        <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
                    </div>
                    @if(session()->has('error'))
                        <div style="text-align: center;color: red;" id="result">{{ session()->get('error') }}</div>
                    @endif
                    <div class="text-center">
                        <div id="loader" class=""></div>
                    </div>
                    <form action="{{ route('adminlogin') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="emailaddress">Email address</label>
                        <!-- <input value="@if(session()->has('email')){{ session()->get('email') }}  @endif" class="form-control" type="email" name="email" required="" placeholder="Enter your email"> -->
                        <input type="email"  name="email" class="form-control">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <!-- <a href="{{url('forgot-password')}}" class="text-muted float-right"><small>Forgot your password?</small></a> -->
                        <label for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input  type="password" name="password" class="form-control" placeholder="Enter your password">
                            
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <a href="{{ url('forgot-password') }}">Forgot Password</a>
                    <br> <br>
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-block" href="index.php" type="submit"> Log In </button>
                    </div>
                </form>
                </div> <!-- end card-body -->
            </div>
            <!-- end card -->


        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>
@endsection