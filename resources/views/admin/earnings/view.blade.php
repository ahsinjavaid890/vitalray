@extends('admin.layouts.app')


@section('meta-tags')
<title>Total Earnings</title>
@endsection


@section('admin-content')
<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">View Payement</li>
                    </ol>
                </div>
                <h4 class="page-title">View Payement</h4>
            </div>
        </div>
    </div>     
    @php

        $user = DB::table('users')->where('id' , $data->customer_id)->get()->first();

    @endphp
    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card text-center">
                <div class="card-body">
                    <img src="{{asset('public/images')}}/{{ $user->profileimage }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                    <h4 class="mb-0 mt-2">{{$user->name}}</h4>
                                        <div class="text-left mt-3">
                        <h4 class="font-13 text-uppercase">About {{$user->name}} :</h4>
                        <p class="text-muted font-13 mb-3">
                            {{$user->about}}
                        </p>
                        <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">{{$user->name}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">{{$user->phonenumber}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{$user->email}}</span></p>

                        <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2"></span></p>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col-->

        <!-- <div class="col-xl-4 col-lg-5">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ url('admin/earnings/refund') }}">
                         {{ csrf_field() }}
                         <input type="hidden" name="charge_id" value="{{ $data->id }}">
                         <div class="form-group">
                             <label>Refund Ammount</label>
                             <input required type="text" name="ammount" class="form-control">
                         </div>
                         <div class="form-group">
                             <label>Refund Notes</label>
                             <textarea required class="form-control" name="refund_note"></textarea>
                         </div>
                         <div class="form-group">
                              <button class="btn btn-primary">Submit</button>
                         </div>
                    </form>
                </div>
            </div>
        </div> -->
    </div>

    <!-- end row -->        
    
</div> <!-- container -->

@endsection