@foreach($items as $item)
    <li class="menu-item{{ $item->hasChildren() ? ' menu-item-has-children' : '' }}px-1">
        <a class="nav-link" href="{{ $item->getLink() }}">{{ $item->title }}
            @if ($item->hasChildren())
                <span class="sub-menu-icon text-xs iconfont icon-down"></span>
            @endif
        </a>
        @if ($item->hasChildren())
            <ul class="sub-menu">
                @include('components.menu-items', ['items' => $item->menus])
            </ul>
        @endif
    </li>
@endforeach
