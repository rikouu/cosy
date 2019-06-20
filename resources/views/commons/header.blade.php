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
    $mainMenu = Theme::navigation('main');
    $mobileMenu = Theme::navigation('mobile');
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
                    <a href="javascript:" class="nav-link search-popup">
                        <i class="text-lg iconfont icon-search"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('history') }}" class="nav-link">
                        <i class="iconfont icon-time"></i>
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
                    {!! $mainMenu !!}
{{--                    @if (!empty($menu) && $menu->isNotEmpty())--}}
{{--                        @foreach($menu->items as $item)--}}
{{--                            @include('components.menu-item', ['menu' => $item])--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
                </ul>
                <ul class="navbar-nav mobile-menu flex-row d-lg-none">
{{--                    {!! $mobileMenu !!}--}}
{{--                @if (!empty($menu) && $menu->isNotEmpty())--}}
{{--                        @foreach($menu->items as $item)--}}
{{--                            @include('components.menu-item', ['menu' => $item])--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
                </ul>
            </div>
        </div>
    </nav>
</header>

