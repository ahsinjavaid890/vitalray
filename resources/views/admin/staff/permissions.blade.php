@extends('admin.layouts.app')
@section('title','User Roles')
@section('admin-content')
<div class="container-fluid">
    <!-- start page title -->
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">User Roles</li>
                    </ol>
                </div>
                <h4 class="page-title">User Roles</h4>
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
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#edit-user" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add New Role</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead  class="thead-light">
                                <tr>
                                    <th>Role Name</th>
                                    <th style="width: 85px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(DB::table('roles')->get() as $r)
                                <tr>
                                    <td>
                                        {{ $r->name }}
                                    </td>
                                    <td class="table-action">
                                        <a data-toggle="modal" data-target="#edit-user-role{{ $r->id }}" href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="edit-user-role{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="edit-modalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="edit-modalLabel">User Role</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                       <form enctype="multipart/form-data" method="POST" action="{{ url('updateuserrole') }}" class="needs-validation" novalidate>
                                                        {{ csrf_field() }}
                                      <input type="hidden" name="id" value="{{ $r->id }}">
                                      <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="form-group mb-2">
                                                    <label for="validationCustom01">Name</label>
                                                    <input type="text" value="{{ $r->name }}" class="form-control" name="name" id="validationCustom01"
                                                         required >
                                                </div>
                                                <div class="form-group mb-2">
                                                    <div style="height:400px;overflow: auto;">
                                                    <label for="validationCustom01">Select Role</label>
                                                    <div class="col-md-12">
                                                        @foreach(DB::table('adminmodules')->get() as $p)
                                                            @php 
                                                                $child = DB::table('adminchildmodules')->where('adminparent' , $p->id);
                                                            @endphp

                                                            <div>
                                                                <input onclick="checkbox({{$p->id}})" class="parentcheckbox{{ $p->id }}" @if(DB::table('rolesparent')->where('userroles' , $r->id)->where('parentid' , $p->id)->count() > 0) checked  @endif id="parent{{ $p->id }}" type="checkbox" value="{{$p->id}}" name="parent[]">
                                                            <label for="parent{{ $p->id }}">{{ $p->name }}</label>
                                                            </div>
                                                            <div style="padding-left: 30px;">
                                                            @if($child->count() > 0)
                                                                @foreach($child->get() as $c)
                                                                <div>
                                                                    <input class="parentid{{$p->id}}" @if(DB::table('childroles')->where('role' , $r->id)->where('module' , $c->id)->count() > 0) checked  @endif id="child{{$c->id}}" type="checkbox" value="{{$c->id}}" name="child[]">
                                                                    <label for="child{{$c->id}}">{{ $c->name }}</label>
                                                                </div>
                                                                @endforeach
                                                            @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <a type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                      </div>
                                    </form>
                                    </div>
                                  </div>
                                </div>


                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->  
</div>

<!-- Modal -->
<div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="edit-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-modalLabel">User Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form enctype="multipart/form-data" method="POST" action="{{ url('createuserrole') }}" class="needs-validation" novalidate>
                        {{ csrf_field() }}
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">

                <div class="form-group mb-2">
                    <label for="validationCustom01">Name</label>
                    <input type="text" class="form-control" name="name" id="validationCustom01"
                         required >
                </div>
                <div class="form-group mb-2">
                    <div style="height:400px;overflow: auto;">
                    <label for="validationCustom01">Select Role</label>
                    <div class="col-md-12">
                        @foreach(DB::table('adminmodules')->get() as $r)
                            @php 
                                $child = DB::table('adminchildmodules')->where('adminparent' , $r->id);
                            @endphp
                            <div>
                                <input onclick="checkbox({{$r->id}})" class="parentcheckbox{{ $r->id }}" id="parent{{ $r->id }}" type="checkbox" value="{{$r->id}}" name="parent[]">
                                <label  for="parent{{ $r->id }}">{{ $r->name }}</label>
                            </div>
                            <div style="padding-left: 30px;">
                            @if($child->count() > 0)
                                @foreach($child->get() as $c)
                                <div>
                                    <input id="child{{$c->id}}" class="parentid{{$r->id}}" type="checkbox" value="{{$c->id}}" name="child[]">
                                    <label for="child{{$c->id}}">{{ $c->name }}</label>
                                </div>
                                @endforeach
                            @endif
                            </div>
                        @endforeach
                    </div>
                    </div>
                </div>
               
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
        <button type="submit" class="btn btn-primary">Add New role</button>
      </div>
    </form>
    </div>
  </div>
</div>
 <script type="text/javascript">
    function checkbox(id)
    {
        if($('.parentcheckbox'+id).prop("checked") == true){
            $('.parentid'+id).prop('checked', true);
        }
        else if($('.parentcheckbox'+id).prop("checked") == false){
            $('.parentid'+id).prop('checked', false);
        }
    }
</script>
@endsection