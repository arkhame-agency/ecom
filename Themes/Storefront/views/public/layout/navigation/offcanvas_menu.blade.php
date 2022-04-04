<li class="offcanvas__menu_li">
    <a class="offcanvas__menu_item" href="{{ $menu->url() }}" target="{{ $menu->target() }}">
        {{ $menu->name() }}
    </a>
    @if ($menu->subMenus()->isNotEmpty())
        <ul class="offcanvas__sub_menu">
            @foreach ($menu->subMenus() as $subMenu)
                <li class="offcanvas__sub_menu_li">
                    <a href="{{ $subMenu->url() }}" target="{{ $subMenu->target() }}" class="offcanvas__sub_menu_item">
                        {{ $subMenu->name() }}
                    </a>
                    @if ($subMenu->items()->isNotEmpty())
                        <ul class="offcanvas__sub_menu">
                            @foreach ($subMenu->items() as $item)
                                <li class="offcanvas__sub_menu_li">
                                    <a href="{{ $item->url() }}" class="offcanvas__sub_menu_item"
                                       target="{{ $subMenu->target() }}">
                                        {{ $item->name() }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</li>
