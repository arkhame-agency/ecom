<ul class="widget__categories--menu">
    @foreach ($categories as $category)
        <li class="widget__categories--menu__list"
            :class="{ active: queryParams.category === '{{ $category->slug }}' }">
            <label class="widget__categories--menu__label d-flex align-items-center"
               href="{{ route('categories.products.index', ['category' => $category->slug]) }}">
                @if ($category->logo->exists)
                    <img class="widget__categories--menu__img"
                         src="{{ $category->logo->path }}"
                         alt="categories-img">
                @else
                    <img class="widget__categories--menu__img image-placeholder"
                         src="{{ asset('themes/storefront/public/images/image-placeholder.png') }}"
                         alt="categories-img">
                @endif
                <span class="widget__categories--menu__text" @click.prevent="changeCategory({{ $category }})">{{ $category->name }}</span>
                <svg class="widget__categories--menu__arrowdown--icon"
                     xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                    <path
                        d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                        transform="translate(-6 -8.59)" fill="currentColor"></path>
                </svg>
            </label>
            @if ($category->items->isNotEmpty())
                @include('public.products.index.browse_sub_categories', ['subCategories' => $category->items])
            @endif
        </li>
    @endforeach
</ul>
