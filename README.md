# Laravel BTCPay

![LaravelBtcPay Social Image](https://banners.beyondco.de/LaravelBtcPay.png?theme=light&packageManager=composer+require&packageName=petzsch%2Flaravel-btcpay&pattern=circuitBoard&style=style_1&description=Transact+in+Bitcoin%2C+Litecoin+and+10%2B+other+BtcPay-supported+cryptocurrencies+within+your+Laravel+application.&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/petzsch/laravel-btcpay.svg?style=for-the-badge)](https://packagist.org/packages/petzsch/laravel-btcpay)
[![Total Downloads](https://img.shields.io/packagist/dt/petzsch/laravel-btcpay.svg?style=for-the-badge)](https://packagist.org/packages/petzsch/laravel-btcpay)

Laravel BTCPay enables you and your business to transact in Bitcoin, Litecoin and 10+ other BTCPay-supported
cryptocurrencies within your Laravel application.

## Contents

- [Installation](#installation)
    + [Install Package](#install-package)
    + [Publish config file](#publish-config-file)
    + [Add configuration values](#add-configuration-values)
    + [Interaction with API](#interaction-with-api)
    + [Webhooks](#webhooks)
        + [1. Use package route or define your own](#1-use-package-route-or-define-your-own)
        + [2. Setup your webhook listener](#2-setup-your-webhook-listener)
- [Credits](#credits)
- [License](#license)

## Installation

### Requirements
- PHP 8.1 or higher
- Laravel 10 or higher

### Install package

You can install the package via composer:

```bash
composer require petzsch/laravel-btcpay
```

### Publish config file

Publish config file with:

```bash
php artisan vendor:publish --provider="Petzsch\LaravelBtcpay\ServiceProvider"
```

This will create a `btcpay.php` file inside your **config** directory.

### Add configuration values

Add the following keys to your `.env` file and update the values to match your
preferences ([read more about configuration](https://github.com/btcpayserver/btcpayserver-greenfield-php#where-to-get-the-api-key-from)):

```dotenv
BTCPAY_API_KEY=YourRandomApiKeyThatYouOptainedFromYourBTCPayUserSettings
BTCPAY_SERVER_URL=https://btcpay.your.server.tld
BTCPAY_WEBHOOK_SECRET=YourRandomWebhookSecretString
# Optional, only if you want to use shorthand methods
BTCPAY_STORE_ID=YourBtcPayStoreId
```

### Interaction with API

This package is wrapping the [BTCPay Greenfield PHP SDK](https://github.com/btcpayserver/btcpayserver-greenfield-php), so you can use all features provided by the SDK.
You can access the endpoint clients via the `BTCPay` facade. For example, to access the Invoice endpoint client, you can use:

```php
use Petzsch\LaravelBtcpay\Support\BTCPay;
use BTCPayServer\Util\PreciseNumber;

/** @var \BTCPayServer\Client\Invoice $invoiceClient */
$invoiceClient = BTCPay::invoice();

$invoiceClient->createInvoice(
    storeId: 'your-store-id',
    currency: 'USD',
    amount: new \BTCPayServer\Util\PreciseNumber('100.00'),
);

// or use the shorthand method provided by the package

$invoice = BTCPay::createInvoice(
    amount: 100.00,
    currency: 'USD',
);
```

### Webhooks

BTCPay resource status updates are completely based on webhooks (IPNs). Laravel BTCPay fully capable of automatically
handling webhook requests. Whenever a webhook is received from BTCPay's server, `\Petzsch\LaravelBtcpay\Events\WebhookReceived` event is
dispatched. Take the following steps to configure your application for webhook listening:

#### 1. Use package route or define your own

By default, package provides a `btcpay/webhook` route that will listen for incoming webhook `POST` requests from
BTCPay's server. It automatically verifies the request signature and dispatch event only if it is valid.
You can change the default route path in the `btcpay.php` config file by updating the `webhook.prefix` key.

> :information_source: To retrieve webhook route anywhere in your application, use: `route('btcpay.webhook')`

Alternatively, you can disable the package route by setting `webhook.prefix` to `false` in the `btcpay.php` config file and define your own route in your `routes/web.php` or `routes/api.php` file:
```php
use Petzsch\LaravelBtcpay\Http\Controllers\WebhookController;

Route::post('/your-custom-webhook-path', [WebhookController::class, 'handle'])
    ->name('btcpay.webhook')
    ->middleware(\Petzsch\LaravelBtcpay\Http\Middleware\ValidateWebhookSignature::class);
```

#### 2. Setup your webhook listener

Start by generating an event listener:

```bash
php artisan make:listener BTCPayWebhookListener --event=\Petzsch\LaravelBtcpay\Events\WebhookReceived
```

Then, implement your application-specific logic in the `handle(...)` function of the generated listener.

```php
use Petzsch\LaravelBtcpay\Events\WebhookReceived;
use Petzsch\LaravelBtcpay\Enums\WebhookType;
use Illuminate\Support\Arr;

public function handle(WebhookReceived $event): void
{
    match($event->webhook->type) {
        WebhookType::InvoiceSettled => $this->handleInvoiceSettled($event),
        // handle other webhook types...
        default => null,
    };
}

protected function handleInvoiceSettled(WebhookReceived $event): void
{
    // do something with the settled invoice
}
```

## Credits

- [Vaibhavraj Roham](https://github.com/vrajroham)
- [Alex Stewart](https://github.com/alexstewartja)
- [Markus Petzsch](https://github.com/petzsch)
- [021](https://github.com/021-projects)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
