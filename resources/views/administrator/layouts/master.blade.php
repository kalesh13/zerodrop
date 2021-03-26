<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, follow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{mix('/css/app.css')}}" type="text/css" media="all"/>

    @yield('page_top_scripts')
</head>
<body>
<div id="admin-app">
    @yield('content')
</div>
<script src="{{mix('/js/manifest.js')}}"></script>
<script src="{{mix('/js/vendor.js')}}"></script>
<script src="{{mix('/js/admin_app.js')}}"></script>
@yield('page_bottom_scripts')
</body>
</html>
