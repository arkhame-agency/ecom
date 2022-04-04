<ul class="widget__categories--sub__menu">
    @foreach ($subCategories as $subCategory)
        <li class="widget__categories--sub__menu--list"
            :class="{ active: queryParams.category === '{{ $subCategory->slug }}' }">
            <a class="widget__categories--sub__menu--link d-flex align-items-center"
               href="{{ route('categories.products.index', ['category' => $subCategory->slug]) }}"
               @click.prevent="changeCategory({{ $subCategory }})">
                @if ($subCategory->logo->exists)
                    <img class="widget__categories--sub__menu--img"
                         src="{{ $subCategory->logo->path }}"
                         alt="categories-img">
                @else
                    <img class="widget__categories--sub__menu--img image-placeholder"
                         src="{{ asset('themes/storefront/public/images/image-placeholder.png') }}"
                         alt="categories-img">
                @endif
                <span class="widget__categories--sub__menu--text">
                    {{ $subCategory->name }}
                </span>
            </a>
            @if ($subCategory->items->isNotEmpty())
                @include('public.products.index.browse_sub_categories', ['subCategories' => $subCategory->items])
            @endif
        </li>
    @endforeach
</ul>
