@if(session()->has('message'))
<style type="text/css">
  .toastr-container ul li{
    width: 100% !important;
  }
</style>
<link rel="stylesheet" href="{{ url('public/front/toaster/css/toastr.min.css?v1.0') }}">
<script src="{{ url('public/front/toaster/js/toastr.min.js?v1.0') }}"></script>
<script type="text/javascript">
    $( document ).ready(function() {
      $(function () {
          $.toastr.config({
            time: 5000
          });
          $.toastr.success('{{ session()->get('message') }}', {position: 'top-right'});
        })
    });
</script>
@endif 
@if(session()->has('warning'))
<style type="text/css">
  .toastr-container ul li{
    width: 100% !important;
  }
</style>
<link rel="stylesheet" href="{{ url('public/front/toaster/css/toastr.min.css?v1.0') }}">
<script src="{{ url('public/front/toaster/js/toastr.min.js?v1.0') }}"></script>
<script type="text/javascript">
    $( document ).ready(function() {
      $(function () {
          $.toastr.config({
            time: 5000
          });
          $.toastr.warning('{{ session()->get('warning') }}', {position: 'top-right'});
        })
    });
</script>
@endif
