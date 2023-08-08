@extends('admin.layouts.app')
@section('meta-tags')
<title>Add New Product</title>
@endsection


@section('admin-content')
<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add New Product</li>
                    </ol>
                </div>
                <h4 class="page-title">Add New Product</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <!-- end row-->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Add New Product
                </div>
                <div class="card-body table-responsive">
                    <form enctype="multipart/form-data" method="POST" action="{{ url('admin/products/add') }}">
                        @csrf

                        <div class="form-group">
                            <label>Product Name</label>
                            <input required type="text" name="name" placeholder="Product Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Product Short Description</label>
                            <textarea class="form-control" name="short_description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Product Price</label>
                            <input required type="text" name="price" placeholder="Product Price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Product Image</label>
                            <input required type="file" name="image" placeholder="Product Image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Product Document</label>
                            <input required type="file" name="document" placeholder="Product Image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Product Gallery Images</label>
                            <input type="file" name="gallaryimages[]" multiple placeholder="Product Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit"  value="Add New Product" class="btn btn-primary">
                        </div>
                    </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->        
    
</div> <!-- container -->

@endsection