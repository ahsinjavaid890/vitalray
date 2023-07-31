@extends('admin.layouts.app')
@section('meta-tags')
<title>Edit Place</title>
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
                            <li class="breadcrumb-item"><a href="{{url('admin/places')}}">All Places</a></li>
                            <li class="breadcrumb-item active">Edit Place</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Place</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/places/updatecountry') }}">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $data->id }}" name="id">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Select Country</label>
                                    <select class="form-control" name="country">
                                        <option>Select Country</option>
                                        @foreach($countries as $r)
                                        <option @if($r->id == $data->countries) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="lable-control">Place Name</label>
                                    <input type="text" value="{{ $data->name }}" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label class="lable-control">Details</label>
                                    <textarea id="editor1" class="form-control" name="details">{{ $data->details }}</textarea>
                                </div>
                                 <script>
                                        CKEDITOR.replace( 'editor1' );
                                </script>
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
                                <div class="form-group">
                                    <label class="lable-control">Show On Homepage</label>
                                    <select class="form-control" name="show_on_homepage">
                                        <option value="">Select</option>
                                        <option @if($data->show_on_homepage == 'yes') selected @endif value="yes">Yes</option>
                                        <option @if($data->show_on_homepage == 'no') selected @endif value="notpublished">No</option>
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