@if (count($providers) !== 0)
    <div class="account__login--divide">
        <span class="account__login--divide__text">
            @if (request()->routeIs('login'))
                {{ trans('user::auth.or_continue_with') }}
            @else
                {{ trans('user::auth.or_sign_up_with') }}
            @endif
        </span>
    </div>
    <div class="account__social d-flex justify-content-center">
        @if (setting('facebook_login_enabled'))
            <a class="account__social--link facebook"
               data-toggle="tooltip"
               data-placement="top"
               target="_blank"
               href="{{ route('login.redirect', ['provider' => 'facebook']) }}">
                {{ trans('user::auth.facebook') }}
            </a>
        @endif
        @if (setting('google_login_enabled'))
            <a class="account__social--link google"
               href="{{ route('login.redirect', ['provider' => 'google']) }}"
               data-toggle="tooltip"
               data-placement="top"
               title="{{ trans('user::auth.google') }}">
                {{ trans('user::auth.google') }}
            </a>
        @endif
    </div>
@endif
