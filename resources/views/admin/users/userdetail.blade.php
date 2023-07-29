@extends('admin.layouts.app')


@section('meta-tags')
<title>{{ $data->name }} Detail</title>
@endsection


@section('admin-content')
@include('admin.alerts')


<div class="content-page">
    <div class="content">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">All Users</a></li>
                            <li class="breadcrumb-item active">{{ $data->name }}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Details of {{ $data->name }}</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card text-center">
                    <div class="card-body">
                    <img src="{{asset('public/images')}}/{{ $data->profileimage }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                    <h4 class="mb-0 mt-2">{{$data->name}}</h4>
                    <div class="text-left mt-3">
                        <h4 class="font-13 text-uppercase">About {{$data->name}} :</h4>
                        <p class="text-muted font-13 mb-3">
                            {{$data->about}}
                        </p>
                        <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">{{$data->name}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">{{$data->phonenumber}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{$data->email}}</span></p>

                    </div>
                </div> <!-- end card-body -->
                </div> <!-- end card -->


            </div> <!-- end col-->

            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                            <li class="nav-item">
                                <a href="#aboutme" data-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                                    Additional Information
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#timeline" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0 ">
                                    Places Selected
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                    Settings
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="aboutme">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 >Verification</h4>
                                    </div>
                                    <div class="card-body">
                                        <a target="_blank" href="{{asset('public/images')}}/{{ $data->front_side }}">
                                            <img id="myImg" src="{{asset('public/images')}}/{{ $data->front_side }}" alt="Snow" style="width:100%;max-width:300px">
                                        </a>
                                        <a target="_blank" href="{{asset('public/images')}}/{{ $data->back_side }}">

                                             <img id="myImg" src="{{asset('public/images')}}/{{ $data->back_side }}" alt="Snow" style="width:100%;max-width:300px">
                                         </a>
                                    </div> <!-- end card body -->
                                </div> <!-- end card -->
                                <div class="card">
                                    <div class="card-header">
                                        <h4 >Further Information</h4>
                                    </div>
                                    <div class="card-body">
                                        @php
                                            $fields = DB::table('signupfields')->where('published_status' , 'published')->where('delete_Status' , 'active')->orderby('order' , 'asc')->get();
                                        @endphp

                                        @foreach($fields as $r)
                                        @if(DB::Table('userfields')->where('signup_parent' , $r->id)->where('user_id' , $data->id)->get()->first())
                                        <p class="text-muted mb-2 font-13"><strong>{{ $r->name }} :</strong> <span class="ml-2">   {{ DB::Table('userfields')->where('signup_parent' , $r->id)->where('user_id' , $data->id)->get()->first()->value }}   </span></p>
                                        @endif
                                        @endforeach
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane " id="timeline">

                            </div>
                            <div class="tab-pane" id="settings">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Update Profile Status of {{ $data->name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ url('admin/user/updateprofilestatus') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $data->id }}" name="id">
                                            <div class="form-group">
                                                <label>Select Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="">Select Status</option>
                                                    <option @if($data->active == 1) selected @endif value="1">Active</option>
                                                    <option @if($data->active == 0) selected @endif value="0">In Active</option>
                                                </select>
                                            </div>
      <!--                                       <div class="form-group">
                                                <label>Approved Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="">Select Approved Status</option>
                                                    <option @if($data->approve_status == 'approved') selected @endif value="approved">Approved</option>
                                                    <option @if($data->approve_status == 'notapproved') selected @endif value="notapproved">Un Approved</option>
                                                </select>
                                            </div> -->
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit">Submit</button>
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
</div>
@endsection