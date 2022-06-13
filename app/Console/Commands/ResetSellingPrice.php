<?php

namespace FleetCart\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Modules\Product\Entities\Product;

class ResetSellingPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cronjob to update the selling price daily if there is a special price and is ended.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $products = Product::all();
        /** @var Product $product */
        foreach ($products as $product) {
            try {
                $product->update(['selling_price' => $product->getSellingPrice()->amount()]);
            } catch (QueryException $queryException) {
                app('sentry')->captureException($queryException);
            }
        }
        return 0;
    }
}
