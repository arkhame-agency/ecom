<?php

namespace Modules\Transaction\Admin;

use Modules\Admin\Ui\AdminTable;
use Modules\Transaction\Entities\Transaction;

class TransactionTable extends AdminTable
{
    /**
     * Raw columns that will not be escaped.
     *
     * @var array
     */
    protected $rawColumns = ['order_id', 'transaction_id'];

    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable()
            ->addColumn('order_id', function ($transaction) {
                $orderUrl = route('admin.orders.show', $transaction->order_id);
                return "<a href='{$orderUrl}'>{$transaction->order_id}</a>";
            })
            ->addColumn('transaction_id', function ($transaction) {
                return "<a href='{$this->getUrl($transaction)}'>{$transaction->transaction_id}</a>";
            });
    }

    /**
     * @param Transaction $transaction
     * @return string
     */
    private function getUrl(Transaction $transaction): string
    {
        switch ($transaction->payment_method) {
            case setting('paypal_label'):
                $url_payment_method = 'https://www.paypal.com/activity/payment/'.$transaction->transaction_id;
                break;
            case setting('stripe_label'):
                $url_payment_method = 'https://dashboard.stripe.com/payments/'.$transaction->transaction_id;
                break;
            default:
                $url_payment_method = '#';
        }

        return $url_payment_method;

    }
}
