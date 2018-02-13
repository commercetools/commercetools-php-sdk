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
 * @method ChangeSubscription setResourceTypeId(string $resourceTypeId = null)
 */
class ChangeSubscription extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'resourceTypeId' => [static::TYPE => 'string'],
        ];
    }
}
