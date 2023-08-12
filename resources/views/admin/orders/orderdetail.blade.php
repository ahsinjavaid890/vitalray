@extends('admin.layouts.app')
@section('meta-tags')
<title>All Oders</title>
@endsection
@section('admin-content')
@include('admin.alerts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<div class="content-page">
    <div class="content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Order Detail</li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Order Detail</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <h4>
                                            Order Details
                                        </h4>
                                        <p style="margin-bottom: 0px"><strong>Order Id : </strong> {{$data->id}}</p>
                                        <p style="margin-bottom: 0px"><strong>Payment Status :</strong> {{
                                            ucfirst($data->payment_status)
                                            }}</p>
                                        <p style="margin-bottom: 0px"><strong>Payment Type :</strong> {{
                                            ucfirst($data->payment_type)
                                            }}</p>
                                        <p style="margin-bottom: 0px"><strong>Order Status :</strong> {{
                                            $data->order_status }}</p>
                                        <p style="margin-bottom: 0px"><strong>Order Date : </strong>{{
                                            Cmf::date_format($data->created_at) }}</p>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h4>
                                            Customer Information
                                        </h4>
                                        <p style="margin-bottom: 0px"><strong>Fullname :</strong> {{$data->name}}</p>
                                        <p style="margin-bottom: 0px"><strong>Email : </strong>{{ $data->email
                                            }}</p>
                                        <p style="margin-bottom: 0px"><strong> Phone : </strong>{{
                                            $data->phonenumber }}</p>
                                        <p style="margin-bottom: 0px"> <strong>Zipcode :</strong> {{
                                            $data->zipcode }}</p>
                                        <p style="margin-bottom: 0px"><strong>Address : </strong> {{
                                            $data->address }},{{ $data->city}}, {{$data->state}}</p>
                                    </div>
                                </div>
                                <div class="table-responsive mt-3">

                                    <table id="" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>

                                                <th>Product</th>
                                                <th>Quantiy</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <tr>
                                                <td>
                                                    {{
                                                    DB::table('products')->where('id',$data->product_id)->first()->name
                                                    }}
                                                </td>
                                                <td> {{
                                                    $data->qty }}</td>
                                                <td> {{
                                                    $data->total_price }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- end col -->
                        </div>

                        <div>
                            <h4 class="text-right">Total : {{$data->total_price}} USD</h4>
                        </div>
                        <!-- end row -->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->

                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('admin/order/updateorder') }}" method="post">
                            @csrf
                            <input type="hidden" name="order_id" value="{{$data->id}}">
                            <div>
                                <label for="">Order Status</label>
                                <select name="status" id="" class="form-control">
                                    <option @if ($data->order_status == "Pending") selected  @endif value="Pending" >Pending</option>
                                    <option  @if ($data->order_status == "Approved") selected  @endif value="Approved" >Approved</option>
                                    <option  @if ($data->order_status == "Shipped") selected  @endif value="Shipped" >Shipped</option>
                                    <option  @if ($data->order_status == "Delivered") selected  @endif value="Delivered" >Delivered</option>
                                </select>
                            </div>
                            <div class="mt-2">
                                <input type="submit" class="btn btn-info " value="Update">
                            </div>
                        </form>
                       
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div> <!-- End Content -->

</div> <!-- content-page -->


@endsection