<?php

namespace Modules\Page\Http\Controllers;

use FleetCart\Mail\RegisterGuarantee;
use FleetCart\Mail\SendRequests;
use Illuminate\Http\Request;
use Modules\Media\Entities\File;
use Modules\Page\Entities\Page;
use Modules\Product\Entities\Product;
use Modules\Support\State;
use Newsletter;
use Themes\Storefront\Http\Requests\RegisterGuaranteePostRequest;
use Themes\Storefront\Http\Requests\SendRequestQuotationsPostRequest;

class PageController
{
    /**
     * Display page for the slug.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $logo = File::findOrNew(setting('storefront_header_logo'))->path;
        $page = Page::where('slug', $slug)->firstOrFail();
        $latestProducts = $this->latestProducts();

        return view('public.pages.show', compact('page', 'logo', 'latestProducts'));
    }

    public function requestQuotations(Request $request)
    {
        $logo = File::findOrNew(setting('storefront_header_logo'))->path;
        $latestProducts = $this->latestProducts();

        return view('public.pages.request_quotations_form', compact('logo', 'latestProducts'));
    }

    public function postRequestQuotations(SendRequestQuotationsPostRequest $sendRequestsPostRequest)
    {
        $sendRequestsPostRequest->validated();

        \Mail::to(config('mail.email-addresses.email-installation'))->send(new SendRequests($sendRequestsPostRequest));

        return redirect()->route('request.quotations')->with('success', trans('storefront::requests_form.your_request_has_been_sent'));
    }

    public function registrationGuarantee()
    {
        $logo = File::findOrNew(setting('storefront_header_logo'))->path;
        $latestProducts = $this->latestProducts();

        $provinces = State::get('CA');

        return view('public.pages.registration_guarantee_form', compact('logo', 'latestProducts', 'provinces'));
    }

    public function postRegistrationGuarantee(RegisterGuaranteePostRequest $registerGuaranteePostRequest)
    {

        $registerGuaranteePostRequest->validated();

        \Mail::to(config('mail.email-addresses.email-guarantee'))->send(new RegisterGuarantee($registerGuaranteePostRequest));

        if ($registerGuaranteePostRequest->subscribe_to_mailchimp) {
            Newsletter::subscribeOrUpdate($registerGuaranteePostRequest->email, ['FNAME' => $registerGuaranteePostRequest->name, 'LNAME' => $registerGuaranteePostRequest->name]);
            if (!Newsletter::lastActionSucceeded()) {
                return redirect()->route('registration.guarantee')->with('error', str_after(Newsletter::getLastError(), '400: '));
            }
        }

        return redirect()->route('registration.guarantee')->with('success', trans('storefront::requests_form.your_request_has_been_sent'));
    }

    private function latestProducts()
    {
        return Product::forCard()->take(5)->latest()->get()->map->clean();
    }
}
