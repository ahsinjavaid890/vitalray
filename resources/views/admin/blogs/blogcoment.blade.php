@extends('admin.layouts.app')

 
@section('meta-tags')
<title>Blog Coments</title>
@endsection


@section('admin-content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Blog Comments</li>
                    </ol>
                </div>
                <h4 class="page-title">Blog Comments</h4>
            </div>
        </div>
    </div>
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('message') }}
        </div>
    @endif
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Blog</th>
                                <th>Coment Status</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Dated</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $r)
                            <tr @if($r->newstatus == 'new') style="background-color:#d0f2d0;" @endif>
                                <td>
                                    @if(!empty(DB::table('blogs')->where('id' , $r->blogs)->get()->first()->url))
                                    <a target="_blank" href="{{ url('blog') }}/{{ DB::table('blogs')->where('id' , $r->blogs)->get()->first()->url }}">{!! Str::limit(DB::table('blogs')->where('id' , $r->blogs)->get()->first()->name, 25) !!}</a>
                                    @endif
                                </td>
                                <td>{{ $r->visible_status }}</td>
                                <td>
                                    @if(!empty($r->users))
                                    {{ DB::table('users')->where('id' , $r->users)->get()->first()->name }}
                                    @else
                                    {{ $r->name }}
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($r->users))
                                    {{ DB::table('users')->where('id' , $r->users)->get()->first()->email }}
                                    @else
                                    {{ $r->email }}
                                    @endif
                                </td>
                                <td>{{ date('d M Y, h:s a ', strtotime($r->created_at)) }}</td>
                                <td class="table-action text-center">
                                    <a href="{{url('admin/editblogcoment')}}/{{ $r->id }}" class="action-icon" title="Edit Coment"> <i class="mdi mdi-eye"></i></a>
                                    <a href="{{url('admin/editblogcoment')}}/{{ $r->id }}" class="action-icon" title="Edit Coment"> <i class="mdi mdi-pencil"></i></a>
                                    <a onclick="return confirm('Are You Sure You want to Delete This')" href="{{url('admin/deleteblogcoment')}}/{{ $r->id }}" class="action-icon" title="Delte Category"> <i class="mdi mdi-delete"></i></a>
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
@endsection