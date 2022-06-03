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
        $page = Page::select('pages.id')
            ->join('page_translations', 'pages.id', '=', 'page_translations.page_id')
            ->where('page_translations.slug', $slug)->firstOrFail();
        $routeArray = $page->getUrls();
        $latestProducts = $this->latestProducts();

        return view('public.pages.show', compact('routeArray','page', 'logo', 'latestProducts'));
    }

    private function latestProducts()
    {
        return Product::forCard()->take(5)->latest()->get()->map->clean();
    }
}
