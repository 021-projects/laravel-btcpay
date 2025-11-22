<?php

namespace Petzsch\LaravelBtcpay\BTCPayServer\Http;

use BTCPayServer\Http\ClientInterface;
use BTCPayServer\Http\ResponseInterface;
use Psr\Http\Client\ClientInterface as PsrClient;

class GuzzleClient implements ClientInterface
{
    public function __construct(protected PsrClient $guzzle)
    {
    }

    public function request(
        string $method,
        string $url,
        array $headers = [],
        string $body = ''
    ): ResponseInterface {
        $options = [
            'headers' => $headers,
        ];

        if ($body !== '') {
            $options['body'] = $body;
        }

        return new GuzzleResponse(
            $this->guzzle->request($method, $url, $options),
        );
    }
}
