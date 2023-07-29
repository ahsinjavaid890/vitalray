@extends('admin.layouts.app')

 
@section('meta-tags')
<title>Add Blog</title>
<link href="{{ asset('admin/assets/css/vendor/summernote-bs4.css') }}" rel="stylesheet" />
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
                        <li class="breadcrumb-item"><a href="{{url('admin/blogs')}}">Blog</a></li>
                        <li class="breadcrumb-item active">Add Blog</li>
                    </ol>
                </div>
                <h4 class="page-title">Add Blog</h4>
            </div>
        </div>
    </div>
    @include('admin.alerts')
<form enctype="multipart/form-data" method="POST" action="{{ url('updateblog') }}" class="needs-validation" novalidate>
        {{ csrf_field() }}
        <input type="hidden" value="{{ $data->id }}" name="id">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Blog Details
                </div>
                <div class="card-body">
                        <div class="form-group">
                            <label>Select Category</label>
                            <select required class="form-control" name="cat_id">
                                <option value="">Select Category</option>
                                @foreach(DB::table('blogcategories')->where('delete_status' , 'Active')->get() as $r)
                                <option @if($data->cat_id == $r->id) selected @endif  value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="validationCustom01">Blog Name</label>
                            <input value="{{ $data->name }}" onkeyup="createslug(this.value)" type="text" class="form-control" name="name" id="validationCustom01"
                                placeholder="Title" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="validationCustom02">Slug</label>
                            <input value="{{ $data->url }}" type="text" id="slug" class="form-control" name="slug" onkeyup="checkslug()" 
                                 required >
                                 <small id="slugerror" class="mt-1 text-danger"></small>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="validationCustom01">Detailed Content</label>
                            <textarea id="summernote-basic" required="" name="content" class="form-control" rows="8">{{ $data->blog }}</textarea>
                        </div>
                        
                        
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <div class="col-lg-4">
            
            <div class="card">
                <div class="card-header">
                    Main Image
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="validationCustom03">Main Image</label>
                        <input required style="height: 44px;" type="file" class="form-control" name="image" id="validationCustom09"
                             >
                        <div class="invalid-feedback">
                            Please attach image file.
                        </div>
                    </div>
                    <div class="form-group">
                        <img style="width: 100%;" src="{{ url('public/images') }}/{{ $data->image }}">
                    </div>
                </div> <!-- end card-body-->
            </div> 
            <div class="row">
                <div class="col-md-12 text-right">
                    <button id="submitbutton" type="submit" class="btn btn-primary form-control">Save</button>
                </div>
            </div><!-- end card-->
        </div> <!-- end col-->
    </div>
</form>
</div> <!-- container -->
<script src="{{ asset('admin/assets/js/vendor/summernote-bs4.min.js')}}"></script>
  <script src="{{ asset('admin/assets/js/pages/demo.summernote.js')}}"></script>
<script type="text/javascript">
    function createslug(Text)
{
    $('#slug').val(convertToSlug(Text));    
}

function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
}
</script>
@endsection