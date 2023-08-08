@extends('admin.layouts.app')
@section('meta-tags')
<title>All Products</title>
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
                        <li class="breadcrumb-item active">All Products</li>
                    </ol>
                </div>
                <h4 class="page-title">All Products</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <!-- end row-->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Document</th>
                                <th>Action</th>
                            </tr>
                        </thead>                    
                        <tbody>
                            @foreach($data as $r)
                            <tr>
                                <th><img src="{{ url('public/images') }}/{{ $r->image }}" width="120" height="120" class="img-thumbnail"></th>
                                <th>{{ $r->name }}</th>
                                <td>${{ $r->price}}</td>
                                <td>
                                    <a href="{{ url('public/images') }}/{{ $r->document }}" class="btn btn-primary" download="true">PDF Document</a>
                                </td>
                                <td>
                                    <a href="{{ url('admin/products/edit') }}/{{ $r->id }}" class="btn btn-primary">Edit</a>
                                    <a data-toggle="modal" data-target="#myModal{{ $r->id }}" href="javascript:void(0)" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div id="myModal{{ $r->id }}" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <form method="POST" action="{{ url('admin/products/delete') }}">
                                    @csrf
                                <input type="hidden" value="{{ $r->id }}" name="id">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Delete Product</h4>
                                  </div>
                                  <div class="modal-body">
                                    Are You Sure You Want to Delete This Product?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Yes</button>
                                  </div>
                                </div>
                                </form>
                              </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>  
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->        
    
</div> <!-- container -->

@endsection