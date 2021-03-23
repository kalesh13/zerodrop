<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-125786747-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-125786747-1');
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>@yield('title')</title>
    <meta name="title" content="@yield('title')"/>
    <meta name="description" content="@yield('description')"/>
    <meta name="keywords" content="@yield('keywords')"/>
    <meta name="robots" content="index, follow"/>

    <!-- Open Graph data -->
    <meta property="og:locale" content="en_US"/>
    <meta property="og:title" content="@yield('title')"/>
    <meta property="og:description" content="@yield('description')"/>
    <meta property="og:keywords" content="@yield('keywords')"/>
    <meta property="og:url" content="@yield('page_url')"/>
    <meta property="og:site_name" content="@yield('page_name')"/>

    <link rel="stylesheet" href="{{mix('/css/app.css')}}" type="text/css" media="all"/>
    @yield('page_top_scripts')
</head>
<body>
    <div id="app">
        @include('layouts.header')
        @yield('page-content')
        @include('layouts.footer')
    </div>
    <script src="{{mix('/js/manifest.js')}}"></script>
    <script src="{{mix('/js/vendor.js')}}"></script>
    <script src="{{mix('/js/app.js')}}"></script>
    @yield('bottom-scripts')
</body>
</html>
