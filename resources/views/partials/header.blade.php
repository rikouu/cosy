@php
    $navClass = '';
    $logo = '';
    $index_menu_style = 'dark';
    $fixed = $fixed ?? false;
    if ($fixed && isset($index_menu_style) && ($index_menu_style === 'immersed' || $index_menu_style === 'dark' || $index_menu_style == 'image')) {
        $navClass = 'fixed-top';
        $logo = asset('images/logo-light.png');
    } else {
        $logo = asset('images/logo-dark.png');
    }
    $name = $name ?? Cosy::name();
    $menu = Theme::navigation('top');
@endphp
<header class="header">
    <nav class="{{ $navClass }}">
        <div class="navbar navbar-expand-lg">
            <div class="container">
                <a href="{{ url('/') }}" rel="home" class="navbar-brand m-0 order-1 order-lg-1">
                    @if (!empty($logo))
                        <img src="{{ $logo }}" alt="{{ $name }}">
                    @else
                        <span class="text-white text-uppercase h2">{{ $name }}</span>
                    @endif
                </a>
                <div class="collapse navbar-collapse order-lg-2">
                    <ul class="navbar-nav main-menu mx-auto px-4">
                        @if (!empty($menu) && $menu->isNotEmpty())
                            @foreach($menu->items as $item)
                                @include('components.menu-item', ['menu' => $item])
                            @endforeach
                        @endif
                    </ul>
                </div>
                <ul class="nav nav-pills nav-submenu align-items-center order-2 order-lg-3">
                    <li class="nav-item">
                        <a href="javascript:" class="nav-link search-popup">
                            <i class="text-lg far fa-search"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-lg-inline-block">
                        <a href="{{ route('history') }}" class="nav-link" target="_blank">
                            <i class="text-lg far fa-calendar-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link" href="#" id="sidebar-mobile-trigger">
                            <i class="text-lg far fa-bars"></i>
                        </a>
                    </li>
                </ul>
                @include('partials.search')
            </div>
        </div>
        <div class="navbar-collapse navbar-scroll d-lg-none">
            <div class="container">
                <ul class="navbar-nav flex-row">
                    <?php
                    //                    if ( function_exists( 'wp_nav_menu' ) && has_nav_menu('menu-3') ) {
                    //                        wp_nav_menu( array( 'container' => false, 'items_wrap' => '%3$s', 'theme_location' => 'menu-3', 'depth' => 1 ) );
                    //                    } else {
                    //                        _e('<li><a href="/wp-admin/nav-menus.php">Please set up your first menu at [Admin -> Appearance -> Menus]</a></li>', 'cosy19');
                    //                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

