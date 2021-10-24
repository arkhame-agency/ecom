<?php

namespace Modules\Checkout\Listeners;

use Illuminate\Support\Facades\Mail;
use Modules\Checkout\Events\OrderPlaced;
use Modules\Checkout\Mail\Invoice;
use Modules\Checkout\Mail\NewOrder;
use Swift_TransportException;

class SendNewOrderEmails
{
    /**
     * Handle the event.
     *
     * @param \Modules\Checkout\Events\OrderPlaced $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {
        try {
            if (setting('order_notification')) {
                Mail::to(get_email_address_for('admin_order_notification_mail_address'))
                    ->send(new NewOrder($event->order));
            }

            if (setting('invoice_email')) {
                Mail::to($event->order->customer_email)
                    ->send(new Invoice($event->order));
            }
        } catch (Swift_TransportException $e) {
            //
        }
    }
}
