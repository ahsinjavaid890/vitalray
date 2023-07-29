@extends('admin.layouts.app')


@section('meta-tags')
<title>Edit Subscription Plan</title>
<input type="hidden" value="{{ url('admin') }}" id="mainurl" name="">
@endsection


@section('admin-content')
@include('admin.alerts')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{url('admin/subscriptions/userplans')}}">All  Subscription Plans</a></li>
                        <li class="breadcrumb-item active">Edit  Subscription Plan</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit  Subscription Plan : {{ $data->name }}</h4>
            </div>
        </div>
    </div>
<form enctype="multipart/form-data" method="POST" action="{{ url('admin/subscriptions/updateplan') }}" class="needs-validation" novalidate>
        {{ csrf_field() }}
        <input type="hidden" value="{{ $data->id }}" name="id">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                   Subscription Plan
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="username">Plan Name</label>
                        <input value="{{ $data->name }}" name="name" class="form-control input-lg" type="text" id="username" required="" placeholder="eg. Basic">
                    </div>
                    <div class="form-group">
                        <label for="username">No Of Images Upload</label>
                        <input value="{{ $data->images_allowed }}" name="images_allowed" class="form-control input-lg" type="number" id="username" required="" placeholder="10">
                    </div>
                    <div class="form-group">
                        <label for="username">Visit of places allowed</label>
                        <input value="{{ $data->places_allowed }}" name="places_allowed" class="form-control input-lg" type="text" id="username" required="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="username">Price (USD)</label>
                        <input value="{{ $data->price }}" name="price" class="form-control input-lg" type="text" id="username" required="" placeholder="eg. 20 days">
                        @if($errors->has('price'))
                            <div style="color: red">{{ $errors->first('price') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="username">Feature 1</label>
                        <input value="{{ $data->feature1 }}" name="feature1" class="form-control input-lg" type="text" id="username">
                    </div>
                    <div class="form-group">
                        <label for="username">Feature 2</label>
                        <input value="{{ $data->feature2 }}" name="feature2" class="form-control input-lg" type="text" id="username" >
                    </div>
                    <div class="form-group">
                        <label for="username">Feature 3</label>
                        <input value="{{ $data->feature3 }}" name="feature3" class="form-control input-lg" type="text" id="username" >
                    </div>
                    <div class="form-group">
                        <label for="username">Feature 4</label>
                        <input value="{{ $data->feature4 }}" name="feature4" class="form-control input-lg" type="text" id="username">
                    </div>
                    <div class="form-group">
                        <label for="username">Feature 5</label>
                        <input value="{{ $data->feature5 }}" name="feature5" class="form-control input-lg" type="text" id="username" >
                    </div>
                    <div class="form-group">
                        <label for="username">Feature 6</label>
                        <input value="{{ $data->feature6 }}" name="feature6" class="form-control input-lg" type="text" id="username" >
                    </div>
                    <div class="form-group">
                        <label for="username">Duration (Days)</label>
                        <input value="{{ $data->duration }}" name="duration" class="form-control input-lg" type="text" id="username" required="duration" placeholder="eg. 20 days">
                    </div> 
                </div> <!-- end card-body-->

            </div> <!-- end card-->
            <div class="row">
                <div class="col-md-12 text-right">
                    <button id="submitbutton" type="submit" class="btn btn-primary form-control">Save</button>
                </div>
            </div>
        </div>
         <!-- end col-->
    </div>
</form>
    <!-- end row -->
</div> <!-- container -->
@endsection