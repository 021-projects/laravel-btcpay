<?php

namespace Petzsch\LaravelBtcpay\Concerns;

use BTCPayServer\Client\AbstractClient;
use BTCPayServer\Client\ApiKey;
use BTCPayServer\Client\Health;
use BTCPayServer\Client\Invoice;
use BTCPayServer\Client\InvoiceCheckoutOptions;
use BTCPayServer\Client\LightningInternalNode;
use BTCPayServer\Client\LightningStore;
use BTCPayServer\Client\Miscellaneous;
use BTCPayServer\Client\Notification;
use BTCPayServer\Client\PullPayment;
use BTCPayServer\Client\Server;
use BTCPayServer\Client\Store;
use BTCPayServer\Client\StoreEmail;
use BTCPayServer\Client\StoreOnChainWallet;
use BTCPayServer\Client\StorePaymentMethod;
use BTCPayServer\Client\StorePaymentMethodLightningNetwork;
use BTCPayServer\Client\StorePaymentMethodOnChain;
use BTCPayServer\Client\StoreRate;
use BTCPayServer\Client\StoreUser;
use BTCPayServer\Client\User;
use BTCPayServer\Client\Webhook;
use Petzsch\LaravelBtcpay\Exceptions\InvalidConfigurationException;

trait WithGreenfieldEndpoints
{
    public function apiKey(): ApiKey
    {
        return $this->createEndpoint(ApiKey::class);
    }

    public function health(): Health
    {
        return $this->createEndpoint(Health::class);
    }

    public function invoice(): Invoice
    {
        return $this->createEndpoint(Invoice::class);
    }

    public function invoiceCheckoutOptions(): InvoiceCheckoutOptions
    {
        return $this->createEndpoint(InvoiceCheckoutOptions::class);
    }

    public function lightningInternalNote(): LightningInternalNode
    {
        return $this->createEndpoint(LightningInternalNode::class);
    }

    public function lightningStore(): LightningStore
    {
        return $this->createEndpoint(LightningStore::class);
    }

    public function miscellaneous(): Miscellaneous
    {
        return $this->createEndpoint(Miscellaneous::class);
    }

    public function notification(): Notification
    {
        return $this->createEndpoint(Notification::class);
    }

    public function pullPayment(): PullPayment
    {
        return $this->createEndpoint(PullPayment::class);
    }

    public function server(): Server
    {
        return $this->createEndpoint(Server::class);
    }

    public function store(): Store
    {
        return $this->createEndpoint(Store::class);
    }

    public function storeEmail(): StoreEmail
    {
        return $this->createEndpoint(StoreEmail::class);
    }

    public function storeOnChainWallet(): StoreOnChainWallet
    {
        return $this->createEndpoint(StoreOnChainWallet::class);
    }

    public function storePaymentMethod(): StorePaymentMethod
    {
        return $this->createEndpoint(StorePaymentMethod::class);
    }

    public function storePaymentMethodLightningNetwork(): StorePaymentMethodLightningNetwork
    {
        return $this->createEndpoint(StorePaymentMethodLightningNetwork::class);
    }

    public function storePaymentMethodOnChain(): StorePaymentMethodOnChain
    {
        return $this->createEndpoint(StorePaymentMethodOnChain::class);
    }

    public function storeRate(): StoreRate
    {
        return $this->createEndpoint(StoreRate::class);
    }

    public function storeUser(): StoreUser
    {
        return $this->createEndpoint(StoreUser::class);
    }

    public function user(): User
    {
        return $this->createEndpoint(User::class);
    }

    public function webhook(): Webhook
    {
        return $this->createEndpoint(Webhook::class);
    }

    protected function createEndpoint(string $class): AbstractClient
    {
        throw_unless(
            $baseUrl = $this->getBaseUrl(),
            InvalidConfigurationException::emptyServerUrl()
        );
        throw_unless(
            $apiKey = $this->getApiKey(),
            InvalidConfigurationException::emptyApiKey()
        );

        return new $class($baseUrl, $apiKey, $this->client);
    }
}
