@extends('admin.layouts.app')
@section('meta-tags')
<title>All Contact Us Messages</title>
@endsection
@section('admin-content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="url('admin/dashboard')">Dashboard</a></li>
                        <li class="breadcrumb-item active">Contact Messages</li>
                    </ol>
                </div>
                <h4 class="page-title">All Messages</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Contact ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Dated</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $r) 
                            <tr @if($r->status == 1) style="background-color:#d0f2d0;" @endif>
                                <td>{{ $r->id }}</td>
                                <td>{{ $r->name }}</td>
                                <td>{{ $r->email }}</td>
                                <td>{{ date('d M Y, h:s a ', strtotime($r->created_at)) }}</td>
                                <td class="table-action text-center">
                                    <a href="{{url('admin/contact/view')}}/{{$r->id}}" class="action-icon" title="View Detail"> <i class="mdi mdi-eye"></i></a>
                                    <a href="{{ url('admin/contact/delete') }}/{{ $r->id }}" class="action-icon" title="Delte"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
</div> <!-- container -->
@endsection