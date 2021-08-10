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
                            <form method="POST" action="{{route('post.registration.guarantee')}}" id="guarantee-form">
                                <div class="mb-5">
                                    <h1>Enregistrement d'une garantie</h1>
                                    <p>
                                        Pour enregistrer votre produit, il suffit d'avoir en main:
                                    </p>
                                    <ul>
                                        <li>
                                            le numéro de série du produit
                                        </li>
                                        <li>
                                            le reçu ou la facture avec référence à la date d'achat du produit
                                        </li>
                                    </ul>
                                </div>
                                @if (!session('success'))
                                    {{ csrf_field() }}
                                    <div class="col-md-17 mx-auto">
                                        <div class="form-row">
                                            <div class="form-group col-md-9 required">
                                                <label for="name">{{trans('storefront::guarantee_form.name')}}</label>
                                                <input type="text"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       id="name"
                                                       placeholder="{{trans('storefront::guarantee_form.name')}}"
                                                       name="name" value="{{ old('name') }}">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-9 required">
                                                <label for="email">{{trans('storefront::guarantee_form.email')}}</label>
                                                <input type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       id="email"
                                                       placeholder="{{trans('storefront::guarantee_form.email_placeholder')}}"
                                                       name="email" value="{{ old('email') }}">
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label for="address">{{trans('storefront::guarantee_form.address')}}</label>
                                            <input type="text"
                                                   class="form-control @error('address') is-invalid @enderror"
                                                   id="address"
                                                   placeholder="{{trans('storefront::guarantee_form.address_placeholder')}}"
                                                   name="address" value="{{ old('address') }}">
                                            @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-9 required">
                                                <label for="city">{{trans('storefront::guarantee_form.city')}}</label>
                                                <input type="text"
                                                       class="form-control @error('city') is-invalid @enderror"
                                                       id="city"
                                                       placeholder="{{trans('storefront::guarantee_form.city')}}"
                                                       name="city" value="{{ old('city') }}">
                                                @error('city')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-9 required">
                                                <label
                                                    for="postalCode">{{trans('storefront::guarantee_form.postal_code')}}</label>
                                                <input type="text"
                                                       class="form-control @error('postal_code') is-invalid @enderror"
                                                       id="postalCode"
                                                       placeholder="{{trans('storefront::guarantee_form.postal_code_placeholder')}}"
                                                       name="postal_code" value="{{ old('postal_code') }}">
                                                @error('postal_code')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-9 required">
                                                <label
                                                    for="province">{{trans('storefront::guarantee_form.province')}}</label>

                                                <select
                                                    class="form-control custom-select @error('province') is-invalid @enderror"
                                                    name="province">
                                                    <option value="">{{trans('storefront::guarantee_form.select')}}</option>
                                                    @foreach($provinces as $code => $province)
                                                        <option value="{{$code}}"
                                                                @if(old('province')=== $code) selected @endif>{{$province}}</option>
                                                    @endforeach
                                                </select>
                                                @error('province')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-9 required">
                                                <label
                                                    for="telephone">{{trans('storefront::guarantee_form.telephone')}}</label>
                                                <input type="text"
                                                       class="form-control @error('telephone') is-invalid @enderror"
                                                       id="telephone"
                                                       placeholder="{{trans('storefront::guarantee_form.telephone_placeholder')}}"
                                                       name="telephone" value="{{ old('telephone') }}">
                                                @error('telephone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    value="1"
                                                    type="checkbox" id="subscribe_to_mailchimp"
                                                    name="subscribe_to_mailchimp"
                                                    @if(old('subscribe_to_mailchimp') === '1')
                                                    checked
                                                    @endif>
                                                <label class="form-check-label" for="subscribe_to_mailchimp">
                                                    {{trans('storefront::guarantee_form.subscribe_to_mailchimp')}}
                                                </label>
                                            </div>
                                        </div>
                                        <h4>Vacuum cleaner information</h4>

                                        <div class="form-row">
                                            <div class="form-group col-md-9 required">
                                                <label
                                                    for="make">{{trans('storefront::guarantee_form.vacuum_cleaner.make')}}</label>
                                                <input type="text"
                                                       class="form-control @error('make') is-invalid @enderror"
                                                       id="make"
                                                       placeholder="{{trans('storefront::guarantee_form.vacuum_cleaner.make')}}"
                                                       name="make" value="{{ old('make') }}">
                                                @error('make')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-9 required">
                                                <label
                                                    for="model">{{trans('storefront::guarantee_form.vacuum_cleaner.model')}}</label>
                                                <input type="text"
                                                       class="form-control @error('model') is-invalid @enderror"
                                                       id="model"
                                                       placeholder="{{trans('storefront::guarantee_form.vacuum_cleaner.model')}}"
                                                       name="model" value="{{ old('model') }}">
                                                @error('model')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-5 required">
                                                <label
                                                    for="serial_number">{{trans('storefront::guarantee_form.vacuum_cleaner.serial_number')}}</label>
                                                <input type="text"
                                                       class="form-control @error('serial_number') is-invalid @enderror"
                                                       id="serial_number"
                                                       placeholder="{{trans('storefront::guarantee_form.vacuum_cleaner.serial_number')}}"
                                                       name="serial_number" value="{{ old('serial_number') }}">
                                                @error('serial_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4 required">
                                                <label
                                                    for="date_of_purchase">{{trans('storefront::guarantee_form.vacuum_cleaner.date_of_purchase')}}</label>
                                                <input type="date"
                                                       class="form-control @error('date_of_purchase') is-invalid @enderror"
                                                       id="date_of_purchase"
                                                       placeholder="{{trans('storefront::guarantee_form.vacuum_cleaner.date_of_purchase')}}"
                                                       name="date_of_purchase" value="{{ old('date_of_purchase') }}"
                                                       pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                                @error('date_of_purchase')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4 required">
                                                <label
                                                    for="invoice_number">{{trans('storefront::guarantee_form.vacuum_cleaner.invoice_number')}}</label>
                                                <input type="text"
                                                       class="form-control @error('invoice_number') is-invalid @enderror"
                                                       id="invoice_number"
                                                       placeholder="{{trans('storefront::guarantee_form.vacuum_cleaner.invoice_number')}}"
                                                       name="invoice_number" value="{{ old('invoice_number') }}">
                                                @error('invoice_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label
                                                    for="price_paid">{{trans('storefront::guarantee_form.vacuum_cleaner.price_paid')}}</label>
                                                <input type="number"
                                                       class="form-control @error('price_paid') is-invalid @enderror"
                                                       id="price_paid"
                                                       placeholder="{{trans('storefront::guarantee_form.vacuum_cleaner.price_paid_placeholder')}}"
                                                       name="price_paid" value="{{ old('price_paid') }}" step=".01">
                                                @error('price_paid')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-9">
                                                <label
                                                    for="assigned_registration_number">{{trans('storefront::guarantee_form.vacuum_cleaner.assigned_registration_number')}}</label>
                                                <input type="text"
                                                       class="form-control @error('assigned_registration_number') is-invalid @enderror"
                                                       id="assigned_registration_number"
                                                       placeholder="{{trans('storefront::guarantee_form.vacuum_cleaner.assigned_registration_number')}}"
                                                       name="assigned_registration_number" value="{{ old('assigned_registration_number') }}" step=".01">
                                                @error('assigned_registration_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr style="background: orange;height: 2px" class="mb-5">
                                        <h3>
                                            Satisfaction survey
                                        </h3>
                                        <p>
                                            On a scale of 1 to 10:
                                        </p>
                                        <div class="form-group">
                                            <label for="service_received">
                                                How would you rate the service you received in store?:
                                            </label>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    1 not at all satisfied
                                                </div>
                                                <div class="col-md-9 text-xl-right">
                                                    10 very satisfied
                                                </div>
                                                <div class="col-md-18">
                                                    <input type="range" class="custom-range" id="service_received"
                                                           name="service_received"
                                                           min="1" max="10" step="1" value="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="satisfied_answers_questions">
                                                How satisfied are you with the answers to your questions?:
                                            </label>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    1 not at all satisfied
                                                </div>
                                                <div class="col-md-9 text-xl-right">
                                                    10 very satisfied
                                                </div>
                                                <div class="col-md-18">
                                                    <input type="range" class="custom-range"
                                                           id="satisfied_answers_questions"
                                                           name="satisfied_answers_questions"
                                                           min="1" max="10" step="1" value="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="satisfied_explanations_vacuum">
                                                How satisfied are you with the explanations on the operation of your
                                                vacuum cleaner and the necessary maintenance?:
                                            </label>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    1 not at all satisfied
                                                </div>
                                                <div class="col-md-9 text-xl-right">
                                                    10 very satisfied
                                                </div>
                                                <div class="col-md-18">
                                                    <input type="range" class="custom-range"
                                                           id="satisfied_explanations_vacuum"
                                                           name="satisfied_explanations_vacuum"
                                                           min="1" max="10" step="1" value="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="recommend_to_friends">
                                                How likely are you to recommend us to your friends and family?:
                                            </label>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    1 not at all satisfied
                                                </div>
                                                <div class="col-md-9 text-xl-right">
                                                    10 very satisfied
                                                </div>
                                                <div class="col-md-18">
                                                    <input type="range" class="custom-range"
                                                           id="recommend_to_friends"
                                                           name="recommend_to_friends"
                                                           min="1" max="10" step="1" value="1">
                                                </div>
                                            </div>
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
