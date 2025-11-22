<?php

namespace Petzsch\LaravelBtcpay;

use BTCPayServer\Http\ClientInterface;
use GuzzleHttp\Client;
use Petzsch\LaravelBtcpay\Concerns\Shorthands;
use Petzsch\LaravelBtcpay\Concerns\WithGreenfieldEndpoints;
use Petzsch\LaravelBtcpay\BTCPayServer\Http\GuzzleClient;

class BTCPay
{
    use WithGreenfieldEndpoints, Shorthands;

    protected ClientInterface $client;

    public function __construct()
    {
        $this->client = new GuzzleClient(new Client);
    }

    protected function getBaseUrl(): string
    {
        return config('btcpay.server_url');
    }

    protected function getApiKey(): string
    {
        return config('btcpay.api_key');
    }
}
