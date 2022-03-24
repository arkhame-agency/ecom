<!-- Start slider section -->
<section class="hero__slider--section">
    <div class="hero__slider--inner hero__slider--activation swiper">
        <div class="hero__slider--wrapper swiper-wrapper"
             data-speed="{{ $slider->speed ?? '1000' }}"
             data-autoplay="{{ $slider->autoplay ?? 'false' }}"
             data-autoplay-speed="{{ $slider->autoplay_speed ?? '5000' }}"
             data-fade="{{ $slider->fade ?? 'false' }}"
             data-dots="{{ $slider->dots ?? 'true' }}"
             data-arrows="{{ $slider->arrows ?? 'true' }}"
        >
            @foreach ($slider->slides as $slide)
                @if($slide->hasDateToShow())
                    <div class="swiper-slide ">
                        <div class="hero__slider--items hero__slider--bg"
                             style="background-image: url('{{ $slide->file->path }}')">
                            <div class="container-fluid">
                                <div class="hero__slider--items__inner">
                                    <div class="row row-cols-1">
                                        <div
                                            class="col-lg-6 {{ ! $slide->isAlignedLeft() ? 'offset-lg-6 text-right' : ''}}">
                                            <div class="slider__content">
{{--                                                <p class="slider__content--desc desc1 mb-15">--}}
{{--                                                    Discover our best furniture collection from home--}}
{{--                                                </p>--}}
                                                <h2 class="slider__content--maintitle h1">
                                                    {!! $slide->caption_1 !!}
                                                </h2>
                                                <p class="slider__content--desc mb-35 d-sm-2-none">
                                                    {!! $slide->caption_2 !!}
                                                </p>
                                                @if ($slide->call_to_action_text)
                                                    <a
                                                        href="{{ $slide->call_to_action_url }}"
                                                        class="slider__content--btn primary__btn"
                                                        data-animation-in="{{ data_get($slide->options, 'call_to_action.effect', 'fadeInRight') }}"
                                                        data-delay-in="{{ data_get($slide->options, 'call_to_action.delay', '0.7') }}"
                                                        target="{{ $slide->open_in_new_window ? '_blank' : '_self' }}"
                                                    >
                                                        {!! $slide->call_to_action_text !!}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        @if($slider->arrows)
            <div class="swiper__nav--btn swiper-button-prev"></div>
            <div class="swiper__nav--btn swiper-button-next"></div>
        @endif
        @if( $slider->dots ?? 'true' )
            <div class="swiper-pagination"></div>
        @endif
    </div>
</section>
<!-- End slider section -->

<!-- Start banner section -->
<section class="banner__section section--padding">
    <div class="container-fluid">
        <div class="row mb--n28">
            <div class="col-lg-6 col-md-6 col-sm-6 mb-28">
                <div class="banner__items">
                    <a class="banner__items--thumbnail position__relative"
                       href="{{ $sliderBanners['banner_1']->call_to_action_url }}"
                       target="{{ $sliderBanners['banner_1']->open_in_new_window ? '_blank' : '_self' }}"><img
                            class="banner__items--thumbnail__img"
                            src="{{ $sliderBanners['banner_1']->image->path }}"
                            alt="banner-img">
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 mb-28">
                <div class="banner__items">
                    <a class="banner__items--thumbnail position__relative"
                       href="{{ $sliderBanners['banner_2']->call_to_action_url }}"
                       target="{{ $sliderBanners['banner_2']->open_in_new_window ? '_blank' : '_self' }}">
                        <img class="banner__items--thumbnail__img"
                             src="{{ $sliderBanners['banner_2']->image->path }}" alt="banner-img">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End banner section -->

{{--<section class="home-section-wrap">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="home-section-inner">--}}
{{--                <div class="home-slider-wrap">--}}
{{--                    <div--}}
{{--                        class="home-slider"--}}
{{--                        data-speed="{{ $slider->speed ?? '1000' }}"--}}
{{--                        data-autoplay="{{ $slider->autoplay ?? 'false' }}"--}}
{{--                        data-autoplay-speed="{{ $slider->autoplay_speed ?? '5000' }}"--}}
{{--                        data-fade="{{ $slider->fade ?? 'false' }}"--}}
{{--                        data-dots="{{ $slider->dots ?? 'true' }}"--}}
{{--                        data-arrows="{{ $slider->arrows ?? 'true' }}"--}}
{{--                    >--}}
{{--                        @foreach ($slider->slides as $slide)--}}
{{--                            <div class="slide">--}}
{{--                                <img src="{{ $slide->file->path }}" data-animation-in="zoomInImage"--}}
{{--                                     class="slider-image animated">--}}

{{--                                <div class="slide-content {{ $slide->isAlignedLeft() ? 'align-left' : 'align-right' }}">--}}
{{--                                    <div class="captions">--}}
{{--                                        <span--}}
{{--                                            class="caption caption-1"--}}
{{--                                            data-animation-in="{{ data_get($slide->options, 'caption_1.effect', 'fadeInRight') }}"--}}
{{--                                            data-delay-in="{{ data_get($slide->options, 'caption_1.delay', '0') }}"--}}
{{--                                        >--}}
{{--                                            {!! $slide->caption_1 !!}--}}
{{--                                        </span>--}}

{{--                                        <span--}}
{{--                                            class="caption caption-2"--}}
{{--                                            data-animation-in="{{ data_get($slide->options, 'caption_2.effect', 'fadeInRight') }}"--}}
{{--                                            data-delay-in="{{ data_get($slide->options, 'caption_2.delay', '0.3') }}"--}}
{{--                                        >--}}
{{--                                            {!! $slide->caption_2 !!}--}}
{{--                                        </span>--}}

{{--                                        @if ($slide->call_to_action_text)--}}
{{--                                            <a--}}
{{--                                                href="{{ $slide->call_to_action_url }}"--}}
{{--                                                class="btn btn-primary btn-slider"--}}
{{--                                                data-animation-in="{{ data_get($slide->options, 'call_to_action.effect', 'fadeInRight') }}"--}}
{{--                                                data-delay-in="{{ data_get($slide->options, 'call_to_action.delay', '0.7') }}"--}}
{{--                                                target="{{ $slide->open_in_new_window ? '_blank' : '_self' }}"--}}
{{--                                            >--}}
{{--                                                {!! $slide->call_to_action_text !!}--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                @include('public.home.sections.slider_banners')--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
