@extends('admin.layouts.app')

 
@section('meta-tags')
<title>All Blogs</title>
@endsection

@section('admin-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Blgos</li>
                    </ol>
                </div>
                <h4 class="page-title">All Blogs</h4>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-12">
 
            
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form id="completeform" method="POST" action="{{ url('changebulkusersofall') }}">
                            {{ csrf_field() }} 

                            @foreach($data as $r)
                            <tr>                            
                                <td>{{ $r->name }}</td>
                                <td>{{ $r->visible_status }}</td>
                                <td>{{ $r->created_at }}</td>
                                <td><a href="{{ url('admin/edit/blog')}}/{{$r->id}}" class="action-icon" title="Edit Category"><i class="mdi mdi-pencil"></i></a><a onclick="return confirm('Are You Sure You want to Delete This Blog')" href="{{ url('deleteblogtrash')}}/{{$r->id}}" class="action-icon" title="Delte Category"> <i class="mdi mdi-delete"></i></a></td>
                            </tr>
                            @endforeach
                            </form>   
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
</div> <!-- container -->
@endsection