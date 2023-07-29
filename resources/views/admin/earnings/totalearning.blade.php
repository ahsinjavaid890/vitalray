@extends('admin.layouts.app')


@section('meta-tags')
<title>Total Earnings</title>
@endsection


@section('admin-content')
<!-- <style type="text/css">
    .activecard{
        background-color: black;
        color: white !important;
    }
</style> -->
<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Earnings</li>
                    </ol>
                </div>
                <h4 class="page-title">Earnings</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    @include('admin.earnings.earningnav')
    <!-- end row-->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Payement ID</th>
                                <th>Customer Name</th>
                                <th>Chrage ID</th>
                                <th>Payement Chenel</th>
                                <th>Payement Description</th>
                                <th>Ammount</th>
                                <th>Status</th>
                                <!-- <th>Refunded Ammount</th> -->
                                <!-- <th>refund Notes</th> -->
                                <th>Dated</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                    
                    
                        <tbody>
                            @foreach($data as $r)
                            <tr>
                                <th>{{ $r->id }}</th>
                                <th>
                                    @if(DB::table('users')->where('id' , $r->customer_id)->get()->first())
                                    {{ DB::table('users')->where('id' , $r->customer_id)->get()->first()->name }}
                                    @else

                                    User Not Found

                                    @endif
                                </th>
                                <th>{{ $r->charge_id }}</th>
                                <td>{{$r->payment_channel}}</td>
                                <td>{{ $r->description }}</td>
                                <td>${{ $r->amount }}</td>
                                <td>{{ $r->status }}</td>
                                <!-- <td>{{ $r->refunded_amount }}</td> -->
                                <!-- <td>{{$r->refund_note}}</td> -->
                                <td>{{ Cmf::date_format($r->created_at) }}</td>
                                <!-- <td>
                                    <a href="{{ url('admin/earnings/view/') }}/{{$r->id}}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                </td> -->
                            </tr>
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