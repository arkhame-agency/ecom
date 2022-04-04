@extends('public.layout')

@section('title', trans('user::auth.register'))

@section('content')
    <section class="form-wrap register-wrap">
        <div class="container">
            <div class="form-wrap-inner register-wrap-inner">
                <h2></h2>

                <form method="POST" action="{{ route('register.post') }}">
                    @csrf

                    <div class="form-group">
                        <label for="first-name">
                            <span>*</span>
                        </label>

                        <input type="text" class="form-control">


                    </div>

                    <div class="form-group">
                        <label for="last-name">
                            <span>*</span>
                        </label>

                        <input type="text" class="form-control">

                    </div>

                    <div class="form-group">
                        <label for="email">
                            <span>*</span>
                        </label>

                        <input type="text" class="form-control">


                        <input type="text" class="form-control mt-3">

                    </div>

                    <div class="form-group">
                        <label for="phone">
                            <span>*</span>
                        </label>

                        <input type="text"class="form-control">

                    </div>

                    <div class="form-group">
                        <label for="password">
                            <span>*</span>
                        </label>

                        <input class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">
                            <span>*</span>
                        </label>

                        <input type="password"  class="form-control">
                    </div>

                    <div class="form-group p-t-5">
                        @captcha

                    </div>

                    <div class="form-check terms-and-conditions">
                    </div>


                </form>

                @include('public.auth.partials.social_login')

                <span class="have-an-account">
                    {{ trans('user::auth.already_have_an_account') }}
                </span>

                <a href="{{ route('login') }}" class="btn btn-default btn-sign-in">
                    {{ trans('user::auth.sign_in') }}
                </a>
            </div>
        </div>
    </section>
@endsection
