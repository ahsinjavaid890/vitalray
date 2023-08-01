<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('title')
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/front/media/favicon.png')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />


    <!-- <link rel="stylesheet" href="{{ asset('public/front/dependencies/icofont/icofont.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/dependencies/slick-carousel/css/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/dependencies/slick-carousel/css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/dependencies/magnific-popup/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/dependencies/sal.js/sal.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/front/dependencies/select2/css/select2.min.css')}}" type="text/css"> -->


    <script src="{{ asset('public/front/dependencies/jquery/js/jquery.min.js')}}"></script>
    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="{{ asset('public/front/assets/css/app.css')}}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body class="sticky-header">
    @include('admin.alerts')
    @yield('content')
</body>

<script src="{{ asset('public/front/dependencies/popper.js/js/popper.min.js')}}"></script>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
<!-- <script src="{{ asset('public/front/dependencies/imagesloaded/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{ asset('public/front/dependencies/isotope-layout/js/isotope.pkgd.min.js')}}"></script>
<script src="{{ asset('public/front/dependencies/slick-carousel/js/slick.min.js')}}"></script>
<script src="{{ asset('public/front/dependencies/sal.js/sal.js')}}"></script> -->
<script src="{{ asset('public/front/dependencies/magnific-popup/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{ asset('public/front/dependencies/bootstrap-validator/js/validator.min.js')}}"></script>
<script src="{{ asset('public/front/dependencies/select2/js/select2.min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtmXSwv4YmAKtcZyyad9W7D4AC08z0Rb4"></script>

<!-- Site Scripts -->
<script src="{{ asset('public/front/assets/js/app.js')}}"></script>
@yield('page-scripts')
</html>