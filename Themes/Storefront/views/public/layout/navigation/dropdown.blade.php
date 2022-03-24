@if ($subMenus->isNotEmpty())
    <ul class="header__sub--menu">
        @foreach ($subMenus as $subMenu)
{{--            <li class="{{ $subMenu->hasItems() ? 'dropdown' : '' }}">--}}
            <li class="header__sub--menu__items">
                <a class="header__sub--menu__link" href="{{ $subMenu->url() }}" target="{{ $subMenu->target() }}">
                    {{ $subMenu->name() }}
                </a>

{{--                @if ($subMenu->hasItems())--}}
{{--                    @include('public.layout.navigation.dropdown', ['subMenus' => $subMenu->items()])--}}
{{--                @endif--}}
            </li>
        @endforeach
    </ul>
@endif
