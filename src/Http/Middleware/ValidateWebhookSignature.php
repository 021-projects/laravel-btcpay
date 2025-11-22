<?php

namespace Petzsch\LaravelBtcpay\Http\Middleware;

use BTCPayServer\Client\Webhook;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ValidateWebhookSignature
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function handle($request, Closure $next)
    {
        $payload = (string) $request->getContent();
        if (! Webhook::isIncomingWebhookRequestValid(
            $payload,
            $request->header('BTCPay-Sig'),
            config('btcpay.webhook.secret'),
        )) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
