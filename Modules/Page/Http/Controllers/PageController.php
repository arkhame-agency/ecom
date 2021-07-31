<?php

namespace Modules\Page\Http\Controllers;

use Modules\Page\Entities\Page;
use Modules\Media\Entities\File;
use Modules\Product\Entities\Product;

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

    private function latestProducts()
    {
        return Product::forCard()->take(5)->latest()->get()->map->clean();
    }
}
