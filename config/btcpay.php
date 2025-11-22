<?php

return [
    /*
     * This is the BTCPay API Key generated under your user's profile.
     * This value must be supplied for communication to work.
     */
    'api_key' => env('BTCPAY_API_KEY'),

    /*
     * This is the URL to your BTCPayServer as shown in the address bar of
     * your browser. Without the last / at the end of the URL.
     * i.e.: https://btcpay.your.server.tld
     */
    'server_url' => env('BTCPAY_SERVER_URL'),

    /*
     * This is the Store ID of your BTCPayServer Store that you wish to create
     * the invoices on. You will find it in the "Store Settings".
     * i.e.: someRandomStringWithWildAlphaNumericChars
     */
    'store_id' => env('BTCPAY_STORE_ID'),

    'webhook' => [
        // Should add webhook handling routes
        'routes' => true,

        // The secret configured in your BTCPayServer Store Webhook settings
        'secret' => env('BTCPAY_WEBHOOK_SECRET'),

        // The URL prefix where the webhook endpoint will be accessible
        'prefix' => 'btcpay/webhook',
    ],
];
