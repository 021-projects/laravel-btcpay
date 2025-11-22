<?php

namespace Petzsch\LaravelBtcpay\Support;

use Illuminate\Support\Facades\Facade;

class BTCPay extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'btcpay';
    }
}
