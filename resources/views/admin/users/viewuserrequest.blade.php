@extends('admin.layouts.app')


@section('meta-tags')
<title>User New Requests</title>
@endsection


@section('admin-content')
@include('admin.alerts')
<link href="{{ asset('admin/assets/css/vendor/summernote-bs4.css') }}" rel="stylesheet" />
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{url('admin/vendor/newvendorsreuqests')}}">Requests</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
                <h4 class="page-title">New User (Request) detail</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card">
                <div class="card-body">
                    <img src="{{asset('public/images')}}/{{ $data->profileimage }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                    <h4 class="mb-0 mt-2">{{$data->name}}</h4>
                    
                    <script type="text/javascript">
                    	function deniyrequest()
                    	{
                    		$('#denymodal').modal('show');
                    	}
                    	function approvednotes()
                    	{
                    		$('#approveform').submit();
                    	}
                    </script>

                    <div class="text-left mt-3">
                        <h4 class="font-13 text-uppercase">About {{$data->name}} :</h4>
                        <p class="text-muted font-13 mb-3">
                            {{$data->about}}
                        </p>
                        <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2">{{$data->name}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">{{$data->phonenumber}}</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{$data->email}}</span></p>

                        <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2"></span></p>
                    </div>
                    @if($data->approve_status != 'approved')

                    @if(DB::table('deniedrequests')->where('user_id' , $data->id)->where('status' , 'deny')->count() > 0)

                    <style type="text/css">
                        .deniednotes{
                            padding: 10px;
                            background-color: #ddd;
                            margin-bottom: 10px;
                        }
                    </style>
                    <button data-toggle="modal" data-target="#deniednotes" class="btn btn-danger">Denied Notes</button>
                    <div class="modal fade" id="deniednotes">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Denied Notes</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                                @foreach(DB::table('deniedrequests')->where('user_id' , $data->id)->get() as $r)
                                <div class="deniednotes">
                                    {!!  $r->reason !!}
                                </div>        
                                @endforeach
                          </div>
                          <!-- <div class="modal-footer">
                            <button data-toggle="modal" data-target="#denymodal" class="btn btn-danger">Again Send</button>
                          </div> -->

                        </div>
                      </div>
                    </div>
                    @else
                    <button onclick="approvednotes()" type="button" class="btn btn-success btn-sm mb-2">Approve</button>
                    <button onclick="deniyrequest()" type="button" class="btn btn-danger btn-sm mb-2">Deny</button>
                    @endif
                    @endif
                </div> <!-- end card-body -->
            </div> <!-- end card -->
            <!-- The Modal -->
            <div class="modal fade" id="denymodal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Deny User Request</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <form method="POST" action="{{ url('admin/user/rejectrequest') }}">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $data->id }}" name="id">
                        <div class="card-body">
                            <div class="form-group">
                                @php
                                    $user = DB::table('users')->where('id' , $data->id)->first();
                                    $plan = $user->selectplan;
                                    $plan = DB::table('subscriptionplans')->where('id' , $plan)->first();
                                @endphp
                                <div class="alert alert-success">This User Select {{ $plan->name }} , $({{$plan->price}})</div>
                            </div>
                            <div class="form-group">
                                <label>Delete User Or Not</label>
                                <select required class="form-control" name="deleteuserornot">
                                    <option>Select Option</option>
                                    <option value="delete">Delete This User</option>
                                    <option value="notdelete">Not Delete</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Denied Reason</label>
                                <textarea id="summernote-basic" rows="8" class="form-control" name="reason"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div style="display: none;" class="card approvedbox">
            	<form id="approveform" method="POST" action="{{ url('admin/user/approverequest') }}">
            		{{ csrf_field() }}
            		<input type="hidden" value="{{ $data->id }}" name="id">
	            	<div class="card-body">
	            		<!-- <div class="form-group">
	            			<label>Any Approved Notes</label>
	            			<textarea rows="8" class="form-control" name="approvednotes"></textarea>
	            		</div> -->
	            		<div class="form-group">
	            			<button class="btn btn-primary">Submit</button>
	            		</div>
	            	</div>
            	</form>
            </div>
            @if($data->status == 1)
            <div class="card">
            	<div class="card-header">
            		Approved Notes
            	</div>
            	<div class="card-body">
            		{{$data->approvednotes}}
            	</div>
            	
            </div>
            @endif
            @if($data->status == 2)
            <div class="card">
            	<div class="card-header">
            		Rejected Reason
            	</div>
            	<div class="card-body">
            		{{$data->rejectreason}}
            	</div>
            	
            </div>
            @endif
        </div> <!-- end col-->

        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h4>Basic Info :</h4>
                </div>
                <div class="card-body">
                    <div class="text-left">
                        <h4 class="font-13 text-uppercase"></h4>
                        <p class="text-muted mb-2 font-13"><strong>Name :</strong> <span class="ml-2">{{$data->name}}
                                </span></p>
                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{$data->email}}</span></p>

                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
            <div class="card">
                <div class="card-header">
                    <h4 >Further Information</h4>
                </div>
                <div class="card-body">
                    @php
                        $fields = DB::table('signupfields')->where('published_status' , 'published')->where('delete_Status' , 'active')->orderby('order' , 'asc')->get();
                    @endphp

                    @foreach($fields as $r)
                    @if(DB::Table('userfields')->where('signup_parent' , $r->id)->where('user_id' , $data->id)->get()->first())
                    <p class="text-muted mb-2 font-13"><strong>{{ $r->name }} :</strong> <span class="ml-2">   {{ DB::Table('userfields')->where('signup_parent' , $r->id)->where('user_id' , $data->id)->get()->first()->value }}   </span></p>
                    @endif
                    @endforeach
                    
                </div> <!-- end card body -->
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 >Verification</h4>
                </div>
                <div class="card-body">
                    <a target="_blank" href="{{asset('public/images')}}/{{ $data->front_side }}">
                        <img id="myImg" src="{{asset('public/images')}}/{{ $data->front_side }}" alt="Snow" style="width:100%;max-width:300px">
                    </a>
                    <a target="_blank" href="{{asset('public/images')}}/{{ $data->back_side }}">

                         <img id="myImg" src="{{asset('public/images')}}/{{ $data->back_side }}" alt="Snow" style="width:100%;max-width:300px">
                     </a>
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row-->
    
</div> <!-- container -->
@endsection