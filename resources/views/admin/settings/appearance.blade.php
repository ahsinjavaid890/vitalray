@extends('admin.layouts.app')


@section('meta-tags')
<title>Dashboard</title>
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
                        <li class="breadcrumb-item active">Appearance</li>
                    </ol>
                </div>
                <h4 class="page-title">Website Settings</h4>
            </div>
        </div>
    </div>
    <div class="row">


        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#default-tooltips-preview" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                Genral Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#default-tooltips-code" data-toggle="tab" aria-expanded="true" class="nav-link">
                                Logos and Fav Icons
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#globalseo" data-toggle="tab" aria-expanded="true" class="nav-link">
                                Global SEO
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#permissions" data-toggle="tab" aria-expanded="true" class="nav-link">
                                Permissions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#social" data-toggle="tab" aria-expanded="true" class="nav-link">
                                Social Media
                            </a>
                        </li>
                    </ul> <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="default-tooltips-preview">
                            <form action="{{ route('admin_settings_appearance_update') }}" enctype='multipart/form-data' method="POST">
                               @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Frontend Website Name</label>
                                    <div class="col-md-8">
                                        
                                        <input type="text" name="website_name" class="form-control" placeholder="Website Name" value="{{$settings->site_name}}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Site Motto</label>
                                    <div class="col-md-8">

                                        <input type="text" name="site_motto" class="form-control" placeholder="Best eCommerce Website" value="{{$settings->site_moto}}   " />
                                    </div>
                                </div>
                                

                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Site Emal</label>
                                    <div class="col-md-8">
                                        <input type="text" name="site_email" class="form-control"  value="{{$settings->site_email}}" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Site phone number</label>
                                    <div class="col-md-8">
                                        <input type="text" name="site_phonenumber" class="form-control"  value="{{$settings->site_phonenumber}}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Site Fax</label>
                                    <div class="col-md-8">
                                        <input type="text" name="site_fax" class="form-control"  value="{{$settings->site_fax}}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Site Address</label>
                                    <div class="col-md-8">
                                        <input type="text" name="site_address" class="form-control"  value="{{$settings->site_address}}" />
                                    </div>
                                </div>


                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div> <!-- end preview-->
                        <style type="text/css">
                            .imageshow{
                                width: 200px;
                                height: 200px;
                            }
                            .imageshow img{
                                width: 100%;
                                height: 100%;
                            }
                        </style>
                        <div class="tab-pane" id="default-tooltips-code">
                            <form action="{{ url('admin/settings/updatelogos') }}" enctype='multipart/form-data' method="POST">
                               @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Site Header Logo</label>
                                    <div class="col-md-8">
                                        <div class="input-group" data-toggle="aizuploader" data-type="header_logo">
                                            <input type="file" class="form-control" name="header_logo">
                                        </div>

                                        <div class="imageshow">
                                            <img src="{{ url('public/images') }}/{{ Cmf::get_store_value('header_logo') }}">
                                        </div>

                                        <br>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Site Footer Logo</label>
                                    <div class="col-md-8">
                                        <div class="input-group" data-toggle="aizuploader" data-type="footer_logo">
                                            <input type="file" class="form-control" name="footer_logo">
                                        </div>
                                        <div class="imageshow">
                                            <img src="{{ url('public/images') }}/{{ Cmf::get_store_value('footer_logo') }}">
                                        </div>
                                        <br>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Site Fav Icon</label>
                                    <div class="col-md-8">
                                        <div class="input-group" data-toggle="aizuploader" data-type="favicon">
                                            <input type="file" class="form-control" name="favicon">
                                        </div>
                                        <div class="imageshow">
                                            <img src="{{ url('public/images') }}/{{ Cmf::get_store_value('favicon') }}">
                                        </div>
                                        <br>
                                        <small class="text-muted">Website favicon. 32x32 .png</small>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div> <!-- end preview code-->
                        <div class="tab-pane" id="globalseo">
                            <form action="{{ route('admin_settings_seo') }}" method="POST" enctype="multipart/form-data">
                                 @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Meta Title</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" placeholder="Title" name="metta_tittle" value="{{ Cmf::get_store_value('metta_tittle') }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Meta description</label>
                                    <div class="col-md-8">
                                        <textarea class="resize-off form-control" placeholder="Description" name="meta_description">{{ Cmf::get_store_value('metta_description') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">Keywords</label>
                                    <div class="col-md-8">
                                        <textarea class="resize-off form-control" placeholder="Keyword, Keyword" name="meta_keywords">{{ Cmf::get_store_value('metta_keywords') }}</textarea>
                                        <small class="text-muted">Separate with coma</small>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="permissions">
                            <form method="POST" action="{{ url('admin/vendorsettingsupdate') }}">
                             {{ csrf_field() }}
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title pt-1">Auto Approve Users</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-md-9">
                                                    <p>Auto Approve Users</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="checkbox" name="vendor_pending_to_approve" id="switch1" 
                                                    @if(Cmf::get_store_value('vendor_pending_to_approve') == 'on')
                                                    checked @endif data-switch="bool"/>
                                                    <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                                </div>
                                            </div>
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card-->
                                </div> <!-- end col -->        
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="tab-pane" id="social">
                            <form method="POST" action="{{ url('admin/socialmedia') }}">
                             {{ csrf_field() }}
                                
                             <div class="form-group">
                                 <label>Facebook</label>
                                 <input value="{{ Cmf::get_store_value('facebook') }}" type="text" name="facebook" class="form-control">
                             </div>
                             <div class="form-group">
                                 <label>Twitter</label>
                                 <input value="{{ Cmf::get_store_value('twitter') }}" type="text" name="twitter" class="form-control">
                             </div>
                             <div class="form-group">
                                 <label>Instagram</label>
                                 <input value="{{ Cmf::get_store_value('instagram') }}" type="text" name="instagram" class="form-control">
                             </div>
                             <div class="form-group">
                                 <label>Youtube</label>
                                 <input value="{{ Cmf::get_store_value('youtube') }}" type="text" name="youtube" class="form-control">
                             </div>


                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div> <!-- end tab-content-->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div>

    </div>
    
    
</div> <!-- container -->
@endsection