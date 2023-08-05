@extends('admin.layouts.app')


@section('meta-tags')
<title>Add New Page</title>

@endsection


@section('admin-content')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{url('categories')}}">Page</a></li>
                        <li class="breadcrumb-item active">Add Page</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Page</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    @include('admin.alerts')
    <form enctype="multipart/form-data" method="POST" action="{{ url('createdynamicpage') }}" class="needs-validation" novalidate>
        {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Page Details
                </div>
                <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="validationCustom01">Page Name</label>
                            <input onkeyup="createslug(this.value)" type="text" class="form-control" name="name" id="validationCustom01"
                                placeholder="Title" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="validationCustom02">Slug</label>
                            <input type="text" id="slug" class="form-control" name="slug" onkeyup="checkslug()" 
                                 required >
                                 <small id="slugerror" class="mt-1 text-danger"></small>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="validationCustom01">Detailed Content</label>
                            <textarea required="" id="summernote-basic" name="content" class="form-control" rows="8"></textarea>
                        </div>
                        
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Page Meta Tags
                </div>
                <div class="card-body">
                        <div class="form-group mb-2">
                            <label for="validationCustom03">Meta Title</label>
                            <input type="text" class="form-control" name="metta_tittle" id="meta_title">
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom04">Meta Description</label>
                                    <textarea class="form-control" name="metta_description" id="meta_description"
                                        placeholder="Put something" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom04">Meta Keywords</label>
                                    <textarea class="form-control" name="metta_keywords" id="meta_keywords"
                                        placeholder="Put something" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-lg-2">
            <div class="card">
                <div class="card-header">
                    Page Status
                </div>
                <div class="card-body">
                        <div class="form-group mb-2">
                        <input type="radio" checked="" value="Published" name="visible_status" id="active">
                        <label for="active">Published</label>
                        </div>
                        <div class="form-group mb-2">
                            <input type="radio" value="Not Published" name="visible_status" id="delete">
                            <label for="delete">Not Published</label>
                        </div>
                </div> <!-- end card-body-->
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button id="submitbutton" type="submit" class="btn btn-primary form-control">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
    <!-- end row -->
</div> <!-- container -->
<script src="{{ asset('admin/assets/js/driver.js') }}"></script>
<link href="{{ asset('/admin/assets/css/vendor/summernote-bs4.css') }}" rel="stylesheet" />
<script src="{{ asset('/admin/assets/js/vendor/summernote-bs4.min.js')}}"></script>
<script src="{{ asset('/admin/assets/js/pages/demo.summernote.js')}}"></script>
@endsection