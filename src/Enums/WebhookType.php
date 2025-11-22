<?php

namespace Petzsch\LaravelBtcpay\Enums;

enum WebhookType: string
{
    case InvoiceCreated = 'InvoiceCreated';
    case InvoiceReceivedPayment = 'InvoiceReceivedPayment';
    case InvoiceProcessing = 'InvoiceProcessing';
    case InvoiceExpired = 'InvoiceExpired';
    case InvoiceSettled = 'InvoiceSettled';
    case InvoiceInvalid = 'InvoiceInvalid';
    case InvoicePaymentSettled = 'InvoicePaymentSettled';
    case PaymentRequestCreated = 'PaymentRequestCreated';
    case PaymentRequestUpdated = 'PaymentRequestUpdated';
    case PaymentRequestArchived = 'PaymentRequestArchived';
    case PaymentRequestStatusChanged = 'PaymentRequestStatusChanged';
    case PayoutCreated = 'PayoutCreated';
    case PayoutApproved = 'PayoutApproved';
    case PayoutUpdated = 'PayoutUpdated';
}
