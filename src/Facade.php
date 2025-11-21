<?php

namespace Petzsch\LaravelBtcpay;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Facade extends BaseFacade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-btcpay';
    }
}
