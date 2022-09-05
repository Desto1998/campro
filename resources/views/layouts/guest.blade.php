<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ "CAMPRO | Authentification" }}</title>

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/logo-camrail.png')}}">
    <!-- Styles -->
    <link href="{{ asset('app.css') }}" rel="stylesheet">
    <link href="{{asset('template/assets/libs/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('template/assets/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link href="{{asset('template/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>
<body class="h-100 mt-5 auth-page">
<!--*******************
       Preloader start
   ********************-->
{{--<div id="preloader">--}}
{{--    <div class="sk-three-bounce">--}}
{{--        <div class="sk-child sk-bounce1"></div>--}}
{{--        <div class="sk-child sk-bounce2"></div>--}}
{{--        <div class="sk-child sk-bounce3"></div>--}}
{{--    </div>--}}
{{--</div>--}}
<!--*******************
    Preloader end
********************-->
{{--<div id="">--}}
@yield('content')
{{--<div id="main-wrapper" class="auth-layout" >--}}

{{--    <main class="">--}}
{{--        --}}
{{--    </main>--}}
{{--</div>--}}

<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{ asset('template/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>

</body>
</html>
