@extends('admin.layouts.app')

@section('meta-tags')
<title>User Subscription Plans</title>
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
                        <li class="breadcrumb-item active">User Plans</li>
                    </ol>
                </div>
                <h4 class="page-title">User Plans</h4>
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
                            <a href="javascript:void(0);" id="addplanbutton" data-toggle="modal" data-target="#add-plan" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add Plan</a>
                        </div>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Plan Name</th>
                                <th>Images Allowed</th>
                                <th>Places Allowed</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                    
                    
                        <tbody>
                            @foreach($data as $r)
                            <tr>
                                <td>{{$r->name}}</td>
                                <td>{{$r->images_allowed}} Images</td>
                                <td>{{$r->places_allowed}} Places</td>
                                <td>${{$r->price}}</td>
                                
                                <td>

                                    @if($r->status == 1)
                                   <span class="badge badge-success" style="font-size:18px; text-transform: capitalize;"> Active </span>
                                    @else
                                    <span class="badge badge-danger" style="font-size:18px; text-transform: capitalize;"> In Active </span>
                                    @endif
                                </td>
                                    <td>{{ Cmf::date_format($r->created_at) }}</td>
                                <td style="text-align: center;">

                                    <div class="btn-group">
                                    <button type="button" class="btn btn-dark">Action</button>
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                    @if($r->status==1)
                                        <li><a href="{{url('admin/subscriptions/planstatus')}}/2/{{ $r->id }}" class="dropdown-item">De Activate</a></li>
                                    @elseif($r->status==2)
                                    <li><a href="{{url('admin/subscriptions/planstatus')}}/1/{{ $r->id }}" class="dropdown-item">Active</a></li>
                                    @endif
                                    <li><a href="{{url('admin/subscriptions/editplan')}}/{{ $r->id }}" class="dropdown-item">Edit Plan</a></li>
                                        
                                    </ul>
                                    </div>
                                    <!-- <a onclick="return confirm('Are You Sure You want to Delete This Plan')" href="{{url('admin/subscriptions/deleteplan')}}/{{ $r->id }}" class="action-icon"> <i class="mdi mdi-delete"></i></a> -->
                                </td>
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
@if($errors->has('price'))
<script type="text/javascript">
    $( document ).ready(function() {
        $('#add-plan').modal('show');
    });
    
</script>
@endif
<div id="add-plan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">New Plan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form method="POST" enctype="multipart/form-data" class="pl-3 pr-3" action="{{url('admin/subscriptions/createplan')}}">
                {{ csrf_field() }}
            <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Plan Name</label>
                        <input name="name" class="form-control input-lg" type="text" id="username" required="" placeholder="eg. Basic">
                    </div>
                    <div class="form-group">
                        <label for="username">No Of Images Upload</label>
                        <input name="images_allowed" class="form-control input-lg" type="number" id="username" required="" placeholder="10">
                    </div>
                    <div class="form-group">
                        <label for="username">Visit of places allowed</label>
                        <input name="places_allowed" class="form-control input-lg" type="number" id="username" required="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="username">Price (USD)</label>
                        <input name="price" class="form-control input-lg" type="text" id="username" required="" placeholder="eg. 20 days">
                        @if($errors->has('price'))
                            <div style="color: red">{{ $errors->first('price') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="username">Feature 1</label>
                        <input name="feature1" class="form-control input-lg" type="text" id="username">
                    </div>
                    <div class="form-group">
                        <label for="username">Feature 2</label>
                        <input name="feature2" class="form-control input-lg" type="text" id="username" >
                    </div>
                    <div class="form-group">
                        <label for="username">Feature 3</label>
                        <input name="feature3" class="form-control input-lg" type="text" id="username" >
                    </div>
                    <div class="form-group">
                        <label for="username">Feature 4</label>
                        <input name="feature4" class="form-control input-lg" type="text" id="username">
                    </div>
                    <div class="form-group">
                        <label for="username">Feature 5</label>
                        <input name="feature5" class="form-control input-lg" type="text" id="username" >
                    </div>
                    <div class="form-group">
                        <label for="username">Feature 6</label>
                        <input name="feature6" class="form-control input-lg" type="text" id="username" >
                    </div>
                    <div class="form-group">
                        <label for="username">Duration (Days)</label>
                        <input name="duration" class="form-control input-lg" type="text" id="username" required="duration" placeholder="eg. 20 days">
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