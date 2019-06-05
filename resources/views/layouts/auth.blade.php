<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ mix('css/auth.css') }}" rel="stylesheet">
</head>
<body class="bg-img" style="background-image: url('https://cdn.loyep.com/images/bg.jpg')">
<div id="app">
    @yield('content')
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
