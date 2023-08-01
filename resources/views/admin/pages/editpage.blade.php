@extends('admin.layouts.app')


@section('meta-tags')
<title>Edit Page</title>
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
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pages</li>
                        <li class="breadcrumb-item active">Edit Category</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Page : {{ $data->name }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
<form enctype="multipart/form-data" method="POST" action="{{ url('updatepage') }}" class="needs-validation" novalidate>
        {{ csrf_field() }}
        <input type="hidden" value="{{ $data->id }}" name="id">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Page Details
                </div>
                <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="validationCustom01">Page Name</label>
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
                        <div class="form-group mb-2">
                            <label for="validationCustom01">Detailed Content</label>
                            <textarea id="summernote-basic" required="" name="content" class="form-control" rows="8">{{ $data->content }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="show_on_footer">Show on Footer</label>
                            <select required="" id="show_on_footer" class="form-control" name="show_on_footer">
                                <option value="">Select</option>
                                <option @if($data->show_on_footer == 'Yes') selected @endif value="Yes">Yes</option>
                                <option @if($data->show_on_footer == 'No') selected @endif value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="show_bellow">Show Bellow</label>
                            <select required="" id="show_bellow" class="form-control" name="show_bellow">
                                <option value="">Select</option>
                                <option @if($data->show_bellow == 'Help') selected @endif value="Help">Help</option>
                                <option @if($data->show_bellow == 'Guideline') selected @endif value="Guideline">Guideline</option>
                                <option @if($data->show_bellow == 'Policy') selected @endif value="Policy">Policy</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="visible_order">Visible Order</label>
                            <input class="form-control" type="text" value="{{ $data->visible_order }}" name="visible_order" id="visible_order">
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
                            <input type="text" class="form-control" value="{{ $data->metta_tittle }}" name="metta_tittle" id="meta_title">
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom04">Meta Description</label>
                                    <textarea class="form-control" name="metta_description" id="meta_description"
                                        placeholder="Put something"  rows="4">{{ $data->metta_description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom04">Meta Keywords</label>
                                    <textarea class="form-control" name="metta_keywords" id="meta_keywords"
                                        placeholder="Put something" rows="4">{{ $data->metta_keywords }}</textarea>
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
                        <input type="radio" @if($data->visible_status == 'Published') checked @endif value="Published" name="visible_status" id="active">
                        <label for="active">Published</label>
                        </div>
                        <div class="form-group mb-2">
                            <input @if($data->visible_status == 'Not Published') checked @endif type="radio" value="Not Published" name="visible_status" id="delete">
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