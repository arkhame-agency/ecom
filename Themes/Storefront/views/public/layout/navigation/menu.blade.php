<li class="header__menu--items {{ $menu->isFluid() ? 'mega__menu--items' : '' }}">
    <a class="header__menu--link" href="{{ $menu->url() }}" target="{{ $menu->target() }}">
        {{ $menu->name() }} @if ($menu->subMenus()->count())<span class="menu__plus--icon">+</span>@endif
    </a>
    @if ($menu->isFluid())
        @include('public.layout.navigation.fluid', ['subMenus' => $menu->subMenus()])
    @else
        @include('public.layout.navigation.dropdown', ['subMenus' => $menu->subMenus()])
    @endif
</li>
