@extends('admin.layouts.app')

 
@section('meta-tags')
<title>Blog Comment</title>
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
                        <li class="breadcrumb-item"><a href="{{url('admin/blogs-coments')}}">Blog Coments</a></li>
                        <li class="breadcrumb-item active">Edit Blog Coment</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Blog Coment</h4>
            </div>
        </div>
    </div>
    @include('admin.alerts')

    <div class="row">
        
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Edit Blog Coment
                </div>
                <form enctype="multipart/form-data" method="POST" action="{{ url('updateblogcoment') }}" class="needs-validation" novalidate>
        {{ csrf_field() }}
                <div class="card-body">
                    <input type="hidden" value="{{ $data->id }}" name="id">
                        <div class="form-group mb-3">
                            <label for="validationCustom01">Comment</label>
                            <textarea class="form-control" name="coment" id="validationCustom02"
                                placeholder="Put something" required rows="4">{{ $data->coment }}</textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div> 
                        <div class="form-group mb-2">
                        <input type="radio" @if($data->visible_status == 'Published') checked @endif value="Published" name="visible_status" id="active">
                        <label for="active">Published</label>
                        </div>
                        <div class="form-group mb-2">
                            <input @if($data->visible_status == 'Not Published') checked @endif type="radio" value="Not Published" name="visible_status" id="delete">
                            <label for="delete">Not Published</label>
                        </div>
                        <div class="col-md-12 text-right">
                    <button id="submitbutton" type="submit" class="btn btn-primary ">Save</button>
                </div>
                </div> <!-- end card-body-->
            </form>
            </div> <!-- end card-->
        </div>
    </div>

</div> <!-- container -->
@endsection