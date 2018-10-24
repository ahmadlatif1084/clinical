<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    @include('layouts.head')
    @yield('extra_css')
</head>
<body>

    @yield('content')
    <!-- Scripts -->
    {{--<script src="{{ asset('public/js/app.js') }}"></script>--}}
        <!--======================================================== Footer JS Files =========================================================-->
        @include('layouts.footer_script')

        <!--======================================================== Extra JS Files =========================================================-->
        @yield('extra_js')

        <!--======================================================== Script =========================================================-->
        @yield('script')
</body>
</html>
