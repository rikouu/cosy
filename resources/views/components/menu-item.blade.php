@php
    $items = $menu->menus;
    $hasItems = $items->isNotEmpty();
@endphp

<li class="menu-item {{ $hasItems ? 'menu-item-has-children ' : '' }}px-1">
    <a class="nav-link" href="{{ $menu->getLink() }}">{{ $menu->title }}</a>
    @if ($hasItems)
        <ul class="sub-menu">
            @foreach($items as $item)
                @include('components.menu-item', ['menu' => $item])
            @endforeach
        </ul>
    @endif
</li>
