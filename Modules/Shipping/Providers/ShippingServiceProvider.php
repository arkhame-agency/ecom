<?php

namespace Modules\Shipping\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Shipping\Facades\ShippingMethod;
use Modules\Shipping\Method;

class ShippingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!config('app.installed')) {
            return;
        }

        $this->registerFreeShipping();
        $this->registerCommercialShipping();
        $this->registerLocalPickup();
        $this->registerFlatRate();
    }

    private function registerFreeShipping()
    {
        if (!setting('free_shipping_enabled')) {
            return;
        }

        ShippingMethod::register('free_shipping', function () {
            return new Method('free_shipping', setting('free_shipping_label'), 0);
        });
    }

    private function registerCommercialShipping()
    {
        if (!setting('commercial_shipping_enabled')) {
            return;
        }

        ShippingMethod::register('commercial_shipping', function () {
            return new Method('commercial_shipping', setting('commercial_shipping_label'), setting('commercial_shipping_cost'));
        });
    }

    private function registerLocalPickup()
    {
        if (!setting('local_pickup_enabled')) {
            return;
        }

        ShippingMethod::register('local_pickup', function () {
            return new Method('local_pickup', setting('local_pickup_label'), setting('local_pickup_cost'));
        });
    }

    private function registerFlatRate()
    {
        if (!setting('flat_rate_enabled')) {
            return;
        }

        ShippingMethod::register('flat_rate', function () {
            return new Method('flat_rate', setting('flat_rate_label'), setting('flat_rate_cost'));
        });
    }
}
