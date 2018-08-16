<?php
/**
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Subscription
 *
 * @method string getReason()
 * @method PayloadNotIncluded setReason(string $reason = null)
 * @method string getPayloadType()
 * @method PayloadNotIncluded setPayloadType(string $payloadType = null)
 */
class PayloadNotIncluded extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'reason' => [static::TYPE => 'string'],
            'payloadType' => [static::TYPE => 'string'],
        ];
    }
}
