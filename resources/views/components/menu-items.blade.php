@foreach($items as $item)
    <li class="menu-item {{ $item->hasChildren() ? 'menu-item-has-children ' : '' }}px-1">
        <a class="nav-link" href="{{ $item->getLink() }}">{{ $item->title }}</a>
        @if ($item->hasChildren())
            <ul class="sub-menu">
                @include('components.menu-items', ['items' => $item->menus])
            </ul>
        @endif
    </li>
@endforeach
