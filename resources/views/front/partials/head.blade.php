<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title></title>
<meta name="description" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">

<style>
    .preloader{
        position: fixed;
        top: 0;
        left: 0;
        z-index: 999999;
        width: 100%;
        height: 100%;
        background-color: #fff;
        background-image: url({{ asset('assets/images/Preloader_7.gif') }});
        background-repeat: no-repeat;
        background-position: center center;
    }
</style>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|Playfair+Display:400,400italic,700,700italic,900,900italic;subset=cyrillic">

<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/fontawesome/css/fontawesome-all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.theme.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.transitions.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/cs-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/freepik.hotels.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/nivo-lightbox.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/nivo-lightbox-theme.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<link rel="stylesheet" href="{{ asset('css/front.css') }}">

<script src="{{ asset('assets/js/modernizr.custom.min.js') }}"></script>

@yield('styles')