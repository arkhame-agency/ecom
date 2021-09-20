@extends('public.layout')

@section('title', '')

@push('meta')
    <meta name="title" content="">
    <meta name="description" content="">
    <meta name="twitter:card" content="summary">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="{{ $logo }}">
    <meta property="og:locale" content="{{ locale() }}">

    @foreach (supported_locale_keys() as $code)
        <meta property="og:locale:alternate" content="{{ $code }}">
    @endforeach
@endpush

@section('content')
    <section class="custom-page-wrap">
        <div class="container">
            <div class="custom-page-content">
                <div class="custom-page-left">
                    @include('public.products.index.latest_products')
                </div>
                <div class="custom-page-right">
                    <div class="row">
                        <div class="col-md">
                            <form method="POST" action="{{route('post.request.quotations')}}" id="demande-form">
                                <div class="mb-5">
                                    <h1>{{trans('storefront::requests_form.title')}}</h1>
                                    <p>
                                        {{trans('storefront::requests_form.introduction')}}
                                    </p>
                                </div>
                                @if (!session('success'))
                                    {{ csrf_field() }}
                                    <div class="col-md-17 mx-auto">
                                        <div class="form-row">
                                            <div class="form-group col-md-9 required">
                                                <label for="name">{{trans('storefront::requests_form.name')}}</label>
                                                <input type="text"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       id="name"
                                                       placeholder="{{trans('storefront::requests_form.name')}}"
                                                       name="name" value="{{ old('name') }}">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-9 required">
                                                <label for="email">{{trans('storefront::requests_form.email')}}</label>
                                                <input type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       id="email"
                                                       placeholder="{{trans('storefront::requests_form.email_placeholder')}}"
                                                       name="email" value="{{ old('email') }}">
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label for="address">{{trans('storefront::requests_form.address')}}</label>
                                            <input type="text"
                                                   class="form-control @error('address') is-invalid @enderror"
                                                   id="address"
                                                   placeholder="{{trans('storefront::requests_form.address_placeholder')}}"
                                                   name="address" value="{{ old('address') }}">
                                            @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 required">
                                                <label for="city">{{trans('storefront::requests_form.city')}}</label>
                                                <input type="text"
                                                       class="form-control @error('city') is-invalid @enderror"
                                                       id="city"
                                                       placeholder="{{trans('storefront::requests_form.city')}}"
                                                       name="city" value="{{ old('city') }}">
                                                @error('city')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 required">
                                                <label
                                                    for="postalCode">{{trans('storefront::requests_form.postal_code')}}</label>
                                                <input type="text"
                                                       class="form-control @error('postal_code') is-invalid @enderror"
                                                       id="postalCode"
                                                       placeholder="{{trans('storefront::requests_form.postal_code_placeholder')}}"
                                                       name="postal_code" value="{{ old('postal_code') }}">
                                                @error('postal_code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 required">
                                                <label
                                                    for="telephone">{{trans('storefront::requests_form.telephone')}}</label>
                                                <input type="text"
                                                       class="form-control @error('telephone') is-invalid @enderror"
                                                       id="telephone"
                                                       placeholder="{{trans('storefront::requests_form.telephone_placeholder')}}"
                                                       name="telephone" value="{{ old('telephone') }}">
                                                @error('telephone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="mb-2">
                                                <label>{{trans('storefront::requests_form.why_do_you_want_technician')}}</label>
                                            </div>
                                            <div class="form-radio">
                                                <input
                                                    class="form-check-input @error('request_for') is-invalid @enderror"
                                                    value="{{trans('storefront::requests_form.requests_for.installation_quote')}}"
                                                    type="radio" id="installation_quote"
                                                    name="request_for"
                                                    @if(old('request_for') === trans('storefront::requests_form.requests_for.installation_quote'))
                                                    checked
                                                    @endif>
                                                <label class="form-check-label" for="installation_quote">
                                                    {{trans('storefront::requests_form.requests_for.installation_quote')}}
                                                </label>
                                            </div>
                                            <div class="form-radio">
                                                <input
                                                    class="form-check-input @error('request_for') is-invalid @enderror"
                                                    value="{{trans('storefront::requests_form.requests_for.service_call')}}"
                                                    type="radio" id="service_call"
                                                    name="request_for"
                                                    @if(old('request_for') === trans('storefront::requests_form.requests_for.service_call'))
                                                    checked
                                                    @endif>
                                                <label class="form-check-label" for="service_call">
                                                    {{trans('storefront::requests_form.requests_for.service_call')}}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="additional_info">{{trans('storefront::requests_form.additional_information')}}</label>
                                            <textarea
                                                class="form-control @error('additional_info') is-invalid @enderror"
                                                id="additional_info" rows="6"
                                                name="additional_info"></textarea>
                                        </div>
                                        <div class="form-group">
                                            {{trans('storefront::requests_form.once_your_request_received_we_will_contact_you')}}
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" data-loading>
                                                {{ trans('storefront::requests_form.send_my_request') }}
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    {{trans('storefront::requests_form.once_your_request_received_we_will_contact_you')}}
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
