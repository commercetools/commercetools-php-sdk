<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Subscription
 *
 * @method string getResourceTypeId()
 * @method MessageSubscription setResourceTypeId(string $resourceTypeId = null)
 * @method array getTypes()
 * @method MessageSubscription setTypes(array $types = null)
 */
class MessageSubscription extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'resourceTypeId' => [static::TYPE => 'string'],
            'types' => [static::TYPE => 'array'],
        ];
    }
}
