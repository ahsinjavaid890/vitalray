@extends('admin.layouts.app')


@section('meta-tags')
<title>Payement Settings</title>
@endsection


@section('admin-content')
@include('admin.alerts')
<div class="container-fluid">
                        
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">General Settings</li>
                </ol>
            </div>
            <h4 class="page-title">Payment Settigns</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 
<div class="row">
    <div class="col-12">
        <h5>Payment Methods</h5>
    </div>
</div><hr>
<div class="row">
    <div class="col-md-4 col-12">
        
        <div class="card">
        	<div class="card-header">
        		Paypal
        	</div>
        	<div class="card-body">
        		<form method="POST" action="{{ url('admin/') }}">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="paypal">
                            <option value="">Select Status</option>
                            <option value="1" @if($settings->paypal == 1) selected @endif>Active</option>
                            <option value="0" @if($settings->paypal == 0) selected @endif>De Active</option>
                        </select>
                    </div>
            		<div class="form-group">
            			<label>Published Key</label>
            			<input type="text" value="" name="published_stripe" class="form-control">
            		</div>
            		<div class="form-group">
            			<label>Secret Key</label>
            			<input type="text" value="" name="published_stripe" class="form-control">
            		</div>
            		<div class="form-group">
            			<button class="btn btn-block btn-primary">Save</button>
            		</div>
        		</form>
        	</div>
        </div>
    </div> <!-- end col-->
    <div class="col-md-4 col-12">
        <div class="card">
        	<div class="card-header">
        		Stripe
        	</div>
        	<div class="card-body">
        		<form action="{{ route('admin_settings_appearance_update') }}" enctype='multipart/form-data' method="POST">
                       @csrf
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="stripe">
                        <option value="">Select Status</option>
                        <option value="1" @if($settings->stripe == 1) selected @endif>Active</option>
                        <option value="0" @if($settings->stripe == 0) selected @endif>De Active</option>
                    </select>
                </div>
        		<div class="form-group">
        			<label>Published Key</label>
        			<input type="text" value="{{ $settings->published_stripe }}" name="published_stripe" class="form-control">
        		</div>
        		<div class="form-group">
        			<label>Secret Key</label>
        			<input type="text" value="{{ $settings->secret_stripe }}" name="secret_stripe" class="form-control">
        		</div>
        		<div class="form-group">
        			<button class="btn btn-block btn-primary">Save</button>
        		</div>
        		</form>
        	</div>
        </div>
    </div> <!-- end col-->
    <div class="col-md-4 col-12">
        <div class="card">
            <div class="card-header">
                Jazcash
            </div>
            <div class="card-body">
                <form action="{{ route('admin_settings_appearance_update') }}" enctype='multipart/form-data' method="POST">
                       @csrf
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="paypal">
                        <option value="">Select Status</option>
                        <option value="1" @if($settings->stripe == 1) selected @endif>Active</option>
                        <option value="0" @if($settings->stripe == 0) selected @endif>De Active</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Published Key</label>
                    <input type="text" value="" name="published_stripe" class="form-control">
                </div>
                <div class="form-group">
                    <label>Secret Key</label>
                    <input type="text" value="" name="published_stripe" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-block btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div> <!-- end col-->
</div>     

</div> <!-- container -->

@endsection