@extends('admin.layouts.app')
@section('meta-tags')
<title>All Countries</title>
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
                            <li class="breadcrumb-item active">Countries</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Countries</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#add-category" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add New</a>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Country Name</th>
                                                <th>Total Dates</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($data as $r)
                                            <tr>
                                                <td><img class="img img-thumbnail" width="50" src="{{asset('public/images')}}/{{ $r->image }}"></td>
                                                <td>{{ $r->name }}</td>
                                                <td>20</td>
                                                <td style="text-transform: capitalize;">
                                                    {{ $r->published_status }}
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/countries/edit') }}/{{ $r->id }}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                                    <a onclick="return confirm('Are You Sure You want to Delete This country')" href="{{ url('admin/countries/delete') }}/{{ $r->id }}" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        
    </div> <!-- End Content -->

</div> <!-- content-page -->


<!-- Modal -->
<div id="add-category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add Country</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/countries/create') }}">
                {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group">
                    <label class="lable-control">Country Name</label>
                    <input required type="text" class="form-control" name="name">
                </div>

                <div class="form-group">
                    <label class="lable-control">Image</label>
                    <input required type="file" class="form-control" name="image">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Now</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection