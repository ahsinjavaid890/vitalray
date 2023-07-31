@extends('admin.layouts.app')
@section('meta-tags')
<title>All Places</title>
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
                            <li class="breadcrumb-item active">Places</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Places</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#add-category" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add New</a>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Country Name</th>
                                                <th>Place Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($data as $r)
                                            <tr>
                                                <td><img class="img img-thumbnail" width="50" src="{{asset('public/images')}}/{{ $r->image }}"></td>
                                                <td>{{ DB::table('countries')->where('id' , $r->countries)->get()->first()->name }}</td>
                                                <td>{{ $r->name }}</td>
                                                <td style="text-transform: capitalize;">
                                                    {{ $r->published_status }}
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/places/edit') }}/{{ $r->id }}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
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
          html: 'All Date Will Be Deleted Automaticaly against this Place',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Delete',
          denyButtonText: `Don't save`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
                
                var deletedurl = "{{ url('admin/places/delete/') }}/"+id;

                window.location.replace(deletedurl);


          } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
          }
        })
    }
</script>
<!-- Modal -->
<div id="add-category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Add Place</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/places/create') }}">
                {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group">
                    <label>Select Country</label>
                    <select class="form-control" name="country">
                        <option>Select Country</option>
                        @foreach($countries as $r)
                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="lable-control">Place Name</label>
                    <input required type="text" class="form-control" name="name">
                </div>

                <div class="form-group">
                    <label class="lable-control">Image</label>
                    <input required type="file" class="form-control" name="image">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Now</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection