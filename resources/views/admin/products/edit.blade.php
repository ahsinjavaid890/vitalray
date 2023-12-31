@extends('admin.layouts.app')
@section('meta-tags')
<title>Update Product</title>
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
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Update Product</li>
                    </ol>
                </div>
                <h4 class="page-title">Update Product</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- end row-->

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Update Product
                </div>
                <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <form enctype="multipart/form-data" method="POST"
                                action="{{ url('admin/products/updateproduct') }}">
                                @csrf
                                <input type="hidden" value="{{ $data->id }}" name="id">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input required type="text" value="{{ $data->name }}" name="name"
                                        placeholder="Product Name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Product Short Description</label>
                                    <textarea class="form-control"
                                        name="short_description">{{ $data->short_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Product Description</label>
                                    <textarea class="form-control"
                                        name="description">{{ $data->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Product Price</label>
                                    <input required type="text" value="{{ $data->price }}" name="price"
                                        placeholder="Product Price" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Product Image</label>
                                    <input type="file" name="image" placeholder="Product Image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <img src="{{ url('public/images') }}/{{ $data->image }}" width="120" height="120"
                                        class="img-thumbnail">
                                </div>
                                <div class="form-group">
                                    <label>Product Document</label>
                                    <input type="file" name="document" placeholder="Product Image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <a href="{{ url('public/images') }}/{{ $data->document }}" class="btn btn-primary"
                                        download="true">PDF Document</a>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Update Product" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
            <!-- end card-->
        </div> <!-- end col -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Gallary Images
                </div>
                <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <form enctype="multipart/form-data" method="POST"
                                action="{{ url('admin/products/updategallaryimages') }}">
                                @csrf
                                <input type="hidden" value="{{ $data->id }}" name="id">
                                <div class="form-group">
                                    <label>Product Gallery Images</label>
                                    <input required type="file" name="gallaryimages[]" multiple
                                        placeholder="Product Name" class="form-control">
                                </div>
                                @php
                                $image = DB::table('products_images')->where('product_id',$data->id)->get();
                                @endphp
                                @foreach ($image as $i)

                                <!-- file preview template -->
                                <div class="mb-2" id="uploadPreviewTemplate">
                                    <div class="card mt-1 mb-0 shadow-none border">
                                        <div class="p-2">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img data-dz-thumbnail src="{{ url('public/images') }}/{{ $i->image }}" width="100" class="rounded bg-light"
                                                        alt="">
                                                </div>
                                                <div class="col pl-0">
                                                    <a href="javascript:void(0);" class="text-muted font-weight-bold"
                                                        data-dz-name></a>
                                                    <p class="mb-0" data-dz-size></p>
                                                </div>
                                                <div class="col-auto">
                                                    <!-- Button -->
                                                    <a href="{{url('admin/products/image/delete/')}}/{{$i->id}}" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                                        <i class="dripicons-cross"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                @endforeach

                                <div class="form-group">
                                    <input type="submit" value="Update Gallary Images" class="btn btn-success">
                                </div>
                            </form>



                            

                        </div>
                    </div>

                </div> <!-- end card-body-->
            </div>
        </div>
    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection