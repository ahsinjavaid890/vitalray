@extends('admin.layouts.app')


@section('meta-tags')
<title>All News Letters Emails</title>
@endsection


@section('admin-content')


@include('admin.alerts')

<div class="container-fluid">
    <!-- start page title -->
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Newsletters Emails</li>
                    </ol>
                </div>
                <h4 class="page-title">Newsletters Emails</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <!-- end page title -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                     <div >
                        <table class="table table-centered table-bordered w-100 dt-responsive nowrap" id="basic-datatable">
                            <thead  class="thead-light">
                                <tr>
                                    <th >Email</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $r)
                                <tr>
                                    <td>
                                        {{ $r->email }}
                                    </td>
                                      <td class="table-action">
                                        <a onclick="globeldelete({{ $r->id }},'newsletters','id')" href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ url('sendemailsnewsletters') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Subject:</label>
                            <input type="text" placeholder="Enter Subject" required="" name="subject" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>To:</label>
                            <select required="" class="select2 form-control select2-multiple" name="allemails[]" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                            @foreach($data as $r)
                                <option selected="" value="{{ $r->email }}">{{ $r->email }}</option>
                            @endforeach 
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Email Body:</label>
                            <textarea class="form-control" required="" name="emailbody" ></textarea>
                            <script>
                                    CKEDITOR.replace('emailbody');
                            </script>
                        </div>
                        <div class="form-group" style="text-align: right;">
                            <button class="btn btn-primary">Send Emails</button>
                        </div>
                    </form>
                </div> <!-- end card-body-->
            </div>
        
    </div>
    </div>
    <!-- end row -->  
</div>

@endsection