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
                                <div class="row" >
                                    <div class="col-6">
                                        <h5>
                                            Order Details
                                        </h5>
                                        <p style="margin-bottom: 0px">Order Id : {{$data->id}}</p>
                                        <p style="margin-bottom: 0px">Payment Status : {{ ucfirst($data->payment_status)
                                            }}</p>
                                        <p style="margin-bottom: 0px">Payment Type : {{ ucfirst($data->payment_type)
                                            }}</p>
                                        <p style="margin-bottom: 0px">Order Date : {{
                                            Cmf::date_format($data->created_at) }}</p>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h5>
                                            Invoice to 
                                        </h5>
                                        <p style="margin-bottom: 0px">Fullname : {{$data->name}}</p>
                                        <p style="margin-bottom: 0px">Email : {{ $data->email
                                            }}</p>
                                        <p style="margin-bottom: 0px"> Phone : {{
                                           $data->phonenumber }}</p>
                                        <p style="margin-bottom: 0px"> Zipcode : {{
                                           $data->zipcode }}</p>
                                        <p style="margin-bottom: 0px"> Address : {{
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
                                                        DB::table('products')->where('id',$data->product_id)->first()->name }}
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
            </div> <!-- end col -->
        </div>

    </div> <!-- End Content -->

</div> <!-- content-page -->

<script type="text/javascript">
    function deletefunction(id)
    {
        Swal.fire({
          title: 'Are You Sure?',
          icon: 'warning',
          html: '',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Delete',
          denyButtonText: `Don't save`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
                var deletedurl = "{{ url('admin/freequency/delete/') }}/"+id;
                window.location.replace(deletedurl);
          } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
          }
        })
    }
</script>
@endsection