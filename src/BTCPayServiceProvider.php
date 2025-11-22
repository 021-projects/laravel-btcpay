<?php

namespace Petzsch\LaravelBtcpay;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Petzsch\LaravelBtcpay\Http\Controllers\WebhookController;
use Petzsch\LaravelBtcpay\Http\Middleware\ValidateWebhookSignature;

class BTCPayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/btcpay.php' => config_path(
                    'btcpay.php'
                ),
            ], 'config');
        }

        $this->defineRoutes();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/btcpay.php', 'btcpay');

        $this->registerClient();
    }

    protected function registerClient(): void
    {
        $this->app->singleton(BTCPay::class, fn () => new BTCPay);
        $this->app->alias(BTCPay::class, 'btcpay');
    }

    protected function defineRoutes(): void
    {
        $webhook = config('btcpay.webhook');

        if (app()->routesAreCached()
            || Arr::get($webhook, 'routes') === false
        ) {
            return;
        }

        Route::post(
            Arr::get($webhook, 'prefix', 'btcpay/webhook'),
            [WebhookController::class, 'handleWebhook']
        )->name('btcpay.webhook')->middleware(ValidateWebhookSignature::class);
    }
}
