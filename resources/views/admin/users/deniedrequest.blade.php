@extends('admin.layouts.app')
@section('meta-tags')
<title>All Denied Requests</title>
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
                        </ol>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Decline Requests</h4>
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Dated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $r)
                                    <tr>
                                        <td>{{ $r->id }}</td>
                                        <td><a href="{{url('/admin/user/viewuserrequest')}}/{{ DB::table('users')->where('id' , $r->user_id)->get()->first()->id }}">{{ DB::table('users')->where('id' , $r->user_id)->get()->first()->name }}</a> </td>
                                        <th>{{ DB::table('users')->where('id' , $r->user_id)->get()->first()->email }}</th>
                                        <td>{{ DB::table('users')->where('id' , $r->user_id)->get()->first()->phonenumber }}</td>
                                        <td>{{ Cmf::date_format($r->created_at) }}</td>
                                        <td>
                                           <a href="{{ url('admin/user/viewuserrequest/') }}/{{ $r->user_id }}"> <button class="btn-sm btn btn-primary">View Request</button></a>
                                           <a href="{{url('/admin/user/deleterequest')}}/{{ $r->user_id }}"> <button class="btn-sm btn btn-danger">Delete Request</button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
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