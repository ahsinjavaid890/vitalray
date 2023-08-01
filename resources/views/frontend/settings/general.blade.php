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
    <div style="margin-bottom: 50px;" class="row">         
                    
        <div class="col-md-6">
            
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-0">Edit Profile</h4>
                    <p class="mt-0">Change your profile information</p>
                    <form enctype="multipart/form-data" method="POST" action="{{ url('profile/updategeneraldetails') }}">
                        {{ csrf_field() }}
                    <div class="mt-3">
                        <div class="form-group">
                            <label class="lable-control">Profile Image</label>
                            <input type="file"  name="profileimage" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label class="lable-control">First Name</label>
                            <input type="text" value="{{ $data->first_name }}" name="first_name" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label class="lable-control">Last Name</label>
                            <input type="text" value="{{ $data->last_name }}" name="last_name" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label class="lable-control">Email</label>
                            <input readonly type="text" value="{{ $data->email }}" name="email" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label class="lable-control">Phone number</label>
                            <input type="text" value="{{ $data->phonenumber }}" name="phonenumber" class="form-control" value="">
                        </div>

                        
                        <div class="form-group">
                            <button class="btn btn-primary">Update Information</button>
                        </div>
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