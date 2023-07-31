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
                            <li class="breadcrumb-item"><a href="{{url('admin/places')}}">All Freequency</a></li>
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
                                    <label>Tittle</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="lable-control">Freequency File Upload</label>
                                    <input type="file" class="form-control" name="freequency">
                                </div>
                                <div class="form-group">
                                    <label class="lable-control">Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="form-group">
                                    <label class="lable-control">Show On Homepage</label>
                                    <select class="form-control" name="show_on_homepage">
                                        <option value="">Select</option>
                                        <option value="yes">Yes</option>
                                        <option value="notpublished">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                            </form>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        
    </div> <!-- End Content -->

</div> <!-- content-page -->
@endsection