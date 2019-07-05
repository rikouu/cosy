@php
    $navClass = 'navbar navbar-expand-md';
    $logo = '';
    $index_menu_style = 'dark';
    $fixed = $fixed ?? false;
    if ($fixed && isset($index_menu_style) && ($index_menu_style === 'immersed' || $index_menu_style === 'dark' || $index_menu_style == 'image')) {
        $navClass .= ' fixed-top';
        $logo = asset('images/logo-light.png');
    } else {
        $logo = asset('images/logo-dark.png');
    }
    $name = $name ?? Cosy::name();
    $menu = Blog::navigation('top');
@endphp

<header class="header">
    <nav class="{{ $navClass }}">
        <div class="container">
            <a href="{{ url('/') }}" rel="home" class="navbar-brand m-0 order-1">
                @if (!empty($logo))
                    <img src="{{ $logo }}" alt="{{ $name }}">
                @else
                    <span class="text-white text-uppercase h2">{{ $name }}</span>
                @endif
            </a>
            <ul class="nav nav-pills nav-submenu align-items-center flex-row flex-shrink-0 order-2 order-md-3">
                <li class="nav-item">
                    <a href="#" class="nav-link search-popup">
                        <i class="fal fa-search"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('history') }}" class="nav-link">
                        <i class="fal fa-calendar-alt"></i>
                    </a>
                </li>
                <li class="nav-item d-lg-none">
                    <a href="#" id="sidebar-mobile-trigger" class="nav-link pr-0">
                        <i class="fal fa-bars"></i>
                    </a>
                </li>
            </ul>
            <div class="collapse navbar-collapse show navbar-scroll order-3 order-md-2 mx-md-4">
                <ul class="navbar-nav main-menu d-none d-lg-flex mx-auto px-4">
                    @if (!empty($menu) && $menu->isNotEmpty())
                        @foreach($menu->items as $item)
                            @include('components.menu-item', ['menu' => $item])
                        @endforeach
                    @else
                        <li><a href="#">请到 [后台->外观->菜单] 中设置菜单</a></li>
                    @endif
                </ul>
                <ul class="navbar-nav mobile-menu flex-row d-lg-none">
                    @if (!empty($menu) && $menu->isNotEmpty())
                        @foreach($menu->items as $item)
                            @include('components.menu-item', ['menu' => $item])
                        @endforeach
                    @else
                        <li><a href="#">请到 [后台->外观->菜单] 中设置菜单</a></li>
                    @endif
                </ul>
            </div>

        </div>

    </nav>

</header>

{{--<header class="header">--}}
{{--    <nav class="{{ $navClass }}">--}}
{{--        <div class="container">--}}
{{--            <a href="{{ url('/') }}" rel="home" class="navbar-brand m-0 order-1">--}}
{{--                @if (!empty($logo))--}}
{{--                    <img src="{{ $logo }}" alt="{{ $name }}">--}}
{{--                @else--}}
{{--                    <span class="text-white text-uppercase h2">{{ $name }}</span>--}}
{{--                @endif--}}
{{--            </a>--}}

{{--            <ul class="nav nav-pills nav-submenu align-items-center flex-row flex-shrink-0 order-2 order-md-3">--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="#" class="nav-link search-popup"><i class="text-lg far fa-search"></i></a>--}}
{{--                </li>--}}
{{--                <a href="{{ route('history') }}" class="nav-link" target="_blank">--}}
{{--                    <i class="text-lg far fa-calendar-alt"></i>--}}
{{--                </a>--}}
{{--                <li class="nav-item d-lg-none">--}}
{{--                    <a href="#" id="sidebar-mobile-trigger" class="nav-link pr-0">--}}
{{--                        <i class="text-lg far fa-bars"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}

{{--            <div class="collapse navbar-collapse show navbar-scroll order-3 order-md-2 mx-md-4">--}}
{{--                <ul class="navbar-nav main-menu d-none d-lg-flex mx-auto px-4">--}}
{{--                    @if (!empty($menu) && $menu->isNotEmpty())--}}
{{--                        @foreach($menu->items as $item)--}}
{{--                            @include('components.menu-item', ['menu' => $item])--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--                <ul class="navbar-nav mobile-menu flex-row d-lg-none">--}}
{{--                    @if (!empty($menu) && $menu->isNotEmpty())--}}
{{--                        @foreach($menu->items as $item)--}}
{{--                            @include('components.menu-item', ['menu' => $item])--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--            </div>--}}

{{--            <ul class="nav nav-pills nav-submenu align-items-center order-2 order-lg-3">--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="javascript:" class="nav-link search-popup">--}}
{{--                        <i class="text-lg far fa-search"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li class="nav-item d-none d-lg-inline-block">--}}
{{--                    <a href="{{ route('history') }}" class="nav-link" target="_blank">--}}
{{--                        <i class="text-lg far fa-calendar-alt"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item d-lg-none">--}}
{{--                    <a class="nav-link" href="#" id="sidebar-mobile-trigger">--}}
{{--                        <i class="text-lg far fa-bars"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--            @include('partials.search')--}}
{{--            <div class="navbar-collapse navbar-scroll d-lg-none">--}}
{{--                <div class="container">--}}
{{--                    <ul class="navbar-nav flex-row">--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </nav>--}}
{{--</header>--}}

