<?php

namespace Petzsch\LaravelBtcpay\Tests;

use BTCPayServer\Client\Invoice;
use Petzsch\LaravelBtcpay\BTCPay;
use PHPUnit\Framework\TestCase;

class LaravelBtcpayInvoiceTest extends TestCase
{
    /** @test */
    public function isInstanceOfInvoice()
    {
        $this->assertEquals(true, BTCPay::Invoice() instanceof Invoice);
    }
}
