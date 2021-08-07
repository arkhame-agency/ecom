<?php

namespace Modules\Page\Http\Controllers;

use FleetCart\Mail\SendRequests;
use Illuminate\Http\Request;
use Modules\Media\Entities\File;
use Modules\Page\Entities\Page;
use Modules\Product\Entities\Product;
use Themes\Storefront\Http\Requests\SendRequestsPostRequest;

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

    public function demandes(Request $request)
    {
        $logo = File::findOrNew(setting('storefront_header_logo'))->path;
        $latestProducts = $this->latestProducts();
        if ($request->get("success")) {
            $success = true;
        } else {
            $success = false;
        }

        return view('public.pages.requests_form', compact('logo', 'latestProducts', 'success'));
    }

    public function postDemandes(SendRequestsPostRequest $sendRequestsPostRequest)
    {
        $sendRequestsPostRequest->validated();

        \Mail::to(setting('store_email'))->send(new SendRequests($sendRequestsPostRequest));

        return redirect()->route('demandes')->with('success', trans('storefront::requests_form.your_request_has_been_sent'));
    }

    private function latestProducts()
    {
        return Product::forCard()->take(5)->latest()->get()->map->clean();
    }
}
