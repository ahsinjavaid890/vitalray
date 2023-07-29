@extends('admin.layouts.app')
@section('meta-tags')
<title>Edit Country</title>
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
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/countries')}}">All Countries</a></li>
                            <li class="breadcrumb-item active">Countries</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Country : {{ $data->name }}</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <!-- end page title -->
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/countries/updatecountry') }}">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $data->id }}" name="id">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="lable-control">Country Name</label>
                                    <input type="text" value="{{ $data->name }}" class="form-control" name="name">
                                </div>

                                <div class="form-group">
                                    <label class="lable-control">Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="form-group">
                                    <label class="lable-control">Status</label>
                                    <select class="form-control" required name="status">
                                        <option value="">Select Status</option>
                                        <option @if($data->published_status == 'published') selected @endif value="published">Published</option>
                                        <option @if($data->published_status == 'notpublished') selected @endif value="notpublished">Not Published</option>
                                    </select>
                                </div>
                                <div  class="form-group">
                                    <div style="border: 1px solid black;width: 300px;">
                                        <img style="width: 100%;height: 100%;" src="{{ asset('public/images') }}/{{ $data->image }}">
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            </form>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        
    </div> <!-- End Content -->

</div> <!-- content-page -->
@endsection