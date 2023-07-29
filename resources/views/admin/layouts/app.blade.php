<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  @yield('meta-tags')
  <!-- Stylesheets -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,900&amp;display=swap" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/icons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/app.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/vendor/buttons.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/vendor/select.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/vendor/summernote-bs4.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/admin/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

  <script src="{{ asset('public/admin/js/vendor.min.js') }}" type="text/javascript"></script>
  

  <input type="hidden" value="{{ url('') }}" id="mainurl">
  <!-- Responsive -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <script src="{{ asset('public/admin/js/app.min.js') }}" type="text/javascript"></script>
  <!-- <script src="{{ asset('public/admin/js/driver.js') }}" type="text/javascript"></script> -->



  <link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


</head>
  <body class="loading" data-layout="detached" data-layout-config='{"leftSidebarCondensed":false,"darkMode":true, "showRightSidebarOnStart": true}'>
    <div id="wholebodyloader" class=""></div>
        @include('admin.includes.navbar')
        
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- Begin page -->
            <div class="wrapper">

                @include('admin.includes.sidebar')
                
                @yield('admin-content')


            </div> <!-- end wrapper-->
        </div>
        <!-- END Container -->
        
    </body>
  <script src="{{ asset('public/admin/js/vendor/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/admin/js/vendor/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/admin/js/app.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/pages/demo.datatable-init.js')}}"></script>
  <script src="{{ asset('public/admin/js/vendor/summernote-bs4.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/pages/demo.summernote.js')}}"></script>
  <script src="{{ asset('public/admin/js/vendor/dropzone.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/ui/component.fileupload.js')}}"></script>
  <script src="{{ asset('public/admin/js/pages/demo.typehead.js')}}"></script>
  <script src="{{ asset('public/admin/js/vendor/typeahead.bundle.min.js')}}"></script>
  <script src="{{ asset('public/admin/js/vendor/handlebars.min.js')}}"></script>
  <script src="{{asset('public/admin/assets/js/driver.js')}}"></script>
  <script src="{{asset('public/admin/plugins/jszip/jszip.min.js')}}"></script>
  <script src="{{asset('public/admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{asset('public/admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
  <script src="{{asset('public/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{asset('public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('public/admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('public/admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{asset('public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
</html>
@yield('after_script')