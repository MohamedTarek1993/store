<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <title>Document</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link  rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">


</head>

<body>


    <!--============================
        MENU START
    =============================-->
    @include('layouts.navbar')
    <!--============================
        MENU END
    =============================-->

   {{ $slot }}
    <!--============================   


        FOOTER START
    =============================-->
   @include('layouts.footer')
    <!--============================
        FOOTER END
    =============================-->


    <!--jquery library js-->
   
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

    <!--bootstrap js-->
    <script src="{{  asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!--font-awesome js-->
    <script src="{{  asset('assets/js/Font-Awesome.js') }}"></script>

    <script src="{{  asset('assets/js/slick.min.js') }}"></script>

    <script src="{{  asset('assets/js/select2.min.js') }}"></script>


   
    <!--main/custom js-->
    <script src="{{  asset('assets/js/main.js') }}"></script>

    <script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}"></script>


    {{ $scripts ?? '' }}
</body>

</html>