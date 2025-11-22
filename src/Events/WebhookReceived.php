<?php

namespace Petzsch\LaravelBtcpay\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Petzsch\LaravelBtcpay\Entities\Webhook;

class WebhookReceived
{
    use Dispatchable;

    /**
     * Create a new event instance.
     */
    public function __construct(public Webhook $webhook)
    {
    }
}
