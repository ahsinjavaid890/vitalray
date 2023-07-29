@extends('admin.layouts.app')


@section('meta-tags')
<title>Dynamic Menus</title>
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
                        <li class="breadcrumb-item active">Menus</li>
                    </ol>
                </div>
                <h4 class="page-title">Dynamic Menus</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
						<div class="col-md-6">
							<form action="{{ route('menus.store')}}" method="POST">
		                        @csrf
		                         @if(count($errors) > 0)
		                                  <div class="alert alert-danger  alert-dismissible">
		                                      <button type="button" class="close" data-dismiss="alert">×</button>
		                                      @foreach($errors->all() as $error)
		                                              {{ $error }}<br>
		                                      @endforeach
		                                  </div>
		                              @endif
		                        <div class="row">
		                           <div class="col-md-12">
		                              <div class="form-group">
		                                 <label>Title</label>
		                                 <input type="text" name="title" class="form-control">   
		                              </div>
		                           </div>
		                        </div>
		                        <div class="row">
		                           <div class="col-md-12">
		                              <div class="form-group">
		                                 <label>Url</label>
		                                 <div class="input-group mb-3">
										    <div class="input-group-prepend">
										      <span class="input-group-text">{{ url('') }}</span>
										    </div>
										    <input type="text" class="form-control" name="url" placeholder="Enter URL">
										  </div>
		                              </div>
		                           </div>
		                        </div>
		                        <div class="row">
		                           <div class="col-md-12">
		                              <div class="form-group">
		                                 <label>Parent</label>
		                                 <select class="form-control" name="parent_id">
		                                    <option selected disabled>Select Parent Menu</option>
		                                    @foreach($allMenus as $r)
		                                       <option value="{{ $r->id }}">{{ $r->title}}</option>
		                                    @endforeach
		                                 </select>
		                              </div>
		                           </div>
		                        </div>
		                        <div class="row">
		                           <div class="col-md-12">
		                              <button class="btn btn-success">Save</button>
		                           </div>
		                        </div>
		                     </form>
						</div>              
						<div class="col-md-6">
							<ul id="tree1">
		                         @foreach($menus as $menu)
		                            <li>
		                            	<div style="margin-bottom: 10px;" class="row">
		                            		<div class="col-md-10">
		                            			 {{ $menu->title }}
		                            		</div>
		                            		<div class="col-md-2">
		                            			<i onclick="updatemenu({{$menu->id}})" class="mdi mdi-square-edit-outline btn btn-success btn-sm"></i>
		                            		</div>
		                            	</div>
		                               
		                                @if(count($menu->childs))
		                                    @include('admin.menu.manageChild',['childs' => $menu->childs])
		                                @endif
		                            </li>
		                         @endforeach
		                    </ul>
						</div>      	
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div> <!-- container -->

<script type="text/javascript">
	function updatemenu(id)
	{
		$.ajax({
            type: "GET",
            url: '{{url("admin/getmenu/")}}/'+id,
            success: function(resp) {
                
            	$('#updateform').html(resp)
            	$('#myModal').modal('show');
            }
        });
	}
</script>

<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Menu</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
<form action="{{ url('admin/updatemenu')}}" method="POST">
    @csrf
      <!-- Modal body -->
      <div id="updateform" class="modal-body">
        








      </div>

     </form>

    </div>
  </div>
</div>


@endsection