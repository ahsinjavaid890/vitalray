@extends('admin.layouts.app')


@section('meta-tags')
<title>User New Requests</title>
@endsection


@section('admin-content')

<div class="content-page">
    <div class="content">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <!-- <li class="breadcrumb-item active">Projects</li> -->
                        </ol>
                    </div>
                    <h4 class="page-title">Recent User Requests</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        
                        <h4 class="header-title mb-3">Recent User Requests</h4>


                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Request ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Dated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @if($data->where('user_type' , 'customer')->where('approve_status' , 'notapproved')->count() > 0)
                                <tbody>
                                   @foreach($data->where('user_type' , 'customer')->where('approve_status' , 'notapproved')->where('new' ,1) as $r)
                                    <tr>
                                        <td>{{ $r->id }}</td>
                                        <td><a href="{{url('/admin/user/viewuserrequest')}}/{{ $r->id }}">{{ $r->name }}</a> </td>
                                        <th>{{ $r->email }}</th>
                                        <td>{{ $r->phonenumber }}</td>
                                        <td>{{ Cmf::date_format($r->created_at) }}</td>
                                        <td>
                                           <a href="{{url('/admin/user/viewuserrequest')}}/{{ $r->id }}"> <button class="btn-sm btn btn-primary">View Request</button></a>
                                           <a href="{{url('/admin/user/deleterequest')}}/{{ $r->id }}"> <button class="btn-sm btn btn-danger">Delete Request</button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @else
                                <tr>
                                    <td></td>
                                    <th></th>
                                    <td></td>
                                    <td>No Any User Requests</td>
                                    <td></td>
                                    <td>
                                        
                                    </td>
                                </tr>

                                


                                @endif
                            </table> 
                        </div> <!-- end table-responsive-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
    </div> <!-- End Content -->

</div> <!-- content-page -->
@endsection