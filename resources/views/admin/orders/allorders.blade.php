@extends('admin.layouts.app')
@section('meta-tags')
<title>All Freequences</title>
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
                            <li class="breadcrumb-item active">All Orders</li>
                        </ol>
                    </div>
                    <h4 class="page-title">All Orders</h4>
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
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Product</th>
                                                <th>Quantiy</th>
                                                <th>Price</th>
                                                <th>Payment Mode</th>
                                                <th>Payment Status</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($orders as $order)
                                            <tr>
                                                
                                                <td>{{ $order->name }}</td>
                                                <td>{{ $order->email }}</td>
                                                <td>{{ DB::table('products')->where('id',$order->product_id)->first() }}</td>
                                                <td>
                                                    <a href="{{ url('admin/freequency/edit') }}/{{ $r->id }}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                                    <a onclick="deletefunction({{ $r->id }})" href="javascript:void(0)" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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