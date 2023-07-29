@extends('admin.layouts.app')


@section('meta-tags')
<title>All Pages</title>
<script src="{{ asset('admin/assets/js/driver.js') }}"></script>
@endsection


@section('admin-content')

@include('admin.alerts')

<div class="container-fluid">
    <!-- start page title -->
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pages</li>
                    </ol>
                </div>
                <h4 class="page-title">Pages</h4>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs nav-bordered mb-3">
        <li class="nav-item">
            <a href="{{ url('admin/pages/allpages') }}"  class="nav-link @if($viewstatus == 'all') active @endif">
                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                <span class="d-none d-md-block">All<span style="margin-left: 10px;" class="badge badge-pill badge-info">{{DB::table('dynamicpages')->where('delete_status' , 'Active')->count()}}</span></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('admin/pages/allpages/published') }}"  class="nav-link @if($viewstatus == 'published') active @endif">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Published<span style="margin-left: 10px;" class="badge badge-pill badge-success">{{DB::table('dynamicpages')->where('visible_status' , 'Published')->where('delete_status' , 'Active')->count()}}</span></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('admin/pages/allpages/notpublished') }}"  class="nav-link @if($viewstatus == 'notpublished') active @endif">
                <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                <span class="d-none d-md-block">Not Published<span style="margin-left: 10px;" class="badge badge-pill badge-warning">{{DB::table('dynamicpages')->where('visible_status' , 'Not Published')->where('delete_status' , 'Active')->count()}}</span></span>
            </a>
        </li>
    </ul> 
    <!-- end page title --> 
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead  class="thead-light">
                                <tr>
                                    <th>Page Name</th>
                                    <th>Visible on Footer</th>
                                    <th>Visible Order</th>
                                    <th>Visible Status</th>
                                    <th>Created At</th>
                                    <th style="width: 120px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $r)
                                <tr>
                                    <td>{{ $r->name }}</td>
                                    <td><span style="font-size: 15px;" class="badge badge-pill @if($r->show_on_footer == 'Yes') badge-success @else badge-danger @endif">{{ $r->show_on_footer }}</span></td>
                                    <td>{{ $r->visible_order }}</td>
                                    <td><div class="badge badge-pill @if($r->visible_status == 'Published') badge-success @endif @if($r->visible_status == 'Trash') badge-danger @endif @if($r->visible_status == 'Not Published') badge-warning @endif" style="font-size: 15px;">{{  $r->visible_status }}</div></td>
                                    <td>{{ date('d M Y, h:s a ', strtotime($r->created_at)) }}</td>
                                    <td class="table-action text-center">
                                        <a href="{{url('admin/pages/edit')}}/{{ $r->id }}" class="action-icon" title="Edit Category"> <i class="mdi mdi-pencil"></i></a>
                                        <a onclick="return confirm('Are You Sure You want to Delete This')" href="{{url('admin/pages/deletepage')}}/{{ $r->id }}" class="action-icon" title="Delte Category"> <i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->  
</div>

@endsection