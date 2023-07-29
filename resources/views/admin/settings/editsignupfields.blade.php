@extends('admin.layouts.app')
@section('meta-tags')
<title>Edit Sign Up Fields</title>
@endsection
@section('admin-content')
@include('admin.alerts')
<div class="content-page">
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/settings/signup')}}">Sign up Fields</a></li>
                            <li class="breadcrumb-item active">Edit Sign Up Fields</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>     
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form method="post" action="{{ url('admin/settings/updatesignup') }}" class="mb-2">
                                 {{ csrf_field() }}
                                 <input type="hidden" value="{{ $data->id }}" name="id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="lable-control">Field Tittle</label>
                                            <input type="text" value="{{ $data->name }}" class="form-control" placeholder="Enter title" name="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="lable-control">Field Order</label>
                                            <input type="text" value="{{ $data->order }}" class="form-control" placeholder="Enter title" name="order">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="lable-control">Is Required?</label>
                                            <select required class="form-control" name="isrequired">
                                                <option value="">Chose Type</option>
                                                <option @if($data->isrequired == 'yes') selected @endif value="yes">Required</option>
                                                <option @if($data->isrequired == 'no') selected @endif value="no">Not Required</option>
                                            </select>
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
            </div> 
            @if($data->type == 'select' || $data->type == 'checkbox' || $data->type == 'radio')
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Signup Child Fields of {{ $data->name }}
                    </div>
                    <div class="card-body">
                        @foreach(DB::table('signupfieldschilds')->where('signup_parent' , $data->id)->get() as $r)
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input id="chieldfield{{ $r->id }}" type="text" value="{{ $r->name }}" class="form-control" placeholder="Enter title" name="name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <a onclick="updatefield({{ $r->id }})" class="btn btn-primary">Update</a>
                                <a onclick="return confirm('Are You Sure You want to Delete This')" href="{{ url('admin/settings/deletechildsignup') }}/{{ $r->id }}" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <form method="POST" action="{{ url('admin/settings/addnewchildfields') }}">
                    {{ csrf_field() }}
                    <input type="hidden"  name="id" value="{{ $data->id }}">
                <div class="card">
                    <div class="card-header">
                       Add New Signup Child Fields of {{ $data->name }}
                    </div>
                    <div class="card-body">
                         <div style="margin-bottom:20px;" class="multi-field-wrapper">
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
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
                </form>
            </div>
            @endif
        </div>
    </div> 
</div>
<script type="text/javascript">
    function updatefield(id)
    {
        var value = $('#chieldfield'+id).val();
        var updateurl = '{{ url("admin/settings") }}';
        $.ajax({
            type: "GET",
            url: updateurl+'/updatesignupfield/'+id+'/'+value,
            success: function(resp) {
                location.reload();
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