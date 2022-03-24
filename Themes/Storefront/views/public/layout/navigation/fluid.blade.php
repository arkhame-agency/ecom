<ul
    class="header__mega--menu d-flex"

    @if ($menu->hasBackgroundImage())
    style="background-image: url({{ $menu->backgroundImage() }});"
    @endif
>
    @foreach ($subMenus as $subMenu)
        <li class="header__mega--menu__li">
            <span class="header__mega--subtitle">
                <a href="{{ $subMenu->url() }}" target="{{ $subMenu->target() }}">
                    {{ $subMenu->name() }}
                </a>
            </span>

            <ul class="header__mega--sub__menu">
                @foreach ($subMenu->items() as $item)
                    <li class="header__mega--sub__menu_li">
                        <a href="{{ $item->url() }}" class="header__mega--sub__menu--title"
                           target="{{ $subMenu->target() }}">
                            {{ $item->name() }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>
