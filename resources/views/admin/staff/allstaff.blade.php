@extends('admin.layouts.app')


@section('meta-tags')
<title>All Staff</title>
@endsection


@section('admin-content')

@include('admin.alerts')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Staff</li>
                    </ol>
                </div>
                <h4 class="page-title">All Staff ( {{DB::table('users')->where('is_admin' , 1)->count()}})</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#add-seller" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add Staff</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Activate</th>
                                    <th style="width: 75px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(DB::table('users')->where('is_admin' , 1)->get() as $r)
                                <tr>
                                    
                                    <td>
                                       {{$r->id}}
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)">{{$r->name}}</a>
                                        
                                    </td>
                                    <td>
                                        {{$r->email}}
                                    </td>
                                    <td>
                                        {{$r->phonenumber}}
                                    </td>
                                    <td>
                                        {{DB::table('roles')->where('id' , $r->role_id)->get()->first()->name}}
                                    </td>
                                    <td>
                                        <div>
                                            <input type="checkbox" onclick="publish({{$r->id}} ,  {{ $r->active }})" id="switch1{{ $r->id }}" <?php if($r->active == 1){echo 'checked'; } ?> data-switch="success"/>
                                            <label for="switch1{{ $r->id }}" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                        </div>
                                    </td>

                                    <td>
                                        <a data-toggle="modal" data-target="#edit-user-role{{ $r->id }}" href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="edit-user-role{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="edit-modalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="edit-modalLabel">User Role</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <form enctype="multipart/form-data" method="POST" action="{{ url('updateadminuser') }}" class="needs-validation" novalidate>
                                                            {{ csrf_field() }}
                                                            <input type="hidden" value="{{ $r->id }}" name="id">
                                          <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-2">
                                                        <label for="validationCustom01">Full Name</label>
                                                        <input type="text" class="form-control" value="{{ $r->name }}" name="name" id="validationCustom01"
                                                             required >
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="validationCustom01">Email</label>
                                                        <input readonly="" type="text" value="{{ $r->email }}" class="form-control" name="email" id="validationCustom01"
                                                             required >
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="validationCustom01">Phone Number</label>
                                                        <input type="text" class="form-control" name="phonenumber" value="{{ $r->phonenumber }}" id="validationCustom01"
                                                             required >
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-2">
                                                        <label for="validationCustom01">User Role</label>
                                                        <select name="userroleid" class="form-control">
                                                            <option value="">Select Role</option>
                                                            @foreach(DB::table('roles')->get() as $u)
                                                            <option @if($r->role_id == $u->id) selected @endif value="{{ $u->id }}">{{ $u->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label for="username">Country</label>
                                                        <input value="{{ $r->country }}" class="form-control input-lg" type="text" name="country" required="" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="username">State/Province</label>
                                                        <input value="{{ $r->state }}" class="form-control input-lg" type="text" name="state" required="" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="username">Zip Code</label>
                                                        <input value="{{ $r->zipcode }}" class="form-control input-lg" type="text" name="zipcode" required="" placeholder="">
                                                    </div>    
                                                     <div class="form-group">
                                                        <label for="username">Change Password</label>
                                                        <input  class="form-control input-lg" type="password" name="password"  placeholder="Change Password">
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
    
</div> <!-- container -->
<div id="add-seller" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">New Staff</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
                  <form enctype="multipart/form-data" method="POST" action="{{ url('createadminuser') }}" class="needs-validation" novalidate>
                        {{ csrf_field() }}
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <label for="validationCustom01">Full Name</label>
                                    <input type="text" class="form-control" name="name" id="validationCustom01"
                                         required >
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="validationCustom01">Email</label>
                                    <input type="text" class="form-control" name="email" id="validationCustom01"
                                         required >
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="validationCustom01">Phone Number</label>
                                    <input type="text" class="form-control" name="phonenumber" id="validationCustom01"
                                         required >
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="validationCustom01">User Role</label>
                                    <select name="userroleid" class="form-control">
                                        <option value="">Select Role</option>
                                        @foreach(DB::table('roles')->get() as $r)
                                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="username">Country</label>
                                    <input class="form-control input-lg" type="text" name="country" required="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="username">State/Province</label>
                                    <input class="form-control input-lg" type="text" name="state" required="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="username">Zip Code</label>
                                    <input class="form-control input-lg" type="text" name="zipcode" required="" placeholder="">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="validationCustom01">Password</label>
                                    <input type="password" class="form-control" name="password" id="validationCustom01"
                                         required >
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>               
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <a type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary">Add New User</button>
                      </div>
                  </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="view-seller" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">New Staff</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="pl-3 pr-3" action="#">
                    <div class="form-group">
                        <label for="username">First Name</label>
                        shahzad
                    </div>
                    <div class="form-group">
                        <label for="username">Last Name</label>
                        Iqbal
                    </div>
                    <div class="form-group">
                        <label for="username">Email</label>
                        shahzadmughal@gmail.com
                    </div>
                    <div class="form-group">
                        <label for="username">Phone</label>
                        +923407712387
                    </div>
                    <div class="form-group">
                        <label for="username">Country</label>
                        pakistan
                    </div>
                    <div class="form-group">
                        <label for="username">State/Province</label>
                        Punjab  
                    </div>
                    <div class="form-group">
                        <label for="username">Zip Code</label>
                        12300
                    </div>
    
                    <div class="form-group">
                        <label for="username">Role</label>
                        Manager
                    </div>                    

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Now</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function publish(one,two)
    {
        $.ajax({
          type: "GET",
          url: "{{ url('admin/staff/changetopublishuser') }}/"+one+'/'+two,
          success: function(resp) {
             if(resp == 'error'){
              location.reload();
             }else{
              location.reload();
             } 
          }
        });
    }
</script>
@endsection