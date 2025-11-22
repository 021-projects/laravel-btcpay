<?php

namespace Petzsch\LaravelBtcpay\BTCPayServer\Http;

use BTCPayServer\Http\ResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponse;

class GuzzleResponse implements ResponseInterface
{
    public function __construct(protected PsrResponse $response)
    {
    }

    public function getStatus(): int
    {
        return $this->response->getStatusCode();
    }

    public function getBody(): string
    {
        return $this->response->getBody()->getContents();
    }

    public function getHeaders(): array
    {
        return $this->response->getHeaders();
    }
}
