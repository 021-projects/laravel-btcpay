<?php

namespace Petzsch\LaravelBtcpay\Concerns;

use BTCPayServer\Client\InvoiceCheckoutOptions;
use BTCPayServer\Result\Invoice;
use BTCPayServer\Util\PreciseNumber;
use Petzsch\LaravelBtcpay\Exceptions\InvalidConfigurationException;

trait Shorthands
{
    public function createInvoice(
        string $currency,
        ?PreciseNumber $amount = null,
        ?string $orderId = null,
        ?string $buyerEmail = null,
        ?array $metaData = null,
        ?InvoiceCheckoutOptions $checkoutOptions = null
    ): Invoice {
        throw_unless(
            $storeId = config('btcpay.store_id'),
            InvalidConfigurationException::emptyStoreID()
        );

        return $this->invoice()->createInvoice(
            $storeId,
            $currency,
            $amount,
            $orderId,
            $buyerEmail,
            $metaData,
            $checkoutOptions
        );
    }
}
