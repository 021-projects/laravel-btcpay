<?php

namespace Petzsch\LaravelBtcpay\Http\Controllers;

use Illuminate\Http\Request;
use Petzsch\LaravelBtcpay\Entities\Webhook;
use Petzsch\LaravelBtcpay\Events\WebhookReceived;

class WebhookController
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();
        $type = \Arr::get($payload, 'type');
        unset($payload['type']);

        WebhookReceived::dispatch(new Webhook(compact('type', 'payload')));

        return response('OK', 200);
    }
}
