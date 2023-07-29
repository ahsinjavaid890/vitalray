@extends('admin.layouts.app')


@section('meta-tags')
<title>All Quizes Fields</title>
@endsection
@section('admin-content')
@include('admin.alerts')
<div class="content-page">
    <div class="content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">All Quizes Fields</li>
                        </ol>
                    </div>
                    <h4 class="page-title">All Quizes Fields</h4>
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
                                    <table  class="table dt-responsive nowrap w-100 table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Field Title</th>
                                                <th>Field Type</th>
                                                <th>Options</th>
                                                <th>Published</th>
                                                <th>Order</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($data as $r)
                                            <tr>
                                                <td>{{ $r->name }}</td>
                                                <td style="text-transform: capitalize;">{{ $r->type }}</td>
                                                <td>
                                                    @foreach(DB::table('quizefields')->where('quiz_parent' , $r->id)->get() as $q)
                                                    {{ $q->name }} @if($loop->last) @else , @endif
                                                    @endforeach

                                                </td>
                                                <td style="text-transform: capitalize;">
                                                    {{ $r->published_status }}
                                                </td>
                                                <td>
                                                    {{$r->order}}
                                                </td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#add-option{{ $r->id }}" class="btn btn-primary btn-sm"> <i class="mdi mdi-pencil"></i></a>
                                                    <a onclick="return confirm('Are You Sure You want to Delete This')" href="{{ url('admin/quizes/deletequesquestion')}}/{{$r->id}}" class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i></a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="add-option{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add New Quiz Question</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">

                                                        <form method="post" action="{{ url('admin/quizes/create') }}" class="mb-2">
                                                             {{ csrf_field() }}
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="lable-control">Quiz Tittle</label>
                                                                        <input value="{{ $r->name }}" required type="text" class="form-control" placeholder="Enter title" name="name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="lable-control">Quiz Type</label>
                                                                        <select onchange="checkfield(this.value)" required class="form-control" name="type">
                                                                            <option value="">Chose Type</option>
                                                                            <option @if($r->type == 'text') selected @endif value="text">Text</option>
                                                                            <option @if($r->type == 'select') selected @endif value="select">Select</option>
                                                                            <option @if($r->type == 'textarea') selected @endif value="textarea">Textarea</option>
                                                                            <option @if($r->type == 'checkbox') selected @endif value="checkbox">Checkbox</option>
                                                                            <option @if($r->type == 'radio') selected @endif value="radio">Radio Buttons</option>
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
                                                                            <option @if($r->isrequired == 'yes') selected @endif value="yes">Required</option>
                                                                            <option @if($r->isrequired == 'no') selected @endif value="no">Not Required</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="lable-control">Order</label>
                                                                        <input value="{{$r->order}}" required type="number" class="form-control" placeholder="Enter This Field Order" name="order">
                                                                        <span class="text-danger" id="orderalert"></span>
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
        <h5 class="modal-title" id="exampleModalLabel">Add New Quiz Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" action="{{ url('admin/quizes/create') }}" class="mb-2">
             {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="lable-control">Quiz Tittle</label>
                        <input required type="text" class="form-control" placeholder="Enter title" name="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="lable-control">Quiz Type</label>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="lable-control">Order</label>
                        <input onkeyup="checkorderofquiz(this.value)" required type="number" class="form-control" placeholder="Enter This Field Order" name="order">
                        <span class="text-danger" id="orderalert"></span>
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
    function checkorderofquiz(id) {
        var app_url = '{{ url("") }}';
        $.ajax({
            type: "GET",
            url: app_url+'/admin/quizes/checkorderofquiz/'+id,
            success: function(resp) {
                if(resp > 0)
                {
                    $('#orderalert').html('This Quiz Order is Alread Taken Please Change Order befor Procede Next');
                    $('#submitbutton').attr('disabled' , true);
                }else{
                    $('#orderalert').html('');
                    $('#submitbutton').attr('disabled' , false);
                }
            }
        });
    }
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