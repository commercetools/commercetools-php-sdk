<?php
/**
 *
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Cart
 *
 * @method ItemShippingTargetCollection getTargets()
 * @method ItemShippingDetails setTargets(ItemShippingTargetCollection $targets = null)
 * @method bool getValid()
 * @method ItemShippingDetails setValid(bool $valid = null)
 */
class ItemShippingDetails extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'targets' => [static::TYPE => ItemShippingTargetCollection::class],
            'valid' => [static::TYPE => 'bool'],
        ];
    }
}
