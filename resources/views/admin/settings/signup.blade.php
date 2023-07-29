@extends('admin.layouts.app')
@section('meta-tags')
<title>Sign Up Fields</title>
@endsection
@section('admin-content')
@include('admin.alerts')
<link href="path/to/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet">
<script src="path/to/bootstrap-editable/js/bootstrap-editable.min.js"></script>
<div class="content-page">
    <div class="content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Signup Fields</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Signup Fields</h4>
                    <a data-toggle="modal" data-target="#add-option" title="Add Option" class="btn btn-primary"><i class="mdi mdi-plus"></i> Add Option</a>
                </div>
            </div>
        </div>     
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
                                                <th>Order</th>
                                                <th>Field Title</th>
                                                <th>Field Type</th>
                                                <th>Options</th>
                                                <th>Published</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($data as $r)
                                            <tr>
                                                <td>
                                                    {{$r->order}}
                                                </td>
                                                <td>{{ $r->name }}</td>
                                                <td style="text-transform: capitalize;">{{ $r->type }}</td>
                                                <td>{{ DB::table('signupfieldschilds')->where('signup_parent' , $r->id)->count() }}</td>
                                                <td style="text-transform: capitalize;">
                                                    {{ $r->published_status }}
                                                </td>
                                                
                                                <td>
                                                    <a href="{{ url('admin/settings/editsignupfield') }}/{{ $r->id }}" class="btn btn-primary btn-sm"> <i class="mdi mdi-pencil"></i></a>
                                                    <a onclick="return confirm('Are You Sure You want to Delete This')" href="{{ url('admin/settings/deletesignupfield')}}/{{$r->id}}" class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i></a>
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


<!-- Modal -->
<div class="modal fade" id="add-option" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Option</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" action="{{ url('admin/settings/cretesignup') }}" class="mb-2">
             {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="lable-control">Field Tittle</label>
                        <input type="text" class="form-control" placeholder="Enter title" name="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="lable-control">Field Type</label> <small style="color: red;">(Please Select Carefully You Can't Update once Field Type is created)</small>
                        <select onchange="checkfield(this.value)" required class="form-control" name="type">
                            <option value="">Chose Type</option>
                            <option value="text">Text</option>
                            <option value="select">Select</option>
                            <option value="textarea">Textarea</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="radio">Radio Buttons</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="lable-control">Is Required?</label>
                        <select required class="form-control" name="isrequired">
                            <option value="">Chose Type</option>
                            <option value="yes">Required</option>
                            <option value="no">Not Required</option>
                        </select>
                    </div>
                </div>
            </div>
            <div style="display: none;margin-bottom:20px;" class="multi-field-wrapper">
              <div class="multi-fields">
                <div style="margin-bottom:20px;" class="multi-field">
                  <input style="width: 91%;padding: 0.45rem 0.9rem;font-size: .9rem;font-weight: 400;line-height: 1.5;color: #6c757d;background-color: #fff;background-clip: padding-box;border: 1px solid #dee2e6;border-radius: 0.25rem;" type="text" name="signupfieldschilds[]">
                  <button type="button" class="remove-field btn btn-danger">-</button>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12 text-right">
                      <button type="button" class="add-field btn btn-primary">+</button>
                  </div>
              </div>
                
          </div>


            <div class="row">
                <div class="col-md-12 text-right">
                    <button id="submitbutton" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
           
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    function checkfield(id)
    {

        if(id == 'checkbox')
        {
            $('.multi-field-wrapper').show();
        }else{

            



            if(id == 'radio')
            {
                $('.multi-field-wrapper').show();
            }else{
                if(id == 'select')
                {
                    $('.multi-field-wrapper').show();
                }else{
                    $('.multi-field-wrapper').hide();
                }
            }
        }
    }
    $('.multi-field-wrapper').each(function() {
    var $wrapper = $('.multi-fields', this);
    $(".add-field", $(this)).click(function(e) {
        $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
    });
    $('.multi-field .remove-field', $wrapper).click(function() {
        if ($('.multi-field', $wrapper).length > 1)
            $(this).parent('.multi-field').remove();
    });
});
</script>
@endsection