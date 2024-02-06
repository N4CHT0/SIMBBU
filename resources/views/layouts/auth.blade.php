<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('AUTH/css/styles.min.css')}}"/>
</head>
<body>
    @yield('content')
    <script src="{{ asset('AUTH/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('AUTH/js/app.min.js')}}"></script>
    <script src="{{ asset('AUTH/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
    <script src="{{ asset('AUTH/libs/simplebar/dist/simplebar.js')}}"></script>
    <script src="{{ asset('AUTH/js/dashboard.js')}}"></script>
</body>
</html>
