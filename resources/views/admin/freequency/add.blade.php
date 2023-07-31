@extends('admin.layouts.app')
@section('meta-tags')
<title>Add New Freequency</title>
@endsection
@section('admin-content')

@include('admin.alerts')
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

<div class="content-page">
    <div class="content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/freequency/all')}}">All Freequency</a></li>
                            <li class="breadcrumb-item active">Add New Freequency</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add New Freequency</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/freequency/createfreequency') }}">
                                {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Freequency Tittle</label>
                                    <input type="text" required name="name" placeholder="Freequency Tittle" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="lable-control">Freequency File Upload</label>
                                    <input type="file" required class="form-control" name="freequency">
                                </div>
                                <div class="form-group">
                                    <label class="lable-control">Image</label>
                                    <input type="file" required class="form-control" name="image">
                                </div>
                                <div class="form-group">
                                    <label>Used vibration</label>
                                    <input type="text" name="vibration" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Used Emitter</label>
                                    <input type="text" name="emitter" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="lable-control">Description</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="lable-control">Show On Homepage</label>
                                    <select class="form-control" name="show_on_homepage">
                                        <option value="">Select</option>
                                        <option value="yes">Yes</option>
                                        <option selected value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add Freequency</button>
                            </div>
                            </form>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        
    </div> <!-- End Content -->

</div> <!-- content-page -->
@endsection