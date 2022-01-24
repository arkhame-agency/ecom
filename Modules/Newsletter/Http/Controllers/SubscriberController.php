<?php

namespace Modules\Newsletter\Http\Controllers;

use Spatie\Newsletter\Newsletter;
use Modules\Newsletter\Http\Requests\StoreSubscriberRequest;

class SubscriberController
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriberRequest $request)
    {
        if (setting('newsletter_last_name_enabled')) {
            Newsletter::subscribeOrUpdate($request->email, ['FNAME' => $request->name, 'LNAME' => $request->lname]);
        } else {
            Newsletter::subscribeOrUpdate($request->email);
        }

        if (!Newsletter::lastActionSucceeded()) {
            return response()->json([
                'message' => str_after(Newsletter::getLastError(), '400: '),
            ], 403);
        }
    }
}
