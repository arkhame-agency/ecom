<?php

namespace Modules\Order\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Media\Entities\File;
use Modules\Order\Entities\Order;
use Shippo_Object;

class OrderShipmentLabelCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The instance of the order.
     *
     * @var Order
     */
    public Order $order;

    public Shippo_Object $shipmentLabel;

    /**
     * Create a new message instance.
     *
     * @param Order $order
     * @return void
     */
    public function __construct(Order $order, Shippo_Object $shipmentLabel)
    {
        $this->shipmentLabel = $shipmentLabel;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        app()->setLocale($this->order->locale);

        $this->order->load('products');

        return $this->subject(trans('storefront::shipped.ready_to_ship', ['id' => $this->order->id]))
            ->view("emails.{$this->getViewName()}", [
                'logo' => File::findOrNew(setting('storefront_mail_logo'))->path,
            ]);
    }

    private function getViewName()
    {
//        return 'invoice' . (is_rtl() ? '_rtl' : '');
        return 'shipment_label_created';
    }
}
