<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div id="loader"></div>
<div class="flex-center position-ref full-height" id="app">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ Cosy::path()  }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            Laravel
        </div>
        <p>Laravel是一套简洁、优雅的PHP Web开发框架。今天出去买菜花了5000元。我家的光纤入屋宽频有 10Gbps，SSD 一共有 20TB</p>
        <pre>
            <code class="language-php">
                let mix = require('laravel-mix');
                mix.js('resources/js/app.js', 'public/js')
                .sass('resources/sass/app.scss', 'public/css');
            </code>
        </pre>
        <p>然后你可以移动目录并使用以下命令进行清理：</p>
        <pre>
            <code class="language-bash">
                mv resources/assets/* resources
                rm -rf resources/assets/
            </code>
        </pre>
        <div class="links">
            <a href="https://laravel.com/docs">Docs</a>
            <a href="https://laracasts.com">Laracasts</a>
            <a href="https://laravel-news.com">News</a>
            <a href="https://blog.laravel.com">Blog</a>
            <a href="https://nova.laravel.com">Nova</a>
            <a href="https://forge.laravel.com">Forge</a>
            <a href="https://github.com/laravel/laravel">GitHub</a>
        </div>
    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
