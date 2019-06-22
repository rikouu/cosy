<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    {!!  Cosy::seo()->generate() !!}
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title', Blog::title())</title>
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ cdnMix('css/app.css') }}" rel="stylesheet" type="text/css" media="all">
    @stack('styles')
</head>
<body class="cosy-style-shadow">
<div id="app">
    @include('commons.header')
        @yield('content')
    @include('commons.footer')
</div>
<script type="text/javascript" src="{{ cdnMix('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
