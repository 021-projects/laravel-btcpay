<?php

namespace Petzsch\LaravelBtcpay\Entities;

use O21\ApiEntity\BaseEntity;

/**
 * @property-read \Petzsch\LaravelBtcpay\Enums\WebhookType $type
 * @property-read array $payload
 */
class Webhook extends BaseEntity
{
}
