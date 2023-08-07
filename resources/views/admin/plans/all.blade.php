@extends('admin.layouts.app')


@section('meta-tags')
<title>All Plans</title>
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
                        <li class="breadcrumb-item active">All Plans</li>
                    </ol>
                </div>
                <h4 class="page-title">All Plans</h4>
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
                                <th>Plan ID</th>
                                <th>Plan Name</th>
                                <th>Plan Price</th>
                                <th>Number Of Days</th>
                                <th>Stripe ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>                    
                        <tbody>
                            @foreach($data as $r)
                            <tr>
                                <th>{{ $r->id }}</th>
                                <th>{{ $r->name }}</th>
                                <td>${{ $r->price}}</td>
                                <td>{{ $r->no_of_days }}</td>
                                <td>{{$r->stripe_plan }}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#myModal{{ $r->id }}" href="javascript:void(0)" class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div id="myModal{{ $r->id }}" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <form method="POST" action="{{ url('admin/updateplan') }}">
                                    @csrf
                                <input type="hidden" value="{{ $r->id }}" name="id">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Edit Plan</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" type="text" required value="{{ $r->name }}" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label>price</label>
                                        <input class="form-control" type="text" required value="{{ $r->price }}" name="price">
                                    </div>
                                    <div class="form-group">
                                        <label>No of Days</label>
                                        <input class="form-control" type="text" required value="{{ $r->no_of_days }}" name="no_of_days">
                                    </div>
                                    <div class="form-group">
                                        <label>Stripe ID</label>
                                        <input class="form-control" type="text" required value="{{ $r->stripe_plan }}" name="stripe_plan">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Submit</button>
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