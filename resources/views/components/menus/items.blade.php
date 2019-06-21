@foreach($items as $item)
    <li class="menu-item{{ $item->hasChildren() ? ' menu-item-has-children ' : '' }} pl-2 pr-1">
        <a class="nav-link" href="{{ $item->getLink() }}">{{ $item->getName() }}
            @if ($item->hasChildren())
                <span class="sub-menu-icon text-xs iconfont icon-down"></span>
            @endif
        </a>
        @if ($item->hasChildren())
            <ul class="sub-menu">
                @include('components.menus.items', ['items' => $item->menus])
            </ul>
        @endif
    </li>
@endforeach
