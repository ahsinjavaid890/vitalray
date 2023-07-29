@extends('admin.layouts.app')

 
@section('meta-tags')
<title>Blog Categories</title>
@endsection


@section('admin-content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Blog Categories</li>
                    </ol>
                </div>
                <h4 class="page-title">Blog Categories</h4>
            </div>
        </div>
    </div>
    @include('admin.alerts')
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1 text-left">
                            <a href="{{ url('admin/blog-categories') }}" class="btn @if($status == 'all') btn-success @else btn-primary @endif">Published</a>
                        </div>
                        <div class="col-md-1 text-left">
                            <a href="{{ url('admin/blog-categories') }}/trash" class="btn @if($status == 'trash') btn-success @else btn-primary @endif">Trash</a>
                        </div>
                        <div class="col-md-10 text-right">
                            <a href="{{ url('admin/blog/addnewcategory') }}" class="btn btn-primary">Add New Category</a>
                        </div>
                    </div>
                    <br>
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Category Image</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Dated</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $r)
                            <tr>
                                <td>
                                    <img src="{{ url('public/images') }}/{{ $r->image }}" class="img-thumbnail" style="width:100px;">
                                </td>
                                <td>{{ $r->name }}</td>

                                <td>
                                    @if($status == 'trash')
                                   <span class="badge badge-danger" style="font-size:18px; text-transform: capitalize;"> {{ $r->delete_status }} </span>
                                    @else
                                    <span class="badge badge-success" style="font-size:18px; text-transform: capitalize;"> {{ $r->visible_status }} </span>
                                    @endif
                                </td>
                                <td>{{ date('d M Y, h:s a ', strtotime($r->created_at)) }}</td>
                                <td class="table-action text-center">
                                    @if($status == 'trash')
                                    <a href="{{url('admin/blogcategory/restore')}}/{{ $r->id }}" class="btn btn-primary btn-sm" title="Restore Category"> Restore </a>
                                    @endif
                                    <a href="{{url('admin/blogcategory/edit')}}/{{ $r->id }}" class="action-icon" title="Edit Category"> <i class="mdi mdi-pencil"></i></a>
                                    @if($status == 'trash')
                                    <a onclick="deletefunctionpermanently({{ $r->id }})" href="javascript:void(0)" class="action-icon" title="Delte Category"> <i class="mdi mdi-delete"></i></a>
                                    @else
                                    <a onclick="deletefunction({{ $r->id }})" href="javascript:void(0)" class="action-icon" title="Delte Category"> <i class="mdi mdi-delete"></i></a>
                                    @endif
                                    
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
<script type="text/javascript">
    function deletefunctionpermanently(id) {
        Swal.fire({
          title: 'Are You Sure Want to Permanenty Delete this Category',
          icon: 'warning',
          html: 'All Blogs Will Be Deleted of Related Category',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Yes Delete',
          denyButtonText: `Don't save`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
                
                var deletedurl = "{{ url('admin/deleteblogcategorypermanently/') }}/"+id;

                window.location.replace(deletedurl);


          } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
          }
        })
    }
    function deletefunction(id)
    {
        Swal.fire({
          title: 'Are You Sure Want to move this Category to Trash?',
          icon: 'warning',
          html: 'All Blogs Will Be Moved to Trash of Related Category',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Move to Trash',
          denyButtonText: `Don't save`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
                
                var deletedurl = "{{ url('admin/deleteblogcategory/') }}/"+id;

                window.location.replace(deletedurl);


          } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
          }
        })
    }
</script>

@endsection