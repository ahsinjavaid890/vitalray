@extends('admin.layouts.app')
@section('meta-tags')
<title>All Users</title>
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <!-- <li class="breadcrumb-item active">Projects</li> -->
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
                        <h4 class="header-title mb-3">All Users</h4>
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
                                    @foreach($data->where('user_type' , 'customer')->where('approve_status' , 'approved')->where('active' , 1) as $r)
                                    <tr>
                                        <td>{{ $r->id }}</td>
                                        <td><a href="{{url('/admin/user/viewuserrequest')}}/{{ $r->id }}">{{ $r->name }}</a> </td>
                                        <th>{{ $r->email }}</th>
                                        <td>{{ $r->phonenumber }}</td>
                                        <td>{{ Cmf::date_format($r->created_at) }}</td>
                                        <td>
                                            <div class="btn-group">
                                            <button type="button" class="btn btn-dark">Action</button>
                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{url('/admin/user/userdetail')}}/{{ $r->id }}" class="dropdown-item">View</a></li>
                                                <li><a onclick="deletefunction({{ $r->id }})" href="javascript:void(0)" class="dropdown-item">Delete User</a></li>
                                            </ul>
                                            </div>
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
<script type="text/javascript">
    function deletefunction(id)
    {
        // Swal.fire({
        //   title: 'Are You Sure?',
        //   icon: 'warning',
        //   html: 'If you want to Delete This User then All Data Will be Automaticaly Deleted Against This User',
        //   showDenyButton: false,
        //   showCancelButton: true,
        //   confirmButtonText: 'Delete',
        //   denyButtonText: `Don't save`,
        // }).then((result) => {
        //   /* Read more about isConfirmed, isDenied below */
        //   if (result.isConfirmed) {
        //     var deletedurl = "{{ url('admin/user/delete/') }}/"+id;
        //     window.location.replace(deletedurl);
        //   } else if (result.isDenied) {
        //     Swal.fire('Changes are not saved', '', 'info')
        //   }
        // })


        Swal.fire({
          title: 'Please Enter Your Admin Password',
          icon: 'warning',
          html: 'If you want to Delete This User then All Data Will be Automaticaly Deleted Against This User',
          input: 'text',
          inputAttributes: {
            autocapitalize: 'off'
          },
          showCancelButton: true,
          confirmButtonText: 'Submit',
          showLoaderOnConfirm: true,
          preConfirm: (login) => {
                var deletedurl = "{{ url('admin/user/delete/') }}/"+id+'/'+login;
                window.location.replace(deletedurl);
          },
          allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
          if (result.isConfirmed) {
            
            console.log('ok')

          }
        })
    }
</script>
@endsection