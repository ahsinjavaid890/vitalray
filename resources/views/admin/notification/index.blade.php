@extends('admin.layouts.app')

 
@section('meta-tags')
<title>Notification | Admin</title>
@endsection


@section('admin-content')
             <!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Notifications</span></h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Notification</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $r)
                            <tr @if($r->status == 1) style="background-color:#c3c7d5; "@endif>
                                <td>{{Cmf::date_format($r->created_at)}}</td>
                                <td>{{ $r->notification }}</td>
                                <td><a target="_blank" onclick="statuschange({{$r->id}})" class="btn btn-primary btn-sm" href="{{ $r->url }}">View</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="pagination" style="margin-top: 50px;">
                        {!! $data->links('admin.pagination') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- container -->
@endsection