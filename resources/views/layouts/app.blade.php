<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    {!!  Cosy::seo()->generate() !!}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title', Theme::title())</title>
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="cosy-style-shadow">
<div id="app">
    @include('commons.header')
        @yield('content')
    @include('commons.footer')
</div>
<script src="{{ mix('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
