<div class="col">
    <div class="product__details--media">
        <div class="product__media--preview  swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="product__media--preview__items">
                        @if (! $product->base_image->exists)
                            <a class="product__media--preview__items--link glightbox"
                               data-gallery="product-media-preview"
                               href="{{ asset('themes/storefront/public/images/image-placeholder.png') }}">
                                <img class="product__media--preview__items--img"
                                     src="{{ asset('themes/storefront/public/images/image-placeholder.png') }}"
                                     alt="Image placeholder">
                            </a>
                            <div class="product__media--view__icon">
                                <a class="product__media--view__icon--link glightbox"
                                   href="{{ asset('themes/storefront/public/images/image-placeholder.png') }}"
                                   data-gallery="product-media-preview">
                                    <svg class="product__media--view__icon--svg" xmlns="http://www.w3.org/2000/svg"
                                         width="22.51" height="22.443" viewBox="0 0 512 512">
                                        <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                              fill="none" stroke="currentColor" stroke-miterlimit="10"
                                              stroke-width="32"></path>
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                              stroke-miterlimit="10" stroke-width="32"
                                              d="M338.29 338.29L448 448"></path>
                                    </svg>
                                    <span class="visually-hidden">Media Gallery</span>
                                </a>
                            </div>
                        @else
                            <a class="product__media--preview__items--link glightbox"
                               data-gallery="product-media-preview"
                               href="{{ $product->base_image->path }}">
                                <img class="product__media--preview__items--img" src="{{ $product->base_image->path }}"
                                     alt="Product image">
                            </a>
                            <div class="product__media--view__icon">
                                <a class="product__media--view__icon--link glightbox"
                                   href="{{ $product->base_image->path }}" data-gallery="product-media-preview">
                                    <svg class="product__media--view__icon--svg" xmlns="http://www.w3.org/2000/svg"
                                         width="22.51" height="22.443" viewBox="0 0 512 512">
                                        <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                              fill="none" stroke="currentColor" stroke-miterlimit="10"
                                              stroke-width="32"></path>
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                              stroke-miterlimit="10" stroke-width="32"
                                              d="M338.29 338.29L448 448"></path>
                                    </svg>
                                    <span class="visually-hidden">Media Gallery</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                @foreach ($product->additional_images as $additionalImage)
                    @if ($additionalImage->exists)
                        <div class="swiper-slide">
                            <div class="product__media--preview__items">
                                <a class="product__media--preview__items--link glightbox"
                                   data-gallery="product-media-preview"
                                   href="{{ $additionalImage->path }}">
                                    <img class="product__media--preview__items--img"
                                         src="{{ $additionalImage->path }}"
                                         alt="product-media-img">
                                </a>
                                <div class="product__media--view__icon">
                                    <a class="product__media--view__icon--link glightbox"
                                       href="{{ $additionalImage->path }}"
                                       data-gallery="product-media-preview">
                                        <svg class="product__media--view__icon--svg" xmlns="http://www.w3.org/2000/svg"
                                             width="22.51" height="22.443" viewBox="0 0 512 512">
                                            <path
                                                d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                                fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                stroke-width="32"></path>
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                  stroke-miterlimit="10" stroke-width="32"
                                                  d="M338.29 338.29L448 448"></path>
                                        </svg>
                                        <span class="visually-hidden">Media Gallery</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="product__media--nav swiper">
            <div class="swiper-wrapper">
                @if ($product->base_image->exists)
                    <div class="swiper-slide">
                        <div class="product__media--nav__items">
                            <img class="product__media--nav__items--img" src="{{ $product->base_image->path }}"
                                 alt="product-nav-img">
                        </div>
                    </div>
                @endif
                @foreach ($product->additional_images as $additionalImage)
                    @if ($additionalImage->exists)
                        <div class="swiper-slide">
                            <div class="product__media--nav__items">
                                <img class="product__media--nav__items--img"
                                     src="{{ $additionalImage->path }}"
                                     alt="product-nav-img">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="swiper__nav--btn swiper-button-next"></div>
            <div class="swiper__nav--btn swiper-button-prev"></div>
        </div>
    </div>
</div>
