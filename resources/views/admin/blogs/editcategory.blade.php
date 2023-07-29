@extends('admin.layouts.app')

 
@section('meta-tags')
<title>Blog Category</title>
@endsection


@section('admin-content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{url('admin/blog-categories')}}">Blog Categories</a></li>
                        <li class="breadcrumb-item active">Edit Blog Category</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Blog Category</h4>
            </div>
        </div>
    </div>
    @include('admin.alerts')
<form enctype="multipart/form-data" method="POST" action="{{ url('updateblogcategory') }}" class="needs-validation" novalidate>
        {{ csrf_field() }}
        <input type="hidden" value="{{ $data->id }}" name="id">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Blog Category Details
                </div>
                <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="validationCustom01">Blog Category Name</label>
                            <input onkeyup="createslug(this.value)" type="text" class="form-control" value="{{ $data->name }}" name="name" id="validationCustom01"
                                placeholder="Title" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="validationCustom02">Slug</label>
                            <input type="text" id="slug" value="{{ $data->slug }}" class="form-control" name="slug" onkeyup="checkslug()" 
                                 required >
                                 <small id="slugerror" class="mt-1 text-danger"></small>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="validationCustom03">Main Image</label>
                            <input  style="height: 44px;" type="file" class="form-control" name="image" id="validationCustom09"
                                 >
                            <div class="invalid-feedback">
                                Please attach image file.
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <img style="width:120px;" class="img-thumbanil" src="{{ url('public/images') }}/{{ $data->image }}">
                        </div>
                        <div class="form-group mb-2">
                        <input type="radio" @if($data->visible_status == 'Published') checked @endif value="Published" name="visible_status" id="active">
                        <label for="active">Published</label>
                        </div>
                        <div class="form-group mb-2">
                            <input @if($data->visible_status == 'Not Published') checked @endif type="radio" value="Not Published" name="visible_status" id="delete">
                            <label for="delete">Not Published</label>
                        </div>
                         <div class="row">
                <div class="col-md-12 text-right">
                    <button id="submitbutton" type="submit" class="btn btn-primary form-control">Save</button>
                </div>
            </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
         <!-- end col-->
        
    </div>
</form>
</div> <!-- container -->
@endsection