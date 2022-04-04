<ul class="quickview__social--wrapper mt-0 d-flex">
    <li class="quickview__social--list">
        <a class="quickview__social--icon" target="_blank"
           href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" title="{{ trans('storefront::product.twitter') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="7.667"
                 height="16.524" viewBox="0 0 7.667 16.524">
                <path data-name="Path 237"
                      d="M967.495,353.678h-2.3v8.253h-3.437v-8.253H960.13V350.77h1.624v-1.888a4.087,4.087,0,0,1,.264-1.492,2.9,2.9,0,0,1,1.039-1.379,3.626,3.626,0,0,1,2.153-.6l2.549.019v2.833h-1.851a.732.732,0,0,0-.472.151.8.8,0,0,0-.246.642v1.719H967.8Z"
                      transform="translate(-960.13 -345.407)"
                      fill="currentColor"/>
            </svg>
            <span class="visually-hidden">Facebook</span>
        </a>
    </li>
    <li class="quickview__social--list">
        <a class="quickview__social--icon" target="_blank"
           href="https://twitter.com/share?url={{ url()->current() }}&text={{ $product->name }}" title="{{ trans('storefront::product.twitter') }}" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="16.489"
                 height="13.384" viewBox="0 0 16.489 13.384">
                <path data-name="Path 303"
                      d="M966.025,1144.2v.433a9.783,9.783,0,0,1-.621,3.388,10.1,10.1,0,0,1-1.845,3.087,9.153,9.153,0,0,1-3.012,2.259,9.825,9.825,0,0,1-4.122.866,9.632,9.632,0,0,1-2.748-.4,9.346,9.346,0,0,1-2.447-1.11q.4.038.809.038a6.723,6.723,0,0,0,2.24-.376,7.022,7.022,0,0,0,1.958-1.054,3.379,3.379,0,0,1-1.958-.687,3.259,3.259,0,0,1-1.186-1.666,3.364,3.364,0,0,0,.621.056,3.488,3.488,0,0,0,.885-.113,3.267,3.267,0,0,1-1.374-.631,3.356,3.356,0,0,1-.969-1.186,3.524,3.524,0,0,1-.367-1.5v-.057a3.172,3.172,0,0,0,1.544.433,3.407,3.407,0,0,1-1.1-1.214,3.308,3.308,0,0,1-.4-1.609,3.362,3.362,0,0,1,.452-1.694,9.652,9.652,0,0,0,6.964,3.538,3.911,3.911,0,0,1-.075-.772,3.293,3.293,0,0,1,.452-1.694,3.409,3.409,0,0,1,1.233-1.233,3.257,3.257,0,0,1,1.685-.461,3.351,3.351,0,0,1,2.466,1.073,6.572,6.572,0,0,0,2.146-.828,3.272,3.272,0,0,1-.574,1.083,3.477,3.477,0,0,1-.913.8,6.869,6.869,0,0,0,1.958-.546A7.074,7.074,0,0,1,966.025,1144.2Z"
                      transform="translate(-951.23 -1140.849)"
                      fill="currentColor"/>
            </svg>
            <span class="visually-hidden">Twitter</span>
        </a>
    </li>
</ul>

{{--<div class="social-share">--}}
{{--    <label>{{ trans('storefront::product.share') }}</label>--}}

{{--    <ul class="list-inline social-links">--}}

{{--        <li>--}}
{{--            <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" title="{{ trans('storefront::product.linkedin') }}" target="_blank">--}}
{{--                <i class="lab la-linkedin"></i>--}}
{{--            </a>--}}
{{--        </li>--}}

{{--        <li>--}}
{{--            <a href="http://www.tumblr.com/share?v=3&u={{ url()->current() }}" title="{{ trans('storefront::product.tumblr') }}" target="_blank">--}}
{{--                <i class="lab la-tumblr"></i>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--</div>--}}
